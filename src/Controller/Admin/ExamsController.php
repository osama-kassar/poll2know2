<?php
namespace App\Controller\Admin;
use App\Controller\AppController;

class ExamsController extends AppController
{
    
    public function index()
    {

        $_from = !empty($_GET['from']) ? $_GET['from'] : '';
        $_to = !empty($_GET['to']) ? $_GET['to'] : '';

        $_method = !empty($_GET['method']) ? $_GET['method'] : '';

        $_dir = !empty($_GET['direction']) ? $_GET['direction'] : 'DESC';
        $_col = !empty($_GET['col']) ? $_GET['col'] : 'id';
        $_k = (isset($_GET['k']) && strlen($_GET['k'])>0) ? $_GET['k'] : false;

        $_page = !empty($_GET['page']) ? $_GET['page'] : 1;
        
        $conditions=[];
        if( !empty($_from) ){
            $conditions['Exams.stat_created > '] = $_from;
        }
        if( !empty($_to) ){
            $conditions['Exams.stat_created < '] = $_to;
        }
        if($_k !== false){
            $_method == 'like' ?  $conditions[$_col.' LIKE '] = '%'.$_k.'%' : $conditions['Exams.'.$_col] = $_k;
        }
        $this->paginate = [ 
            'order'=>[ $_col => $_dir ],
            'conditions' => $conditions,
            'contain' => [
                'Users', 
                // 'Polls'=>['fields'=>['Polls.id', 'Polls.exam_id']],
                'Polls' => function($q) {
                    $q->select([
                         'Polls.exam_id',
                         'polls_count' => $q->func()->count('Polls.exam_id')
                    ])
                    ->group(['Polls.exam_id']);
                    return $q;
                }
            ]
        ];
        $exams = $this->paginate($this->Exams);

        // debug($exams);
        // debug($conditions);
// die();
        foreach($exams->toArray() as &$exam){
            $exam->exam_polls_count = isset($exam->polls[0]->polls_count) ? $exam->polls[0]->polls_count : 0;
            $exam->exam_configs = json_decode($exam->exam_configs);
            $exam->stat_created = !empty($exam->stat_created) ? $exam->stat_created->format('Y-m-d H:i:s') : null;
        }

        if($this->request->getQuery('ajax') == '1'){
            echo json_encode([
                "status"=>"SUCCESS", 
                "data"=>$exams, 
                "paging"=>$this->Paginator->getPagingParams()["Exams"]], JSON_UNESCAPED_UNICODE); die();
        }

        $users = $this->Exams->Users->find('list');

        $this->set(compact('users'));
    }

    public function view($id = null)
    {
        $exam = $this->Exams->get($id, [
            'contain' => ['Users', 'Polls', 'Polls.Options', "Results"],
        ]);
        if ($this->request->getQuery('ajax') == '1') {
            $this->autoRender = false;
            $polls=[];
            for($i=0; $i<count($exam->polls); $i++){
                $exam->event_id = (string)$exam->event_id;
                $exam->polls[$i]->poll_configs = json_decode($exam->polls[$i]->poll_configs);
                $exam->polls[$i]->poll_type = (string)$exam->polls[$i]->poll_type;
                for($j=0; $j<count($exam->polls[$i]->options); $j++){
                    $exam->polls[$i]->options[$j]->option_configs = json_decode($exam->polls[$i]->options[$j]->option_configs);
                    $exam->polls[$i]->options[$j]->option_configs->isCorrect = (string)$exam->polls[$i]->options[$j]->option_configs->isCorrect;
                }
            }
            echo json_encode($exam, JSON_UNESCAPED_UNICODE);die();
        }
        $this->set('exam', $exam);
    }

    public function add()
    {
        $exam = $this->Exams->newEntity();
        if ($this->request->is('post')) {
            $exam = $this->Exams->patchEntity($exam, $this->request->getData());
            $exam->slug = $this->Do->slugger($exam->exam_title);
            $exam->language_id = $this->currlangid;
            $exam->user_id = $this->authUser['id'];
            $exam->seo_desc = substr($exam->exam_desc, 0, 255);
//            $exam->seo_keywords = $this->Do->keywordMaker($exam->exam_title.' '.$exam->exam_desc);
//            $exam->poll_tags = $this->Do->keywordMaker($exam->exam_title.' '.$exam->exam_desc);
            $exam->stat_created = date("Y-m-d H:i:s");
            $exam->stat_publish_at = date("Y-m-d H:i:s");
            $exam->rec_state = 0;
            $uploadedPhoto=null;
            if(!empty($_FILES['seo_image']['name'])){
                $fname = time();
                $img = $_FILES['seo_image'];
                $thumb_params = array(
                    array('doThumb'=>true, 'w'=>450, 'h'=>450, 'dst'=>'thumb')
                    );
                if($this->Images->uploader('img/exams_photos', $img, $fname, $thumb_params)){
                    $uploadedPhoto=$this->Images->photosname[0];
                }
            }
            $exam->seo_image = $uploadedPhoto;
//            debug($exam);die();
            if ($newRec = $this->Exams->save($exam)) {
                $this->Flash->success(__('save-success'));
                return $this->redirect(['controller'=>'Exams', 'action' => 'edit', $newRec->id]);
            }
            $this->Flash->error(__('save-fail'));
        }
        $categories = $this->Do->lcl($this->loadModel('Categories')->find('list')->where(["parent_id"=>3]));
        $this->set(compact('exam', 'categories'));
    }
    
    public function duplicate($id = null)
    {
        $this->autoRender = false;
        
        if ($this->request->is('post')) {
            
            $masterExam = $this->Exams->get($id,[
                'contain'=>[ 'Results', 'Polls', 'Polls.Options']
            ]);
            $lng = $this->request->getQuery('l');
            $exam = $masterExam;
            $exam->exam_title = $exam->exam_title.'_'.strtoupper($lng).'_copy';
            $exam->slug = $exam->slug.'_'.strtoupper($lng).'_copy';
            $exam->exam_id = 0;
            $exam->stat_created = date("Y-m-d H:i:s");
            $exam->rec_state = 0;
            $exam->state_views = 0;
            $exam->state_shares = 0;
            $exam->language_id = $this->Do->get('langs_ids')[$lng];
            
            $examCopy = $this->Exams->newEntity();
            $examCopy = $this->Exams->patchEntity($examCopy, $exam->toArray(), [
                'associated'=>[ 'Results', 'Polls', 'Polls.Options' ]
            ]);
            
            if( $newExam = $this->Exams->save($examCopy, [
                'associated'=>[ 'Results', 'Polls', 'Polls.Options' ]
            ]) ){
                $this->Flash->success(__('duplicate-success'));
                $this->redirect(['action'=>'index']);
            }else{
                $this->Flash->error(__('duplicate-fail'));
                debug($examCopy->getErrors());
            }   
        }
    }

    public function edit($id = null)
    {
        $exam = $this->Exams->get($id, [
            'contain' => [],
        ]);
        $exam->exam_configs = json_decode($exam->exam_configs, true);
        $oldImage = $exam->seo_image;
        if ($this->request->is(['patch', 'post', 'put'])) {
            
            $dt = $this->request->getData();
            unset($dt['seo_image']);
            
            if(!empty($_FILES['seo_image']['name'])){
                $fname = time();
                $img = $_FILES['seo_image'];
                $thumb_params = array(
                    array('doThumb'=>true, 'w'=>450, 'h'=>450, 'dst'=>'thumb')
                    );
                if($this->Images->uploader('img/exams_photos', $img, $fname, $thumb_params)){
                    if(!empty($oldImage)){
                        $this->Images->deleteFile('img/exams_photos', $oldImage);
                    }
                    $dt['seo_image'] = $this->Images->getPhotoNames();
                }
            }
            $exam = $this->Exams->patchEntity($exam, $dt);
            
            $exam->exam_calc_method = $this->request->getData('exam_calc_method')*1;
            $exam->exam_configs = json_encode($this->request->getData('exam_configs'));
            
            if ($this->Exams->save($exam)) {
                $this->Flash->success(__('save-success'));
            }else{
                $this->Flash->error(__('save-fail'));
            }
        }
        $categories = $this->Do->lcl($this->loadModel('Categories')->find('list')->where(["parent_id"=>3]));
        $users = $this->loadModel('Users')
            ->find("list")
            ->where(["user_role LIKE"=>"admin.%", "rec_state"=>1]);
        $this->set(compact('exam', 'categories', 'users'));
    }

    public function delete($id = null)
    {
        
        if($this->authUser['user_role'] != 'admin.root'){
            if ($this->request->getQuery('ajax') == '1') {
                echo json_encode( ["status"=>"FAIL", "data"=>__('not_allowed')] ); die();
            }
            return $this->Flash->error(__('not_allowed'));
        }
        
        $this->request->allowMethod(['post', 'delete']);
        if(!$this->_isAuthorized(true)){
            echo json_encode( ["status"=>"FAIL", "data"=>"no-auth"] );
            die();
        }
        $ids = explode(",", $id);
        foreach($ids as $itm){
            $rec = $this->Exams->get($itm);
            $delRec = $this->Exams->delete($rec);
        }
        
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
            $dt= $this->Exams->newEntity();;
            $dt["id"] = $rec;
            $dt["rec_state"] = $val;
            if(!$this->Exams->save($dt)){
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
}
