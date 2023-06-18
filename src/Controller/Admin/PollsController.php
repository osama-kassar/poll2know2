<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\I18n\Time;
Time::setToStringFormat('YYYY-MM-dd');

class PollsController extends AppController
{
    
    public function index()
    {

        $_from = !empty($_GET['from']) ? $_GET['from'] : '';
        $_to = !empty($_GET['to']) ? $_GET['to'] : '';

        $_method = !empty($_GET['method']) ? $_GET['method'] : '';

        $_dir = !empty($_GET['direction']) ? $_GET['direction'] : 'DESC';
        $_col = !empty($_GET['col']) ? $_GET['col'] : 'id';
        $_k = isset($_GET['k']) ? $_GET['k'] : false;

        $_page = !empty($_GET['page']) ? $_GET['page'] : 1;
        
        $conditions = ["exam_id"=>0];
        if( !empty($_from) ){
            $conditions['Polls.stat_created > '] = $_from;
        }
        if( !empty($_to) ){
            $conditions['Polls.stat_created < '] = $_to;
        }
        if($_k !== false){
            $_method == 'like' ?  $conditions[$_col.' LIKE '] = '%'.$_k.'%' : $conditions['Polls.'.$_col] = $_k;
        }

        $this->paginate = [ 
            'order'=>[ $_col => $_dir ],
            'conditions' => $conditions,
            'contain' => ['Users']
        ];

        $polls = $this->paginate($this->Polls);
        foreach($polls->toArray() as &$poll){
            $poll->poll_configs = json_decode($poll->poll_configs);
            $poll->stat_created = !empty($poll->stat_created) ? $poll->stat_created->format('Y-m-d H:i:s') : null;
        }

        if($this->request->getQuery('ajax') == '1'){
            echo json_encode([
                "status"=>"SUCCESS", 
                "data"=>$polls, 
                "paging"=>$this->Paginator->getPagingParams()["Polls"]], JSON_UNESCAPED_UNICODE); die();
        }

        $users = $this->Polls->Users->find('list');

        $this->set(compact('polls', 'users'));
    }
    
    public function hits($id = null)
    {
        
        $from = empty($this->request->getQuery('from')) ? date('Y-m-d H:i:s' ,strtotime('first day of this month')) : $this->request->getQuery('from');
        $to = empty($this->request->getQuery('to')) ? date('Y-m-d H:i:s') : $this->request->getQuery('to');

        $options = [
            'conditions'=>['Hits.rec_state' => 1],
            'contain'=>[ 'Polls.Options' ],
            'fields'=>[
                'id',
                'option_id'=>'Hits.option_id',
                'language_id'=>'Polls.language_id', 
                'stat_ispoll'=>'Polls.stat_ispoll', 
                'poll_title'=>'Polls.poll_title', 
                'stat_views'=>'Polls.stat_views', 
                'stat_shares'=>'Polls.stat_shares', 
                'rec_state'=>'Polls.rec_state',
                'stat_created'=>'Hits.stat_created', 
            ],
            'order'=>['Hits.id'=>'DESC']
        ];
        $q_polls = $this->getTableLocator()->get('Hits')->find('all', $options);
        
        $polls = $this->Do->convertJson( $this->paginate( $q_polls ) );
        
        if($this->request->getQuery('ajax') == '1'){
            echo json_encode([
                "status"=>"SUCCESS", 
                "data"=>$polls, 
                "paging"=>$this->Paginator->getPagingParams()["Hits"]], JSON_UNESCAPED_UNICODE); die();
        }
    }

    public function view($id = null)
    {
        $poll = $this->Polls->get($id, [
            'contain' => ['Options'],
        ]);
        if ($this->request->getQuery('ajax') == '1') {
            $this->autoRender = false;
            $poll->stat_publish_at = @date_format($poll->stat_publish_at, "Y-m-d H:i:s");
            $poll->stat_created = @date_format($poll->stat_created, "Y-m-d H:i:s");
            $poll->poll_configs = json_decode($poll->poll_configs);
            $poll->poll_type = (string)$poll->poll_type;
            
            for($i=0; $i<count($poll->options); $i++){
                $poll->options[$i]->option_configs = json_decode($poll->options[$i]->option_configs);
            }
            echo json_encode($poll, JSON_UNESCAPED_UNICODE);die();
        }
        $this->set('poll', $poll);
    }
    
    public function add()
    {
        $poll = $this->Polls->newEntity();
        if ($this->request->is('post')) {
            
            
            $dt = $this->request->getData();
            $dt['seo_image'] = '';
            
            if(!empty($_FILES['seo_image']['name'])){
                $fname = time();
                $img = $_FILES['seo_image'];
                $thumb_params = array(
                    array('doThumb'=>true, 'w'=>450, 'h'=>450, 'dst'=>'thumb')
                    );
                if($this->Images->uploader('img/polls_photos', $img, $fname, $thumb_params)){
                    if(!empty($oldImage)){
                        $this->Images->deleteFile('img/polls_photos', $oldImage);
                    }
                    $dt['seo_image']=$this->Images->getPhotoNames();
                }
            }
            $poll = $this->Polls->patchEntity($poll, $dt);
            $poll->slug = $this->Do->slugger($poll->poll_title);
            $poll->poll_configs = json_encode($this->request->getData("poll_configs"));
            $poll->rec_state = 0;
            $poll->seo_desc = $poll->poll_text;
            
//            debug($poll);die();
            $newRec = $this->Polls->save($poll);
            if ($newRec) {
                $this->Flash->success(__('save-success'));
                return $this->redirect(['action' => 'edit', $newRec->id]);
            }
            $this->Flash->error(__('save-fail'));
        }
        $categories = $this->Do->lcl($this->loadModel('Categories')->find('list')->where(["parent_id"=>3]));
        $this->set(compact('poll', 'categories'));
    }
    
    public function duplicate($id = null)
    {
        $this->autoRender = false;
        
        if ($this->request->is('post')) {
            
            $masterPoll = $this->Polls->get($id,[
                'contain'=>[ 'Options']
            ]);
            $lng = $this->request->getQuery('l');
            $poll = $masterPoll;
            $poll->poll_title = $poll->poll_title.'_'.strtoupper($lng).'_copy';
            $poll->slug = $poll->slug.'_'.strtoupper($lng).'_copy';
            $poll->stat_created = date("Y-m-d H:i:s");
            $poll->rec_state = 0;
            $poll->state_views = 0;
            $poll->state_shares = 0;
            $poll->language_id = $this->Do->get('langs_ids')[$lng];
            
            $pollCopy = $this->Polls->newEntity();
            $pollCopy = $this->Polls->patchEntity($pollCopy, $poll->toArray(), [
                'associated'=>[ 'Options' ]
            ]);
            
            if( $newPoll = $this->Polls->save($pollCopy, [
                'associated'=>[ 'Options' ]
            ]) ){
                $this->Flash->success(__('duplicate-success'));
                $this->redirect(['action'=>'index']);
            }else{
                $this->Flash->error(__('duplicate-fail'));
                debug($pollCopy->getErrors());
            }   
        }
    }
    
    public function edit($id = null) 
    {
        $poll = $this->Polls->get($id, [
            'contain' => [],
        ]);
        
        $poll->poll_configs = json_decode($poll->poll_configs, true);
        $poll->stat_publish_at = !empty($poll->stat_publish_at) ? 
            @date_format($poll->stat_publish_at, "Y-m-d H:i:s") :
        $poll->stat_publish_at;
        $oldImage = $poll->seo_image;
        if ($this->request->is(['patch', 'post', 'put'])) {
            
            $dt = $this->request->getData();
            unset($dt['seo_image']);
            
            if(!empty($_FILES['seo_image']['name'])){
                $fname = time();
                $img = $_FILES['seo_image'];
                $thumb_params = array(
                    array('doThumb'=>true, 'w'=>450, 'h'=>450, 'dst'=>'thumb')
                    );
                if($this->Images->uploader('img/polls_photos', $img, $fname, $thumb_params)){
                    if(!empty($oldImage)){
                        $this->Images->deleteFile('img/polls_photos', $oldImage);
                    }
                    $dt['seo_image']=$this->Images->getPhotoNames();
                }
            }
            $poll = $this->Polls->patchEntity($poll, $dt);
            $poll->poll_configs = json_encode($this->request->getData('poll_configs'));
            
            if ($this->Polls->save($poll)) {
                $this->Flash->success(__('save-success'));

                return $this->redirect($this->referer());
            }
            $this->Flash->error(__('save-fail'));
        }
        
        $categories = $this->Do->lcl( $this->loadModel('Categories')->find('list')->where(["parent_id"=>3]) );
        
        $users = $this->loadModel('Users')
            ->find("list")
            ->where(["user_role LIKE"=>"admin.%", "rec_state"=>1]);
        
        $this->set(compact('poll', 'categories', 'users'));
    }
    
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        if(!$this->_isAuthorized(true)){
            echo json_encode( ["status"=>"FAIL", "data"=>"no-auth"] );
            die();
        }
        $delRec = $this->Polls->deleteAll(['id IN ' => explode(",", $id)]);
        
        if ($this->request->getQuery('ajax') == '1') {
            if ($delRec) {
                $res = ["status"=>"SUCCESS", "data"=>$delRec];
            }else{
                $res = ["status"=>"FAIL", "data"=>$delRec->getErrors()];
            }
            echo json_encode($res);die();
        }else{
            if ($delRec) {
                $this->Flash->success(__('delete-success'));
            } else {
                $this->Flash->error(__('delete-fail'));
            }
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function enable($val=1, $id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        if(!$this->_isAuthorized(true)){
            echo json_encode( ["status"=>"FAIL", "data"=>"no-auth"] ); die();
        }
        $records = explode(",",$id);
        $errors=[];
        foreach($records as $rec){
            if(!is_numeric($rec)){continue;}
            $dt= $this->Polls->newEntity();;
            $dt["id"] = $rec;
            $dt["rec_state"] = $val;
            if(!$this->Polls->save($dt)){
                $errors[] = $dt->getErrors();
            }
        }
        
        if ($this->request->getQuery('ajax') == '1') {
            if (empty($errors)) {
                $res = ["status"=>"SUCCESS", "data"=>$dt];
            }else{
                $res = ["status"=>"FAIL", "data"=>$dt->getErrors()];
            }
            echo json_encode($res);die();
        }else{
            if (empty($errors)) {
                $this->Flash->success(__('update-success'));
            } else {
                $this->Flash->error(__('update-fail'));
            }
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function save($id = -1) 
    {
        $this->autoRender  = false;
        $data = json_decode( file_get_contents('php://input'));
        if( $id > -1){
            $poll = $this->Polls->get($id, [
                'contain' => [],
            ]);
            unset($data->stat_created);
        }else{
            $poll = $this->Polls->newEntity();
            $data->slug = !empty($data->poll_title) ? $this->Do->slugger( $data->poll_title ) : "";
            $data->user_id = $this->authUser["id"];
            $data->stat_created = date("Y-m-d H:i:s");
            $data->seo_desc = !empty($data->poll_title) ? $data->poll_title : "";
            $data->seo_keywords = empty($data->seo_keywords) ? @$this->Do->keywordMaker( $data->poll_title.' '.$data->poll_text ) : $data->seo_keywords;
            $data->poll_tags = empty($data->poll_tags) ? @$this->Do->keywordMaker( $data->poll_title.' '.$data->poll_text ) : $data->poll_tags;
            $data->rec_state=1;
        }

        $data->poll_configs = empty($data->poll_configs) ? null : json_encode( $data->poll_configs );
        
        $poll = $this->Polls->patchEntity($poll, (array)$data);

        if ($newRec = $this->Polls->save($poll)) {
            $res = ["status"=>"SUCCESS", "data"=>$newRec];
        }else{
            $res = ["status"=>"FAIL", "data"=>$poll->getErrors()];
        }
        echo json_encode($res);die();
    }
}
