<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

class TagsController extends AppController
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
            $conditions['Tags.stat_created > '] = $_from;
        }
        if( !empty($_to) ){
            $conditions['Tags.stat_created < '] = $_to;
        }
        if($_k !== false){
            $_method == 'like' ?  $conditions[$_col.' LIKE '] = '%'.$_k.'%' : $conditions['Tags.'.$_col] = $_k;
        }
        $this->paginate = [ 
            'order'=>[ $_col => $_dir ],
            'conditions' => $conditions,
        ];
        $tags = $this->paginate($this->Tags);

        foreach($tags->toArray() as &$tag){
            $tag->stat_created = !empty($tag->stat_created) ? $tag->stat_created->format('Y-m-d H:i:s') : null;
        }

        if($this->request->getQuery('ajax') == '1'){
            echo json_encode([
                "status"=>"SUCCESS", 
                "data"=>$tags, 
                "paging"=>$this->Paginator->getPagingParams()["Tags"]], JSON_UNESCAPED_UNICODE); die();
        }
    }
    
    public function view($id = null)
    {
        $tag = $this->Tags->get($id, [
            'contain' => [],
        ]);
        $this->set('tag', $tag);
    }

    public function add()
    {
        $tag = $this->Tags->newEntity();
        if ($this->request->is('post')) {
            $tag = $this->Tags->patchEntity($tag, $this->request->getData());
            $tag->stat_created = date("Y-m-d H:i:s");
            $tag->rec_state = 1;
            if ($this->Tags->save($tag)) {
                $this->Flash->success(__('save-success'));
                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('save-fail'));
        }
        $this->set(compact('tag'));
    }

    public function edit($id = null)
    {
        $tag = $this->Tags->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tag = $this->Tags->patchEntity($tag, $this->request->getData());
            if ($this->Tags->save($tag)) {
                $this->Flash->success(__('The tag has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tag could not be saved. Please, try again.'));
        }
        $this->set(compact('tag'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        if(!$this->_isAuthorized(true)){
            echo json_encode( ["status"=>"FAIL", "data"=>"no-auth"] );
            die();
        }
        $delRec = $this->Tags->deleteAll(['id IN ' => explode(",", $id)]);
        
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
    
    public function search($val)
    {
        $this->autoRender = false;
        $tags = $this->Tags->find("all");
        $res = [];
        foreach($tags as $tag){
            $lev = levenshtein($tag->tag, $val);
            $similar = similar_text($tag->tag, $val, $percentage);
//            $sound = soundex($tag->tag) == soundex($val);
            if($percentage > 70){
                $res[] = $tag;
            }elseif($lev < 3){
                $res[] = $tag;
            }
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);die();
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
            $dt= $this->Tags->newEntity();;
            $dt["id"] = $rec;
            $dt["rec_state"] = $val;
            if(!$this->Tags->save($dt)){
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
