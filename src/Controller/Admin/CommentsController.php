<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

class CommentsController extends AppController
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
        
        $conditions=[];
        if( !empty($_from) ){
            $conditions['Comments.stat_created > '] = $_from;
        }
        if( !empty($_to) ){
            $conditions['Comments.stat_created < '] = $_to;
        }
        if($_k !== false){
            $_method == 'like' ?  $conditions[$_col.' LIKE '] = '%'.$_k.'%' : $conditions['Comments.'.$_col] = $_k;
        }
        
        $this->paginate = [ 
            'order'=>[ $_col => $_dir ],
            'conditions' => $conditions,
        ];

        $scores = $this->paginate($this->Comments);
        foreach($scores->toArray() as &$score){
            $score->score_configs = json_decode($score->score_configs);
            $score->stat_created = !empty($score->stat_created) ? $score->stat_created->format('Y-m-d H:i:s') : null;
        }

        if($this->request->getQuery('ajax') == '1'){
            echo json_encode([
                "status"=>"SUCCESS", 
                "data"=>$scores, 
                "paging"=>$this->Paginator->getPagingParams()["Comments"]], JSON_UNESCAPED_UNICODE); die();
        }
    }

    public function view($id = null)
    {
        $comment = $this->Comments->get($id);
        $this->set('comment', $comment);
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
            $dt= $this->Comments->newEntity();;
            $dt["id"] = $rec;
            $dt["rec_state"] = $val;
            if(!$this->Comments->save($dt)){
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
