<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

class ContactsController extends AppController
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
            $conditions['Contacts.stat_created > '] = $_from;
        }
        if( !empty($_to) ){
            $conditions['Contacts.stat_created < '] = $_to;
        }
        if($_k !== false){
            $_method == 'like' ?  $conditions[$_col.' LIKE '] = '%'.$_k.'%' : $conditions['Contacts.'.$_col] = $_k;
        }
        
        $this->paginate = [ 
            'order'=>[ $_col => $_dir ],
            'conditions' => $conditions,
        ];

        $scores = $this->paginate($this->Contacts);
        foreach($scores->toArray() as &$score){
            $score->score_configs = json_decode($score->score_configs);
            $score->stat_created = !empty($score->stat_created) ? $score->stat_created->format('Y-m-d H:i:s') : null;
        }

        if($this->request->getQuery('ajax') == '1'){
            echo json_encode([
                "status"=>"SUCCESS", 
                "data"=>$scores, 
                "paging"=>$this->Paginator->getPagingParams()["Contacts"]], JSON_UNESCAPED_UNICODE); die();
        }
    }


    public function view($id = null)
    {
        $contact = $this->Contacts->get($id);
        $this->set('contact', $contact);
    }

}
