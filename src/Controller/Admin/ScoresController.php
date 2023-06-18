<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

class ScoresController extends AppController
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
            $conditions['Scores.stat_created > '] = $_from;
        }
        if( !empty($_to) ){
            $conditions['Scores.stat_created < '] = $_to;
        }
        if($_k){
            $_method == 'like' ?  $conditions[$_col.' LIKE '] = '%'.$_k.'%' : $conditions['Scores.'.$_col] = $_k;
        }
        
        $this->paginate = [ 
            'order'=>[ $_col => $_dir ],
            'conditions' => $conditions,
            'contain'=>[ 'Exams'=>['fields'=>['id', 'exam_title']]]
        ];

        $scores = $this->paginate($this->Scores);
        foreach($scores->toArray() as &$score){
            $score->score_configs = json_decode($score->score_configs);
            $score->stat_created = !empty($score->stat_created) ? $score->stat_created->format('Y-m-d H:i:s') : null;
        }
        // debug(count($scores));
        // debug(($conditions));
        // debug(($this->Paginator->getPagingParams()["Scores"]));

        if($this->request->getQuery('ajax') == '1'){
            echo json_encode([
                "status"=>"SUCCESS", 
                "data"=>$scores, 
                "paging"=>$this->Paginator->getPagingParams()["Scores"]], JSON_UNESCAPED_UNICODE); die();
        }
        $this->set(compact('scores'));
    }
    
    // public function index()
    // {
    //     $conditions = [];
    //     if(!empty($this->request->getQuery('tar'))){
    //         $conditions['Scores.exam_id'] = $this->request->getQuery('tar');
    //     }
    //     if(!empty($this->request->getQuery('from'))){
    //         $conditions['Scores.stat_created >= '] = $this->request->getQuery('from');
    //     }
    //     if(!empty($this->request->getQuery('to'))){
    //         $conditions['Scores.stat_created <= '] = $this->request->getQuery('to');
    //     }
    //     if(!empty($this->request->getQuery('key'))){
    //         $conditions['OR'][] = ['user_ip LIKE ' => '%'.$this->request->getQuery('key').'%'];
    //         $conditions['OR'][] = ['user_name LIKE '=>'%'.$this->request->getQuery('key').'%'];
    //     }
        
    //     $scores = $this->paginate($this->Scores, [
    //         'conditions' => $conditions, 
    //         'order'=>['id'=>'DESC'],
    //         'contain'=>['Exams'=>['fields'=>['id', 'exam_title']]]
    //     ]);
    //     $targetList = $this->loadModel('Exams')
    //         ->find('list');
    //     $this->set(compact('scores', 'targetList'));
    // }

    public function view($id = null)
    {
        $score = $this->Scores->get($id);
        $this->set('score', $score);
    }

}
