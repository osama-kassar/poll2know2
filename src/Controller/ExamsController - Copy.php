<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Event\Event;

class ExamsController extends AppController
{
    
    public function answer($dt = null) 
    {
        $this->autoRender  = false;
        $data = (object)$_POST;
        if(!empty($data->poll['options'])){
            $answers_ids = array_keys($data->poll['options']);
            $answers_vals = array_values($data->poll['options']);
        }else{
            echo json_encode($data, JSON_UNESCAPED_UNICODE); die();
        }
        $hits_ids = [];
        $hitsArray=[];
        for($i=0; $i<count( $answers_ids ); $i++){
            $hitsArray[] = [
                "user_id"=> empty( $this->Auth->User("id") ) ? 0 :  $this->Auth->User("id"),
                "poll_id"=> $data->poll['id'],
                "option_id"=> $answers_ids[$i],
                "hit_userinfo"=> $this->Do->getUinfo(),
                "hit_ip"=> $_SERVER['REMOTE_ADDR'],
                "rec_state"=> 2,
                'hit_answer'=> $data->poll['poll_type']*1 == 4 ? $this->Do->AnswerFilter( $answers_vals[$i] ) : ''
            ];
        }
        
        if($hitsRec = $this->Do->adder($hitsArray, "Hits")){
            $hits_ids = array_values(array_column($hitsRec, 'id'));
            $sess = (array)$this->request->getSession()->read('openedExam'.$data->poll['exam_id']);
            $sess['Answers'][] = ["poll_id"=>$data->poll['id'], "options_ids"=>$data->poll['options'], "hits_ids"=>$hits_ids];
            
            $this->request->getSession()->write('openedExam'.$data->poll['exam_id'], $sess);
            if($data->poll['exam_type'] == 1){
                $this->redirect(["action"=>"view", $data->poll['exam_slug'], "p"=>intval($data->poll['p'])+1]);
            }else{
                $this->redirect(["action"=>"game", $data->poll['exam_slug'], "p"=>intval($data->poll['p'])+1]);
            }
        }
    }
    /*public function answer_with_competition($dt = null) 
    {
        $this->autoRender  = false;
        $dt = $_POST;
        $data = $dt == null ? json_decode( file_get_contents('php://input') ) : (object)$dt;
        debug($_POST);
        debug($data);die();
        if(!empty($data->selectedOptions)){
            $answers_ids = is_string($data->selectedOptions) ? [$data->selectedOptions*1] : array_keys((array)$data->selectedOptions);
        }else{
            echo json_encode($data, JSON_UNESCAPED_UNICODE); die();
        }
        $hits_ids = [];
        $hitsAdded = false;
        for($i=0; $i<count( $answers_ids ); $i++){
            $hitObj = [
                "user_id"=> empty( $this->Auth->User("id") ) ? 0 :  $this->Auth->User("id"),
                "poll_id"=> $data->id,
                "option_id"=> $answers_ids[$i],
                "hit_userinfo"=> $this->Do->getUinfo(),
                "hit_ip"=> $_SERVER['REMOTE_ADDR'],
                "rec_state"=> $data->isCompetition>0 ? 3 : 2,
                'hit_answer'=> ''
            ];
//            debug($hitObj);die();
            // Create new hit 
            if($hitRec = $this->Do->adder($hitObj, "Hits") ){
                array_push($hits_ids, $hitRec->id);
                $hitsAdded=true;
                $option = $this->loadModel("Options")->get( $answers_ids[$i] );
                $hits = $this->loadModel("Hits")->find("all", [
                    "fields"=>["id", "hit_answer"],
                    "conditions"=>[ "option_id"=>$answers_ids[$i] ]
                ]);
                $option->stat_hits = $hits->count();
                if($data->poll_type == 3){
                    $option->stat_totalrate = !empty($data->options_values[$i]) ? $this->Do->calcRate( $hits ) : '';
                }
                // Update option hits number
                $this->Do->adder($option->toArray(), "Options");
                $totalhits = $this->loadModel("Hits")->find("all", [
                    "conditions"=>["poll_id"=>$option->poll_id]
                ])->count();
                // Update poll hits number
                $this->Do->adder(["id"=>$option->poll_id, "stat_hits"=>$totalhits], "Polls");
            }
        }
        
        if($hitsAdded){
            $sess = (array)$this->request->getSession()->read('openedExam'.$data->exam_id);
            if(empty($sess['Answers'])){ 
                $sess = [ 'Answers'=>[], 'userInfo'=>['user_email'=>@$data->user_email, 'user_name'=>@$data->user_name] ]; 
            }
            $sess['Answers'][] = ["poll_id"=>$data->id, "options_ids"=>$answers_ids, "hits_ids"=>$hits_ids];
            
            $this->request->getSession()->write('openedExam'.$data->exam_id, $sess);
            
            if($data->total_polls == count($sess["Answers"])){
                $nextPoll = $this->getpoll($data->exam_id);
                $nextPoll['data']['answers'] = $sess["Answers"];
                $nextPoll['data']['total_answers'] = count($sess["Answers"]);
                echo json_encode($nextPoll , JSON_UNESCAPED_UNICODE); die();
            }else{
                $nextPoll = [
                    "total_answers"=>count($sess["Answers"]),
                    "answers"=>$sess["Answers"]
                ];
                echo json_encode(["status"=>"SUCCESS", "data"=>$nextPoll] , JSON_UNESCAPED_UNICODE); die();
            }
            
        }
    }*/
    
    public function getpoll($examId)
    {
        if ($this->request->getQuery('ajax') == '1') {
            $this->autoRender = false;
        }
        $currPoll = (array)$this->request->getSession()->read('openedExam'.$examId.'.Answers');
        
        $conds = ["exam_id"=>$examId];
        $ids = array_column($currPoll, 'poll_id');
        if(!empty($currPoll)){ $conds[" id NOT IN "] = $ids; }
        
        $nextPoll = $this->Exams->Polls->find("all",[
            "conditions"=>$conds,
            "contain"=>["Options"=>[
                "sort"=>"rand()"
            ]]
        ])->order('rand()')->first();
        
        // if finish add score
        if($nextPoll == null){
            if($newScore = $this->addScore($examId)){
                return ["score_id"=>$newScore->id];
            }
        }
        // Read polls count
        $nextPoll->total_polls = $this->Exams->Polls->find("all", [
            "conditions"=>["exam_id"=>$examId]
        ])->count();
        $nextPoll->total_answers = is_array($currPoll) ? count($currPoll) : 1;
        // Check exam if started
        $nextPoll->isExamStarted = !empty($currPoll) ?  true : false;
        
        $nextPoll = $this->Do->convertJson($nextPoll);
        if ($this->request->getQuery('ajax') == '1') {
            echo json_encode(["status"=>"SUCCESS", "data"=>$nextPoll], JSON_UNESCAPED_UNICODE);die();
        }else{
            return $nextPoll;
        }
    }
    
    private function addScore($examId)
    {
        $exam = $this->Exams->get($examId,[
            "contain"=>["Polls", "Polls.Options", "Results"]
        ]);
        $answers = $this->request->getSession()->read('openedExam'.$examId.'.Answers');
        $userInfo = $this->request->getSession()->read('openedExam'.$examId.'.userInfo');
        $cmpttrInfo = $this->request->getSession()->read('competitorDt');
        if(!empty($cmpttrInfo->id)){
            $userInfo['user_name'] = $cmpttrInfo->competitor_name;
        }
        $result=0;
        $exam_value=100;
        $poll_value=$exam_value / count((array)$exam->polls);
        $all_hits_ids=[];
        $wrong_answers=0;
        $right_answers=0;
        
        if($exam->exam_type == 1){
            if($exam->exam_calc_method == 1){
                foreach($exam->polls as $poll){
                    $poll->poll_configs = json_decode($poll->poll_configs);
                    $ind = array_search($poll->id, array_column($answers, 'poll_id'));
                    if($ind>-1){
                        $isCorrectAnswer = false;
                        // Loop into answers(hits) ANSWERS
                        foreach($answers[$ind]['options_ids'] as $k=>$answer){
                            // Loop into options ( compare answer with all options ) OPTIONS
                            foreach($poll->options as $option){
                                if($k == $option->id){
                                    if(is_string($option->option_configs)){
                                        $option->option_configs = json_decode($option->option_configs);
                                    }
                                    // check options accept user input
                                    if($poll->poll_type==4){
                                        if($option->option_text == $this->Do->AnswerFilter($answer)){
                                            $isCorrectAnswer = true;
                                        }else{
                                            $isCorrectAnswer = false;
                                            break;
                                        }
                                    }else{
                                        if(($option->option_configs->isCorrect*1) == 1){
                                            $isCorrectAnswer = true;
                                        }else{
                                            $isCorrectAnswer = false;
                                            break;
                                        }
                                    }
                                }
                            }
                            if(!$isCorrectAnswer){ break;}
                        }
                        // If the answer doesn't match any correct option, answer is wrong
                        if(!$isCorrectAnswer){
                            $wrong_answers++;
                        }else{
                            $right_answers++;
                        }
                        $all_hits_ids=array_merge($all_hits_ids, $answers[$ind]['hits_ids']);
                        if($isCorrectAnswer){
                            $result+=$poll_value;
                        }
                    }
                }
                $results_arr=[];

                foreach($exam->results as $res){
                    if($result >= @$res->result_min*1 && $result <= @$res->result_max*1){
                        $results_arr[] = $res;
                    }
                }
                $score_result = $results_arr[rand(0, count($results_arr)-1)];
                $score_configs = [
                    "exam_value"=>$exam_value, 
                    "wrong_answers"=>$wrong_answers, 
                    "right_answers"=>$right_answers
                ];
            }else{
                $all_options=[];
                foreach($answers as $answer){
                    $all_options = array_merge($all_options, array_keys($answer['options_ids']));
                    $all_hits_ids= array_merge($all_hits_ids, $answer['hits_ids']);
                }
                $options = $this->loadModel('Options')->find("all", [
                    "conditions"=>["id IN"=>$all_options]
                ]);

                $score_configs = [];
                $total_hits = 0;
                //count how many hits each result has
                foreach($options as $option){
                    if(is_numeric($option->option_value)){
                        if(!isset($score_configs[$option->option_value])){
                            $score_configs[$option->option_value]=1;
                        }else{
                            $score_configs[$option->option_value]++;
                        }
                        $total_hits++;
                    }
                }
                arsort($score_configs);
                $result = ceil((current($score_configs) / $total_hits) * 100);
                $score_result = $this->loadModel('Results')->find("all")
                    ->where([ "id"=>key($score_configs) ])->first();
            }
            $score_photo = '';
            if(empty($cmpttrInfo->id)){
                $imgDt = [
                    "text"=>[
                        empty($userInfo['user_name']) ? __("you") : $userInfo['user_name'],
                        $exam->exam_calc_method == 1 ? '[ '.ceil($result).' %]' : '-----------------------', 
                        $score_result->result_name
                    ], 
                    "bg"=>empty($score_result->result_photos) ? $this->path."/img/exams_photos/".$exam->seo_image : $this->path."/img/results_photos/". $score_result->result_photos,
                    "thumb"=>[['doThumb'=>true, 'w'=>600, 'h'=>600, 'dst'=>'thumb']]
                ];
                $imgDt["imgName"] = date('ymd').time().".".$this->Do->getExt($imgDt["bg"]);

                if($this->Images->creator('scores', $imgDt)){
                    $score_photo = $imgDt["imgName"];
                }
            }
        }else{
            $result=0;
            $score_photo=null;
            foreach($answers as $answer){
                $all_hits_ids= array_merge($all_hits_ids, $answer['hits_ids']);
            }
        }
        
        $scoreObj = [
            "user_id"=> empty( $this->Auth->User("id") ) ? 0 :  $this->Auth->User("id"),
            "exam_id"=> $examId,
            "competitor_id"=> empty($cmpttrInfo->id) ? 0 : $cmpttrInfo->id,
            "score_result"=> ceil($result).'',
            "score_configs"=> "",
            "score_photo"=> $score_photo,
            "user_ip"=> $_SERVER['REMOTE_ADDR'],
            "user_email"=> $userInfo['user_email'],
            "user_name"=> $userInfo['user_name'],
            "hits_ids"=> implode(",", $all_hits_ids),
            'stat_created'=> date("Y-m-d H:i:s"),
            'rec_state'=>1
        ];
        if($newScore = $this->Do->adder($scoreObj , "Scores")){
            return $newScore;
        }
        return false;
    }
    
    public function me($id = null)
    {
        if($this->_isAuthorized(true, 'read')){
            $conditions = ["user_id" => $this->authUser["id"]];
        
            if ($this->request->getQuery('ajax') == '1') {
                $this->autoRender = false;
                if(@$this->request->getQuery('list') == '1'){
                    $this->paginate = [
                        'conditions' => $conditions, 
                        'contain' => ['Polls'=>["fields"=>["id", "exam_id"]]],
                        'order'=> ['id'=>'DESC']
                    ];
                    $data = $this->paginate($this->Exams);
                }else{
                    $dt = json_decode( file_get_contents('php://input') );
                    $conditions['id'] = $this->request->getQuery('id');
                    $myexam = $this->Exams->find("all", [
                        'contain' => ['Polls', 'Polls.Options', 'Results'],
                        'conditions' => $conditions, 
                        'order' => ['id'=>'DESC']
                    ])->first()->toArray();
                    for($i=0; $i<count($myexam['polls']); $i++){
                        $myexam['polls'][$i] = $this->Do->convertJson($myexam['polls'][$i]);
                    }
                    $myexam['exam_configs'] = json_decode($myexam['exam_configs']);
                    $data = $myexam;
                }
                echo json_encode(["status"=>"SUCCESS", "data"=>$data], JSON_UNESCAPED_UNICODE);die();
            }
        
            $this->paginate = [
                'conditions' => $conditions, 
                'contain' => ['Polls'=>["fields"=>["id", "exam_id"]]],
                'order'=> ['id'=>'DESC']
            ];

            $myexams = $this->paginate($this->Exams);
            $this->set(compact('myexams'));
        }
    }
    
    public function index($keyword=null, $category_id=null)
    {
        $type = strpos($this->request->getParam('_matchedRoute'), "/games") === false ? 1 : 2;
        $conditions = [
            "language_id"=>$this->currlangid,
            "exam_type"=>$type
        ];
        $relatedCond["language_id"] = $this->currlangid;
        $relatedCond['exam_id'] = 0;
        if(!empty( $category_id )  && $category_id!=-1){
            $conditions['category_id'] = $category_id;
            $relatedCond['category_id'] = $category_id;
        }
        
        if(!empty( $keyword ) && $keyword!=-1){
            $conditions['OR'][] = ["exam_tags LIKE" => "%".$keyword."%"];
            $conditions['OR'][] = ["exam_title LIKE" => "%".$keyword."%"];
            $conditions['OR'][] = ["exam_desc LIKE" => "%".$keyword."%"];
        }
        $exams = $this->paginate($this->Exams, [
            "conditions"=>$conditions,
            "order"=>["id"=>"DESC"]
        ]);
        
        $related = $this->loadModel('Polls')
            ->find()
            ->where($relatedCond)
            ->limit(6)
            ->order(["id"=>"DESC"]);
        
        $this->set(compact('exams', 'related'));
        if($type == 2){
            $this->render('games');
        }
    }
    
    public function games()
    {
        return $this->index();
    }

    public function view($slug = null)
    {
        $exam = $this->Exams->find('all', [
            'conditions' => ['slug'=>$slug, 'language_id'=>$this->currlangid],
            'contain' => ['Comments' => [ 'conditions' => [ 'rec_state' => 1 ] ],
                         'Polls' => function($q) {
                            return $q->select([
                                 'Polls.exam_id',
                                 'polls_count' => $q->func()->count('Polls.exam_id')
                            ]);
                        }]
        ])->first();
        if(empty($exam)){
            return $this->render('/error/error404');
        }
        $exam->polls_count = $exam->polls[0]->polls_count;
        $poll = null;
        $sess = (array)$this->request->getSession()->read('openedExam'.$exam->id);
        $exExample = $this->Exams->Polls->find('all', [
            'conditions' => ['exam_id'=>$exam->id],
            'contain' => ['Options'],
            'order' => 'rand()',
            'limit' => 5
        ]);
        if(isset($_GET['p'])){
            if(isset($_POST['user_name'])){
                $this->request->getSession()->delete('openedExam'.$exam->id);
                if(empty($this->authUser['id'])){
                    $sess = [ 'Answers'=>[], 'userInfo'=>['user_email'=>@$_POST['email'], 'user_name'=>@$_POST['name']] ];
                }else{
                    $sess = [ 'Answers'=>[], 'userInfo'=>['user_email'=>$this->authUser['email'], 'user_name'=>$this->authUser['user_fullname']] ];
                }
                $this->request->getSession()->write('openedExam'.$exam->id, $sess);
            }
            $poll = (object)$this->getpoll($exam->id);
            if(isset($poll->score_id)){
                $this->request->getSession()->delete('openedExam'.$exam->id);
                return $this->redirect(["controller"=>"Scores", "action"=>"view", $poll->score_id] );
            }
            for($i=0; $i<count($poll->options); $i++){
                $poll->options[$i] = (object)$poll->options[$i];
            }
        }
        $img = $exam->seo_image == null ? "/img/think".rand(0,4).".jpg" : "/img/exams_photos/thumb/".$exam->seo_image;
        $metaDt = [ "_title"=>$exam->exam_title, "_keywords"=>$exam->seo_keywords, "_description"=>$exam->seo_desc, "_photo"=>$img ];
        $this->set(compact('exam', 'poll', 'metaDt', 'exExample'));
    }
    
    public function game($slug = null)
    {
        return $this->view($slug);
    }
    
    /*public function view_with_competition($slug = null)
    {
        $exam = $this->Exams->find('all', [
            'conditions' => ['slug'=>$slug, 'language_id'=>$this->currlangid],
            'contain' => ['Comments' => [
                                'conditions' => [ 'rec_state' => 1 ]
                            ]
                         ]
        ])->first();
        if(empty($exam)){
            return $this->render('/error/error404');
        }
//        $exExample=null;
        $exExample = $this->Exams->Polls->find('all', [
            'conditions' => ['exam_id'=>$exam->id],
            'contain' => ['Options'],
            'order' => 'rand()',
            'limit' => 5
        ]);
//        debug($exExample->toArray());die();
        $competitorDt = $this->request->getSession()->read("competitorDt");
        $isInv = empty($this->request->getQuery('inv')) ? -1 : $this->request->getQuery('inv');
        $cmptId = empty($this->request->getQuery('id')) ? -1 : $this->request->getQuery('id');
        
        // prevent one competitor has two records
        
        if(@$competitorDt->competition_id == $isInv){
            $this->Flash->error(__('you_cant_compete_your_self'));
            return $this->redirect(["controller"=>"Exams", "action"=>"view", $exam->slug, "id"=>$isInv]);
        }
        
        // close the competition after time and matching to chk functions
//        if($isInv == 56){
//            $this->Flash->error(__('competition_expired'));
//            return $this->redirect(["controller"=>"Exams", "action"=>"view", $exam->slug]);
//        }
        
        $exam->polls_count = $this->Exams->Polls->find("all", [
            "conditions"=>["exam_id"=>$exam->id]
        ])->count();
        
        if ($this->request->getQuery('ajax') == '1') {
            $this->autoRender = false;
            $polls=[];
            for($i=0; $i<count($exam->polls); $i++){
                $exam->event_id = (string)$exam->event_id;
                $exam->polls[$i]->poll_configs = json_decode( $exam->polls[$i]->poll_configs );
                $exam->polls[$i]->poll_type = (string)$exam->polls[$i]->poll_type;
                for($j=0; $j<count($exam->polls[$i]->options); $j++){
                    $exam->polls[$i]->options[$j]->option_configs = json_decode($exam->polls[$i]->options[$j]->option_configs);
                    $exam->polls[$i]->options[$j]->option_configs->isCorrect = (string)$exam->polls[$i]->options[$j]->option_configs->isCorrect;
                }
            }
            echo json_encode($exam, JSON_UNESCAPED_UNICODE);die();
        }
        
//        $this->Do->adder(['id'=>$exam->id*1, 'stat_views'=>intval($exam->stat_views+1)], 'Exams');
        
        $img = $exam->seo_image == null ? "/img/think".rand(0,4).".jpg" : "/img/exams_photos/thumb/".$exam->seo_image;
        $metaDt = [ "_title"=>$exam->exam_title, "_keywords"=>$exam->seo_keywords, "_description"=>$exam->seo_desc, "_photo"=>$img ];
        
        $currentCompetition = [];
        
        // check isInvitation
        $isFounder = 3;
        if(($cmptId*1)>0 || ($isInv*1)>0){
            $cid = ($cmptId+$isInv+1);
            $currentCompetition = $this->Exams->Competitions->find("all", [
                "conditions"=>["id"=>$cid],
                "contain"=>["Competitors"]
            ])->first()->toArray();
            
            // prevent competitor subscribe after competition started
            // check if competition still available 
            if( empty($currentCompetition) || $currentCompetition['rec_state'] == 3){
                $this->request->getSession()->delete("competitorDt");
                $this->request->getSession()->delete("openedExam".$exam->id);
                $this->Flash->default(__('competition_expired'));
                return $this->redirect(["controller"=>"Exams", "action"=>"view", $exam->slug]);
            }
            for($i=0; $i<count($currentCompetition['competitors']); $i++){
                $currentCompetition['competitors'][$i]['competitor_configs'] = json_decode($currentCompetition['competitors'][$i]['competitor_configs']);
            }
        }
        
        if(!empty(@$competitorDt)){
            $isFounder = $competitorDt->competitor_configs->isFounder;
        }else{
            $competitorDt=["id"=>-1];
        }
//        debug($competitorDt);die();
        $this->set(compact('exam', 'metaDt', 'cmptId', 'isInv', 'currentCompetition', 'competitorDt', 'isFounder', 'exExample'));
    }*/
    
    public function save($id = -1) 
    {
        $this->autoRender  = false;
        $dt = json_decode( file_get_contents('php://input'), true);
        if($id > -1){
            $exam = $this->Exams->get($id);
            $oldImage = empty($exam->seo_image) ? '' : $exam->seo_image;
        }else{
            $exam = $this->Exams->newEntity();
        }
        if(!empty($dt['img']['tmp_name'])){
            $fname = time();
            $thumb_params = array(
                array('doThumb'=>true, 'w'=>450, 'h'=>450, 'dst'=>'thumb')
                );
            if($this->Images->uploader('img/exams_photos', $dt['img'], $fname, $thumb_params)){
                if(!empty($oldImage)){
                    $this->Images->deleteFile('img/exams_photos', $oldImage);
                }
                $dt['seo_image']=$this->Images->getPhotoNames();
            }
        }
        $exam = $this->Exams->patchEntity($exam, $dt);
        $exam->exam_configs = json_encode($dt['exam_configs']);

        if ($newRec = $this->Exams->save($exam)) {
            echo json_encode(["status"=>"SUCCESS", "data"=>$newRec]); die();
        }
        echo json_encode(["status"=>"SUCCESS", "data"=>$exam->getErrors()]); die();
    }
    
    function beforeFilter(Event $event) 
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['getpoll', 'answer', 'save', 'games', 'game']);
    }
}
