<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

class MatchesController extends AppController
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
            $conditions['Matches.stat_created > '] = $_from;
        }
        if( !empty($_to) ){
            $conditions['Matches.stat_created < '] = $_to;
        }
        if($_k !== false){
            $_method == 'like' ?  $conditions[$_col.' LIKE '] = '%'.$_k.'%' : $conditions['Matches.'.$_col] = $_k;
        }
        
        $this->paginate = [ 
            'order'=>[ $_col => $_dir ],
            'conditions' => $conditions,
            'contain' => ["Exams", "Score1", "Score2"]
        ];
        $matches = $this->paginate($this->Matches);
        foreach($matches->toArray() as &$match){
            $match->stat_created = !empty($match->stat_created) ? $match->stat_created->format('Y-m-d H:i:s') : null;
        }

        if($this->request->getQuery('ajax') == '1'){
            echo json_encode([
                "status"=>"SUCCESS", 
                "data"=>$matches, 
                "paging"=>$this->Paginator->getPagingParams()["Matches"]], JSON_UNESCAPED_UNICODE); die();
        }
    }

    public function view($id = null)
    {
        $match = $this->Matches->get($id, [
            "contain"=>["Exams", "Score1", "Score2"]
        ]);
        $this->set('match', $match);
    }

}
