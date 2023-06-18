<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class ScoresController extends AppController
{
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Exams'],
        ];
        $scores = $this->paginate($this->Scores);

        $this->set(compact('scores'));
    }
    
    public function view($id = null)
    {
        $score = $this->Scores->get($id, [
            'contain' => ['Exams.Results', 'Exams.Polls.Options'],
        ]);
//        if($score->exam->exam_calc_method == 3){
//            $match = $this->loadModel('Matches')->find("all", [
//                "conditions"=>[
//                    "OR"=>["match_score1" => $id, "match_score2" => $id]
//                ]
//            ])->first();
////            debug($match->toArray());die(); 
//            if($match){
//                return $this->redirect(["controller"=>"Matches", "action"=>"view", $match->id]);
//            }
//        }
        $score->exam->exam_configs = json_decode($score->exam->exam_configs, true);
        $score->score_configs = json_decode($score->score_configs, true);
        
        // identify the user by is, session or ip
        $isExamOwner = false;
        if( 
            @$this->Auth->User("id") === $score->user_id || 
            $score->user_ip == $_SERVER['REMOTE_ADDR']
        ){
            $isExamOwner = true;
        }
        
        $hits = $this->loadModel("Hits")->find('all', [
            'conditions'=>["id IN "=>explode(',', $score->hits_ids )],
            'fields'=>['Hits.id', 'Hits.option_id', 'Hits.hit_answer']
        ]);
        
        // check options and pick WRONG & RIGHT answers
        $score->exam->polls = $this->Do->setHitted($score->exam->polls, $hits->toArray());
        
        // select random RESULT according to exam_calc_method
        if($score->exam->exam_calc_method == 1){
            if(!empty($score->exam->results)){
                $results_arr = [];
                foreach($score->exam->results as $result){
                    if($score->score_result*1 >= $result->result_min*1 && $score->score_result*1 <= $result->result_max*1){
                        $results_arr[] = $result;
                    }
                }
                $score->result = $results_arr[rand(0, count($results_arr)-1)];
            }else{
                $resInd = $score->score_result < 40 ? 1 : ( $score->score_result > 40 && $score->score_result < 75 ? 2 : 3 );
                $score->result = (object)[
                    "result_name"=>__("result_name_".$resInd),
                    "result_text"=>__("result_text_".$resInd)
                ];
            }
        }elseif($score->exam->exam_calc_method == 2){
            arsort($score->score_configs);
            $score->result = $this->loadModel('Results')->find("all")
                ->where(["id"=>key($score->score_configs)])
                ->first();
        }
        
        if($score->exam->exam_calc_method == 3 ){ 
            $metaDt = [ 
                "_title"=>$score->exam->exam_title, 
                "_keywords"=>$score->exam->seo_keywords, 
                "_description"=>strip_tags($score->exam->exam_desc), 
                "_photo"=>"/img/website_img.jpg"
            ];
        }else{
            $metaDt = [ 
                "_title"=>__('congrats').' '.$score->user_name.' '.__('you_pass').' '.$score->exam->exam_title, 
                "_keywords"=>$score->exam->seo_keywords, 
                "_description"=>strip_tags($score->result->result_text), 
                "_photo"=>"/img/website_img.jpg"
            ];   
        }
        // increase views
//        $this->Do->adder(['id'=>$score->id, 'stat_views'=>intval($score->stat_views+1)], 'Scores');
        $tags = explode(",", $score->exam->exam_tags);
        $related = $this->loadModel('Exams')->find("all")
            ->where([
                "language_id" => $this->currlangid,
                "NOT"=>["id" => $score->exam->id],
                "OR"=>[
                    "category_id" => $score->exam->category_id, 
                    "exam_tags LIKE"=>"%".$tags[0]."%"
                ],
            ])
            ->limit(12);
        
//        sql($related);die();
        
        $p = $this->request->getQuery('p');
        $k = empty($p) ? 0 : $p;
        if($p=='-1'){
            $score->exam->polls = [$score->exam->polls[0]];
        }elseif($k < count( $score->exam->polls )){
            $score->exam->polls = [$score->exam->polls[$k]];
        }else{
            $score->exam->polls = [$score->exam->polls[0]];
            $this->Flash->default(__('review_done'));
            $this->redirect(["action"=>"view", $score->id, "p"=>"0"]);
        }
        
        // debug($score);
        // $imgDt = [
        //     "text"=>[
        //         $score->user_name.' '.__('congrets_you_pass'),
        //         $score->exam->exam_title,
        //         __('your_degree').' '.$score->score_result.'%', 
        //         $score->result_name
        //     ], 
        //     "bg"=>"http://localhost/poll2know/img/certificate.jpg",
        //     "thumb"=>[['doThumb'=>true, 'w'=>200, 'h'=>200, 'dst'=>'thumb']]
        // ];
        // $imgDt["imgName"] = time().".".$this->Do->getExt($imgDt["bg"]);

        // if($res = $this->Images->creator('scores', $imgDt)){
        //     // debug($imgDt);
        //     // debug($res);
        // }
        $this->set(compact('score', 'hits', 'metaDt', 'isExamOwner', 'related'));
    }
    
    public function readylink($id = null)
    {
        return $this->view($id);
    }
    
    function beforeFilter(Event $event) 
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['readylink']);
    }
    
}
