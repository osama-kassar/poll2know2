<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

class UsersController extends AppController
{
    
    public function dashboard()
    {
    }
    
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
            $conditions['Users.stat_created > '] = $_from;
        }
        if( !empty($_to) ){
            $conditions['Users.stat_created < '] = $_to;
        }
        if($_k !== false){
            $_method == 'like' ?  $conditions[$_col.' LIKE '] = '%'.$_k.'%' : $conditions['Users.'.$_col] = $_k;
        }
        $this->paginate = [ 
            'order'=>[ $_col => $_dir ],
            'conditions' => $conditions,
        ];
        $users = $this->paginate($this->Users);

        foreach($users->toArray() as &$user){
            $user->stat_lastlogin = !empty($user->stat_lastlogin) ? $user->stat_lastlogin->format('Y-m-d H:i:s') : null;
            $user->stat_created = !empty($user->stat_created) ? $user->stat_created->format('Y-m-d H:i:s') : null;
        }

        if($this->request->getQuery('ajax') == '1'){
            echo json_encode([
                "status"=>"SUCCESS", 
                "data"=>$users, 
                "paging"=>$this->Paginator->getPagingParams()["Users"]], JSON_UNESCAPED_UNICODE); die();
        }
    }

    public function view($id = null)
    {
        $user = $this->Users->get($id);
        $this->set('user', $user);
    }
    
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('save-success'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('save-fail'));
        }
        $this->set(compact('user'));
    }
    
    public function edit($id = null) 
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dt = $this->request->getData();
            if($user->password == $dt['password']){
                unset($dt['password']);
            }
            $user = $this->Users->patchEntity($user, $dt);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('save-success'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('save-fail'));
        }
        $this->set(compact('user'));
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
            $dt= $this->Users->newEntity();;
            $dt["id"] = $rec;
            $dt["rec_state"] = $val;
            if(!$this->Users->save($dt)){
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
