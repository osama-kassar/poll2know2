<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;


class CommentsController extends AppController
{
    
    public function add()
    {
        $this->autoRender = false;
        $comment = $this->Comments->newEntity();
        
        if ($this->request->is('post')) {
            
            $dt = json_decode(file_get_contents('php://input'), true);
            if(!empty( $this->Auth->User("id") )){
                $dt['comment_username'] =  $this->Auth->User("user_fullname");
                $dt['comment_useremail'] = $this->Auth->User("email");
            }
            $comment = $this->Comments->patchEntity($comment, $dt);
            $comment->user_id = empty( $this->Auth->User("id") ) ? 0 :  $this->Auth->User("id");
            $comment->comment_info = $this->Do->getUinfo();
            $comment->stat_created = date("Y-m-d H:i:s");
            $comment->stat_ip = $_SERVER['REMOTE_ADDR'];
            $comment->rec_state = 0;
            if ($ewRec = $this->Comments->save($comment)) {
                echo json_encode(["status"=>"SUCCESS", "data"=>$ewRec]); die();
            }
            echo json_encode(["status"=>"FAIL", "data"=>$comment->getErrors()]);  die();
        }
    }
    
    function beforeFilter(Event $event) 
    {
        parent::beforeFilter($event);
        $this->Auth->allow('add');
    }
}
