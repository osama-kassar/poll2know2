<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class CompetitionsController extends AppController
{
    public function view($id = null)
    {
        $competition = $this->Competitions->get($id, [
            'contain' => ['Competitors', 'Competitors.Scores', 'Comments'],
        ]);
        
        
        // check if competition expired
        $end = date("Y-m-d H:i:s", strtotime("+90 minutes", strtotime($competition->stat_created->format('Y-m-d H:i:s'))));
        $curr = date('Y-m-d H:i:s');
        if(strtotime($end) < strtotime($curr) && $competition->rec_state != 3){ 
            $this->Do->adder(["id"=>$competition->id, "rec_state"=>3], "Competitions");
        }
        
        $exam = $this->loadModel("Exams")->get($competition->exam_id, ["contain"=>["Polls", "Polls.Options"]]);
        $exam->exam_configs = json_decode($exam->exam_configs);
        $competition->total_polls = count($exam->polls);
        $competitorDt = $this->request->getSession()->read("competitorDt");
        $hits=null;
        $ind=-1;
        
        // identify the user by ii, session or ip
        if(!empty($this->Auth->User("id"))){
            $ind=array_search($this->Auth->User("id"),array_column($competition->competitors, "user_id"));
        }elseif(!empty($competitorDt)){
            $ind=array_search($competitorDt->id,array_column($competition->competitors, "id"));
        }else{
            $ind=array_search($this->Do->get('uid'), array_column($competition->competitors, "stat_ip"));
        }
        
        if($ind!==false){
            $hits = $this->loadModel("Hits")->find('all', [
                'conditions'=>["id IN "=>explode(',', $competition->competitors[$ind]->score->hits_ids )],
                'fields'=>['Hits.id', 'Hits.option_id']
            ]);
            $this->Do->adder([
                "id"=>$competition->competitors[$ind]->id,
                "competitor_score"=>$competition->competitors[$ind]->score->score_result
            ], "Competitors");
            $exam->polls = $this->Do->setHitted($exam->polls, $hits);   
        }
        
//        $this->Do->adder(['id'=>$competition->id*1, 'stat_views'=>intval($competition->stat_views+1)], 'Competitions');
        
        if($this->request->getQuery("ajax") == 1){
            $res = [];
            $isAllDone = 0;
            foreach($competition->competitors as $k=>$itm){
                
                $competition->competitors[$k]->competitor_configs = json_decode($competition->competitors[$k]->competitor_configs);
                
                // check competitor if idol
                $currDate = strtotime(date('Y-m-d H:i:s', strtotime("-1 minute")));
                $dueDate = strtotime($itm->stat_updated->format('Y-m-d H:i:s'));
                $answers = isset($itm->competitor_configs->answers) ? $itm->competitor_configs->answers : null;
                if($currDate > $dueDate || empty($answers)){
                    $isDirty = false;
                    foreach($exam->polls as $poll){
                        if(is_array($answers)){
                            $pollIndex = array_search($poll->id, array_column($answers, "poll_id"));
                        }else{
                            $pollIndex = false;
                        }
                        $isDirty = false;
                        if($ind != $k){// avoid update current finished user
                            if($pollIndex === false){
                                $competition->competitors[$k]->competitor_configs->answers[] = ["poll_id"=>$poll->id, "options_ids"=>[], "hits_ids"=>[]];
                                $isDirty = true;
                            }
                        }
                    }
                    if($isDirty){
                        $this->Do->adder($competition->competitors[$k], "Competitors");
                    }
                }
                         
                if(!empty($competition->competitors[$k]->score)){
                    $competition->competitors[$k]->score->score_configs = json_decode($competition->competitors[$k]->score->score_configs);
                    $res[] = [
                        "score_result"=>$itm->score->score_result*1, 
                        "stat_created"=>strtotime($itm->score->stat_created->format('Y-m-d H:i:s')),
                        "ind"=>$k
                    ];
                }
                // check if competition expired
//                $endDate = date("Y-m-d H:i:s", strtotime("+5 minutes", strtotime($competition->stat_created->format('Y-m-d H:i:s'))));
//                $currDate = date('Y-m-d H:i:s');
//                
//                $competition->debug = "end: ".$endDate.' curr: '.$currDate;
//                
//                if(strtotime($endDate) < strtotime($currDate)){
//                    $isAllDone = 1;
//                }
//                if(!empty($itm->competitor_configs->answers)){
//                    if(count((array)$itm->competitor_configs->answers) !== $competition->total_polls){
//                        $isAllDone = 0;
//                    }
//                }else{
//                    $isAllDone = 0;
//                }
            }
            array_multisort(array_column($res, "stat_created"), SORT_ASC, $res);
            array_multisort(array_column($res, "score_result"), SORT_DESC, $res);
            
            $competition->isAllDone = $isAllDone;
            
//            if($isAllDone == 1){
//                $this->Do->adder(["id"=>$competition->id, "rec_state"=>3], "Competitions");
//                $this->request->getSession()->delete('competitorDt');
//                $this->request->getSession()->delete('openedExam'.$competition->exam_id);
//            }
            
            $competition->winner = $competition->competitors[ $res[0]["ind"] ];
            echo json_encode(["status"=>"SUCCESS", "data"=>$competition], JSON_UNESCAPED_UNICODE); die();
        }
        
        $cmpttrs_vs = [];
        foreach($competition->competitors as $k=>$itm){
            $cmpttrs_vs[] = $itm->competitor_name;
        }
        // Meta data
        $metaDt = [ 
            "_title"=>__('thecompetitors').': ('.implode(' - ', $cmpttrs_vs).') \n\n '.__('thecompetition').': '.$exam->exam_title, 
            "_keywords"=>$exam->seo_keywords, 
            "_description"=>$exam->exam_desc, 
            "_photo"=>empty($competition->seo_image) ? "/img/win".rand(0,3).".jpg" : "/img/competitions_photos/thumb/".$competition->seo_image
        ];
//        debug($exam);
//        debug($competition);
//        debug($hits);
//        debug($metaDt);
//        
//        die();
        
        $this->set(compact('competition', 'exam', 'hits', 'metaDt'));
    }
    
    public function add($id = null)
    {
        $this->autoRender = false;
        $competition = $this->Competitions->newEntity();
        
        if ($this->request->is('post')) {
            
            $dt = json_decode(file_get_contents('php://input'), true);
            if($id){
                $rec = $this->Competitions->get($id, [
                    "contain"=>["Competitors"]
                ]);
            }else{
                $competition = $this->Competitions->patchEntity($competition, $dt);
                $competition->competition_title = $dt['exam_title'].'-'.date("Y-m-d H:i:s");
                $competition->stat_created = date("Y-m-d H:i:s");
                $competition->stat_ip = $_SERVER['REMOTE_ADDR'];
                $competition->rec_state = 2;
                $rec = $this->Competitions->save($competition);
            }
            if($rec) {
                $conf = [
                    "isFounder" => !empty($id) ? 0 : 1,
                    "competitor_avatar" => (@$dt['competitor_gender'] == 1 ? "female" : "male") .rand(0, 20).".png"  
                ];
                $competitorDt = [
                    "user_id" => !empty( $this->Auth->User('id') ) ? $this->Auth->User('id') : 0,
                    "competition_id" => $rec->id,
                    "competitor_name" => empty($this->Auth->User('user_fullname')) ? @$dt['competitor_name'] : $this->Auth->User('user_fullname'),
                    "competitor_email" => empty($this->Auth->User('email')) ? @$dt['competitor_email'] : $this->Auth->User('email'),
                    "competitor_gender" => @$dt['competitor_gender'],
                    "competitor_configs" => json_encode($conf),
                    "competitor_score" => 0,
                    "competitor_info" => '',//$this->Do->getUinfo(),
                    "stat_created" => date("Y-m-d H:i:s"),
                    "stat_ip" => $this->Do->get('uid'),
                    "rec_state" => 1
                ];
                $competitor = $this->Competitions->Competitors->newEntity();;
                $competitorDt = $this->Competitions->Competitors->patchEntity($competitor, $competitorDt);
                
                $rec2 = $this->Competitions->Competitors->save($competitorDt, "Competitors");
                
                if($rec2){
                    $competition = $this->Competitions->get($rec->id,[
                        "contain"=>["Competitors"]
                    ]);
                    
                    $rec2->competitor_configs = json_decode($rec2->competitor_configs);
                    $this->request->getSession()->write("competitorDt", $rec2);
                    for($i=0; $i<count($competition->competitors); $i++){
                        $competition->competitors[$i]->competitor_configs = json_decode($competition->competitors[$i]->competitor_configs);
                    }

                    echo json_encode(["status"=>"SUCCESS", "data"=>$competition]); die();
                }
            }
            echo json_encode($competition->getErrors());  die();
        }
    }
    
    public function updateCompetitor($id = null)
    {
        $this->autoRender = false;
        $rec = $this->Competitions->Competitors->get($id);
        unset($rec->stat_created);
        if ($this->request->is('post')) {
            
            $dt = json_decode(file_get_contents('php://input'), true);
            unset($dt["stat_created"]);
            $dt["id"] = $id*1;
            $dt["competitor_gender"] = $dt["competitor_gender"]*1;
            $dt["competitor_configs"]["answers"] = $dt["answers"];
            $dt["competitor_configs"] = json_encode($dt["competitor_configs"]);
            $dt["stat_updated"] = date("Y-m-d H:i:s");
            
            if($this->Do->adder($dt, "Competitors")) {
                echo json_encode(["status"=>"SUCCESS", "data"=>1]); die();
            }
            echo json_encode(["status"=>"FAIL", "data"=>0]);  die();
        }
    }
    
    public function edit($id = null)
    {
        $this->autoRender = false;
        $competition = $this->Competitions->get($id);
        
        if ($this->request->is('post')) {
            
            $dt = json_decode(file_get_contents('php://input'), true);
            $competition = $this->Competitions->patchEntity($competition, $dt);
            if($rec = $this->Competitions->save($competition)) {
                echo json_encode(["status"=>"SUCCESS", "data"=>$competition]); die();
            }
            echo json_encode($competition->getErrors());  die();
        }
    }
    
    public function chk($id = null)
    {
        $this->autoRender = false;
        $competition = $this->Competitions->get($id, [
            "contain"=>["Competitors"]
        ]);
        
        // check if record not found
        if(empty($competition)){
            echo json_encode(["status"=>"FAIL", "msg"=>__("competition_canceled")]); die();
        }
        
        // check if competition expired
        $endDate = date("Y-m-d H:i:s", strtotime("+45 minutes", strtotime($competition->stat_created->format('Y-m-d H:i:s'))));
        $currDate = date('Y-m-d H:i:s');
        if(strtotime($endDate) < strtotime($currDate)){ 
            $this->Do->adder(["id"=>$competition->id, "rec_state"=>3], "Competitions");
        }
        if($competition->rec_state == 3){
            echo json_encode(["status"=>"FAIL", "msg"=>__("competition_expired")]);
            $this->request->getSession()->delete('competitorDt');
            $this->request->getSession()->delete('openedExam'.$competition->exam_id); 
        }
        for($i=0; $i<count($competition->competitors); $i++){
            $competition->competitors[$i]->competitor_configs = json_decode($competition->competitors[$i]->competitor_configs);
        }
        $competition->stat_created = $competition->stat_created->format('Y-m-d H:i:s');
        
        $competitorDt = $this->request->getSession()->read("competitorDt");
//        debug($competitorDt);
        if(!empty(@$competitorDt->id)){
            $this->Do->adder([
                "id"=>@$competitorDt->id, 
                "stat_updated"=>date("Y-m-d H:i:s")
            ], "Competitors");
        }
        $competition->competitorDt = $competitorDt;
        
        $answers = $this->request->getSession()->read('openedExam'.$competition->exam_id.'.Answers');
        
        $competition->competitorDt->competitor_configs->answers = empty($answers) ? null : $answers; 
        
        echo json_encode(["status"=>"SUCCESS", "data"=>$competition], JSON_UNESCAPED_UNICODE); die();
    }
    

    public function delete($id = null)
    {
        $this->autoRender = false;
        $this->request->allowMethod(['post', 'delete']);
        $rec = $this->Competitions->get($id);
        if ($this->Competitions->delete($rec)) {
            echo json_encode(["status"=>"SUCCESS", "msg"=>__("delete-success")]); die();
        } else {
            echo json_encode(["status"=>"FAIL", "msg"=>__("delete-fail")]); die();
        }
    }
    
    function beforeFilter(Event $event) 
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['add', 'edit', 'chk', 'delete', 'updateCompetitor']);
    }
}