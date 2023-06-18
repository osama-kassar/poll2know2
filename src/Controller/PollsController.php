<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;

class PollsController extends AppController
{

    public function index($keyword=null, $category_id=null)
    {
        $conditions = $relatedCond = ["language_id"=>$this->currlangid];
        // $conditions['exam_id'] = 0;
        $conditions['stat_ispoll'] = 1;
        if(!empty( $category_id )  && $category_id!=-1){
            $conditions['category_id'] = $category_id;
            $relatedCond['category_id'] = $category_id;
        }
        
        if(!empty( $keyword ) && $keyword!=-1){
            $conditions['OR'][] = ["poll_tags LIKE" => "%".$keyword."%"];
            $conditions['OR'][] = ["poll_title LIKE" => "%".$keyword."%"];
            $conditions['OR'][] = ["poll_text LIKE" => "%".$keyword."%"];
        }
        
        $this->paginate = [ ];
        $polls = $this->paginate($this->Polls, [
            "conditions"=>$conditions,
            "order"=>["id"=>"DESC"]
        ]);
        
        $related = $this->loadModel('Exams')
            ->find()
            ->where($relatedCond)
            ->limit(6)
            ->order(["id"=>"DESC"]);
        $this->set(compact('polls', 'related'));
    }
    
    public function me()
    {
        $this->paginate = [
//            'contain' => ['Exams']
        ];
        $polls = $this->paginate($this->Polls, [
            'order'=>['id'=>'DESC']
        ]);
        $this->set(compact('polls'));
    }
    
    public function view($slug = null)
    {
        $poll = $this->Polls->find('all', [
            'conditions' => ['slug'=>$slug, 'language_id'=>$this->currlangid],
            'contain' => ['Options', 'Comments' => [
                                'conditions' => [ 'rec_state' => 1 ]
                            ]
                         ]
        ])->first();
        if(empty($poll)){
//            return $this->render('/errors/404/');
//            $this->render('/error/error404');
            throw new NotFoundException();
        }
        
        $poll->poll_configs = json_decode($poll->poll_configs);
        for($i=0; $i<count($poll->options); $i++){
            $poll->options[$i]->isHitted = $this->Do->isHitted($poll->options[$i], "option");
            $poll->options[$i]->option_configs = json_decode($poll->options[$i]->option_configs);
        }
        // add hits
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            return $this->_addhits($data);
        }
        
//        $this->Do->adder(['id'=>$poll->id*1, 'stat_views'=>intval($poll->stat_views+1)], 'Polls');
        
        $related = $this->Polls->find("all", [
            "conditions"=>["category_id" => $poll->category_id]
        ]);
        $poll->isHitted = $this->Do->isHitted($poll);
        $poll->userHitId = $this->Do->getHit($poll);
        if($this->request->getQuery('ajax') == '1'){
            echo json_encode($poll);die();
        }
        
        $img = $poll->seo_image == null ? "/img/think".rand(0,4).".jpg" : "/img/polls_photos/thumb/".$poll->seo_image;
        $metaDt = [ 
            "_title"=>$poll->poll_title, 
            "_keywords"=>$poll->seo_keywords, 
            "_description"=>strip_tags($poll->poll_text), 
            "_photo"=>$img,
            "_created"=>$poll->stat_created, 
            "_modified"=>$poll->stat_created
        ];
        
        
        $chartsObj = json_encode([$this->Do->setChartObj($poll)], JSON_UNESCAPED_UNICODE);        
        $this->set(compact('poll', 'related', 'metaDt', 'chartsObj'));
    }

    public function add()
    {
        $poll = $this->Polls->newEntity();
        if ($this->request->is('post')) {
            $poll = $this->Polls->patchEntity($poll, $this->request->getData());
            $poll['stat_ispoll'] = 1;
            if ($this->Polls->save($poll)) {
                $this->Flash->success(__('The poll has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The poll could not be saved. Please, try again.'));
        }
        $languages = $this->Polls->Languages->find('list', ['limit' => 200]);
        $users = $this->Polls->Users->find('list', ['limit' => 200]);
        $categories = $this->Polls->Categories->find('list', ['limit' => 200]);
        $exams = $this->Polls->Exams->find('list', ['limit' => 200]);
        $this->set(compact('poll', 'languages', 'users', 'categories', 'exams'));
    }
    
    public function edit($id = null)
    {
        $poll = $this->Polls->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $poll = $this->Polls->patchEntity($poll, $this->request->getData());
            if ($this->Polls->save($poll)) {
                $this->Flash->success(__('The poll has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The poll could not be saved. Please, try again.'));
        }
        $languages = $this->Polls->Languages->find('list', ['limit' => 200]);
        $users = $this->Polls->Users->find('list', ['limit' => 200]);
        $categories = $this->Polls->Categories->find('list', ['limit' => 200]);
        $exams = $this->Polls->Exams->find('list', ['limit' => 200]);
        $this->set(compact('poll', 'languages', 'users', 'categories', 'exams'));
    }
    
    private function _addhits($dt = null) 
    {
        $this->autoRender  = false;
        $data = $dt == null ? json_decode( file_get_contents('php://input') ) : (object)$dt;
        
        if($data->poll["poll_type"] == 3 && count($data->poll["options"]) < $data->poll["total_options"]){
            $this->Flash->error(__('rate_all_options'));
            return $this->redirect($this->referer());
        }
        $data->options_values=[];
        if(is_array($data->poll['options'])){
            if($data->poll['poll_type'] == 3){
                $data->options = array_keys($data->poll['options']);
            }else{
                $data->options = array_values($data->poll['options']);
            }    
            $data->options_values = array_values((array)$data->poll['options']);
        }else{
            $data->options = [$data->poll['options']];
        }
        
        for($i=0; $i<count( $data->options ); $i++){
            $dt = [
                "id"=>null,
                "user_id"=> empty( $this->Auth->User("id") ) ? 0 :  $this->Auth->User("id"),
                "poll_id"=> $data->poll['id'],
                "option_id"=> $data->options[$i],
                "hit_userinfo"=> $this->Do->getUinfo(),
                "hit_ip"=> $_SERVER['REMOTE_ADDR'],
                "rec_state"=>1,
                'hit_answer' => !empty($data->options_values[$i]) ? $data->options_values[$i] : ''
            ];
            // Create new hit 
            if($this->Do->adder($dt, "Hits") ){
                // debug($data->options);
                $opt = $this->loadModel("Options")->get($data->options[$i]);
                $options = $this->loadModel("Hits")->find("all", [
                    "fields"=>["id", "hit_answer"],
                    "conditions"=>[ "option_id"=>$data->options[$i] ]
                ]);
                
                $opt->stat_hits = $options->count();
                if($data->poll['poll_type'] == 3){
                    $opt->stat_totalrate = !empty($data->options_values[$i]) ? $this->Do->calcRate( $options ) : '';
                }
                // Update option hits number
                if($this->Do->adder($opt->toArray(), "Options") ){
                    $totalhits = $this->loadModel("Hits")->find("all", [
                        "conditions"=>["poll_id"=>$opt->poll_id]
                    ])->count();
                    if($this->Do->adder(["id"=>$opt->poll_id, "stat_hits"=>$totalhits], "Polls") ){
                        if($this->request->getQuery('ajax') == 1){
                            echo json_encode(["status"=>"SUCCESS"]);
                        }
                    }
                }
            }
        }
        if($this->request->getQuery('ajax') == 1){
            die();
        }else{
            $this->redirect($this->referer());
        }
    }
}
