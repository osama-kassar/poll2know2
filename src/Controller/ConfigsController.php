<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

use Cake\Datasource\ConnectionManager;

class ConfigsController extends AppController
{
    
    ////////////////////////////////////
    // GENErAL FUNCTIONS
    ////////////////////////////////////
    
    public function sharecounter()
    {
        $this->autoRender = false;
        $id = $_GET['id']; $mdl = $_GET['mdl'];
        if(empty($id) || empty($mdl)){ echo '0'; die();}
        $rec = $this->loadModel($mdl)->get($id);
        if(isset($rec->stat_shares)){
            $updt = $this->Do->adder(["id"=>$rec->id, "stat_shares"=>($rec->stat_shares*1)+1], $mdl);
            if($updt){echo '1';}else{echo '0';} die();
        }
        echo '0'; die();
    }

    public function upld()
    {
        $this->autoRender = false;
        if(!empty($_FILES['file']['name'])){
            $img = $_FILES['file'];
            $thumb_params = array(
                // array('doThumb'=>true, 'w'=>650, 'h'=>650, 'dst'=>'middle'),
                array('doThumb'=>true, 'w'=>300, 'h'=>300, 'dst'=>'thumb')
                );
            if($this->Images->uploader('img/'.$_GET["pth"].'_photos', $img, $_GET["fname"], $thumb_params)){
                if(!empty($_GET["del"])){
                    $this->Images->deleteFile('img/'.$_GET["pth"].'_photos', $_GET["del"]);
                }
                echo '{"status":"SUCCESS", "operation":"upload, delete"}';die();
            }
        }
        echo '{"status":"FAIL"}';die();
    }
    
    public function delfiles()
    {
        $this->autoRender = false;
        if($this->Images->deleteFile(null, $this->request->getData())){
            echo '{"status":"SUCCESS", "operation":"delete"}';die();
        }
        echo '{"status":"FAIL", "operation":"delete"}';die();
    }

    public function sess($key = null, $op='read', $val='')
    {
        $this->autoRender = false;
        $dt = $this->request->getSession()->$op($key, $val);
        echo json_encode(["status"=>"SESSION", "data"=>$dt]); die();
    }

    public function notifications()
    {
        if(!$this->_isAuthorized(true)){
            echo json_encode(["status"=>"FAIL", "data"=>"no-auth"]);die();
        }
        $this->autoRender = false;
        if($this->authUser["id"]){
            $conn = ConnectionManager::get('default');
            $lastlogin = $this->authUser['stat_lastlogin'];
            
            $q = $conn->execute("
                SELECT 
                    u.id, u.user_fullname, 
                    ( SELECT COUNT(*) FROM exams e 
                        WHERE e.stat_created >= \"$lastlogin\" ) AS 'new_".__('exams')."', 

                    ( SELECT COUNT(*) FROM polls p 
                        WHERE p.stat_created >= \"$lastlogin\" AND p.exam_id = 0) AS 'new_".__('polls')."',  

                    ( SELECT COUNT(*) FROM scores s 
                        WHERE s.stat_created >= \"$lastlogin\" ) AS 'new_".__('scores')."', 
                    
                    
                    ( SELECT COUNT(*) FROM hits h 
                        WHERE h.stat_created >= \"$lastlogin\" AND h.rec_state = 1) AS 'new_".__('polls_hits')."', 
                    
                    ( SELECT COUNT(*) FROM hits h 
                        WHERE h.stat_created >= \"$lastlogin\" AND h.rec_state = 2) AS 'new_".__('exams_hits')."', 
                    
                    ( SELECT COUNT(*) FROM hits h 
                        WHERE h.stat_created >= \"$lastlogin\" AND h.rec_state = 3) AS 'new_".__('competitions_hits')."', 


                    ( SELECT COUNT(*) FROM competitions cmpt 
                        WHERE cmpt.stat_created >= \"$lastlogin\" ) AS 'new_".__('competitions')."', 

                    ( SELECT COUNT(*) FROM comments cmnt 
                        WHERE cmnt.stat_created >= \"$lastlogin\" ) AS 'new_".__('comments')."', 

                    ( SELECT COUNT(*) FROM contacts c 
                        WHERE c.stat_created >=  \"$lastlogin\" ) AS 'new_".__('contacts')."'
                    
                    FROM users u WHERE u.id = ".$this->authUser["id"])->fetchAll('assoc');
            $notifications = $q[0];
            
            $notifications["total"]=0;
            foreach($notifications as $k=>$itm){
                if(strpos($k, "new_")!==false){
                    $notifications["total"]+=($itm*1);
                }
            }
            
            $from = empty($this->request->getQuery('from')) ? date('Y-m-d H:i:s' ,strtotime('first day of this month')) : $this->request->getQuery('from');
            $to = empty($this->request->getQuery('to')) ? date('Y-m-d H:i:s') : $this->request->getQuery('to');

            // Scores per exams
            $q_exams_per_day = $this->getTableLocator()->get('Scores')->find('all')
                ->where([ 'stat_created > '=> $from, 'stat_created < '=> $to, ]);

            // return $notifications;
            if(count($notifications)>2){
                echo json_encode(["status"=>"SUCCESS", "data"=>$notifications]);
            }else{
                debug($q);
            }
        }
    }

    public function statistics()
    {
        $this->autoRender = false;
        
        $from = empty($this->request->getQuery('from')) ? date('Y-m-d H:i:s' ,strtotime('first day of this month')) : $this->request->getQuery('from');
        $to = empty($this->request->getQuery('to')) ? date('Y-m-d H:i:s') : $this->request->getQuery('to');

        if($this->authUser["id"]){
            $conn = ConnectionManager::get('default');

            // NUMBERS
            $q_numbers = $conn->execute("
                SELECT
                    ( SELECT COUNT(*) FROM exams e WHERE e.rec_state = 1  ) AS 'total_active_exams',
                    ( SELECT COUNT(*) FROM exams e WHERE e.rec_state = 0  ) AS 'total_inactive_exams',
                    ( SELECT COUNT(*) FROM exams e WHERE e.exam_calc_method = 1  ) AS 'total_prcntg_exams',
                    ( SELECT COUNT(*) FROM exams e WHERE e.exam_calc_method = 2  ) AS 'total_count_exams',
                    ( SELECT COUNT(*) FROM exams e WHERE e.exam_calc_method = 3  ) AS 'total_game_exams',
                    ( SELECT COUNT(*) FROM polls p WHERE p.stat_ispoll = 1 AND  p.rec_state = 1  ) AS 'total_active_polls',
                    ( SELECT COUNT(*) FROM polls p WHERE p.stat_ispoll = 1 AND  p.rec_state = 0  ) AS 'total_inactive_polls',
                    ( SELECT COUNT(*) FROM scores s ) AS 'total_scores',
                    ( SELECT COUNT(*) FROM scores s WHERE s.stat_created > '$from' AND s.stat_created < '$to'  ) AS 'total_scores_per_date'
                 FROM users u LIMIT 0, 1
             ")->fetchAll('assoc');

            // Scores per exams
            $q_exams = $this->getTableLocator()->get('Scores')->find();
            $q_exams->select([
                'exam_title'=>'Exams.exam_title', 'stat_created', 'id', 'exam_id',
                'total_values' => $q_exams->func()->count('exam_id')
            ]);
            $q_exams->where(['Scores.stat_created > '=>$from, 'Scores.stat_created < '=>$to]);
            $q_exams->order(['Scores.stat_created'=>'ASC']);
            $q_exams->contain(['Exams']);
            $q_exams->group(['Exams.exam_title']);

            $exams['items'] = $q_exams->toArray();
            $exams['labels'] = array_values( array_column($q_exams->toArray(), 'exam_title'));
            $exams['values'] = array_values( array_column($q_exams->toArray(), 'total_values'));
            $exams['label'] = __('exams');

            // Score pre day
            $q_scores = $q_exams;
            $q_scores->group(['Scores.id']);

            $per_day=[];
            $scores_per_day['items'] = $q_scores->toArray();
            foreach($scores_per_day['items'] as $itm){
                if( !isset( $per_day[ $itm->stat_created->format('Y-m-d') ] ) ){
                    $per_day[ $itm->stat_created->format('Y-m-d') ] = 1;
                }else{
                    $per_day[ $itm->stat_created->format('Y-m-d') ] ++;
                }
            }
            for ( $i = strtotime($from); $i <= strtotime($to); $i = $i + 86400 ) {
                if(!isset( $per_day[ date( 'Y-m-d', $i ) ] )){
                    $per_day[ date( 'Y-m-d', $i ) ] = 0;
                }
            }
            ksort($per_day);
            
            $scores_per_day['labels'] = array_keys( $per_day );
            $scores_per_day['values'] = array_values( $per_day );

            echo json_encode([ "status"=>"SUCCESS", "data"=>[
                "numbers"=>$q_numbers[0],
                "exams"=>$exams,
                "scores_per_day"=>$scores_per_day,
                // "chocotypes"=>$chocotypes,
                // "results"=>$results
            ]]); die();
        }
    }

    public function sitemap()
    {
        
        $this->viewBuilder()->setLayout('sitemap');
        
        $exams = $this->loadModel("Exams")
            ->find("all", ["fields"=>["id", "language_id", "slug"]])
            ->where(["rec_state"=>1]);
        
        $polls = $this->loadModel("Polls")
            ->find("all", ["fields"=>["id", "language_id", "slug"]])
            ->where(["rec_state"=>1, "stat_ispoll"=>1]);
        
        
        $conn = ConnectionManager::get('default');
        
        $cats_ar = $conn->execute(" 
            SELECT 
                    c.id, c.category_name, 
                    
                    ( SELECT COUNT(*) FROM exams e 
                     	WHERE e.category_id = c.id AND e.language_id = 2) AS 'exams_count', 
                        
                    ( SELECT COUNT(*) FROM polls p 
                     	WHERE p.category_id = c.id AND p.language_id = 2) AS 'polls_count'
                        
                    FROM categories c
                    WHERE c.rec_state=1 AND c.parent_id=3
                    ")->fetchAll('assoc');
        
        $cats_en = $conn->execute(" 
            SELECT 
                    c.id, c.category_name, 
                    
                    ( SELECT COUNT(*) FROM exams e 
                     	WHERE e.category_id = c.id AND e.language_id = 1) AS 'exams_count', 
                        
                    ( SELECT COUNT(*) FROM polls p 
                     	WHERE p.category_id = c.id AND p.language_id = 1) AS 'polls_count'
                        
                    FROM categories c
                    WHERE c.rec_state=1 AND c.parent_id=3
                    ")->fetchAll('assoc');
        
        $cats_tr = $conn->execute(" 
            SELECT 
                    c.id, c.category_name, 
                    
                    ( SELECT COUNT(*) FROM exams e 
                     	WHERE e.category_id = c.id AND e.language_id = 3) AS 'exams_count', 
                        
                    ( SELECT COUNT(*) FROM polls p 
                     	WHERE p.category_id = c.id AND p.language_id = 3) AS 'polls_count'
                        
                    FROM categories c
                    WHERE c.rec_state=1 AND c.parent_id=3
                    ")->fetchAll('assoc');
        
        $tags_ar = $conn->execute(" 
                SELECT 
                    t.id, t.tag, 
                    ( SELECT COUNT(*) FROM exams e 
                        WHERE e.exam_tags LIKE CONCAT('%', t.tag , '%') AND e.language_id = 2 ) AS 'exams_count', 

                    ( SELECT COUNT(*) FROM polls p 
                        WHERE p.poll_tags LIKE CONCAT('%', t.tag , '%') AND p.language_id = 2 ) AS 'polls_count'

                    FROM tags t")->fetchAll('assoc');
        
        $tags_en = $conn->execute(" 
                SELECT 
                    t.id, t.tag, 
                    ( SELECT COUNT(*) FROM exams e 
                        WHERE e.exam_tags LIKE CONCAT('%', t.tag , '%') AND e.language_id = 1 ) AS 'exams_count', 

                    ( SELECT COUNT(*) FROM polls p 
                        WHERE p.poll_tags LIKE CONCAT('%', t.tag , '%') AND p.language_id = 1 ) AS 'polls_count'

                    FROM tags t")->fetchAll('assoc');
        
        $tags_tr = $conn->execute(" 
                SELECT 
                    t.id, t.tag, 
                    ( SELECT COUNT(*) FROM exams e 
                        WHERE e.exam_tags LIKE CONCAT('%', t.tag , '%') AND e.language_id = 3 ) AS 'exams_count', 

                    ( SELECT COUNT(*) FROM polls p 
                        WHERE p.poll_tags LIKE CONCAT('%', t.tag , '%') AND p.language_id = 3 ) AS 'polls_count'

                    FROM tags t")->fetchAll('assoc');
        
        $this->set(compact("exams", "polls", "tags_ar", "tags_en", "tags_tr", "cats_ar", "cats_en", "cats_tr"));
        $this->set("_serialize", false);
    }
    
    public function getscores()
    {
        $this->autoRender = false;
        $latestScores = $this->loadModel('Scores')->find('all', [
            "fields"=>["Scores.id", "Scores.score_result", "Scores.user_name", "Exams.id", "Exams.exam_title"],
            "contain"=>["Exams"]
        ])
        ->limit(20)
        ->order(['Scores.id'=>'DESC'])
        ->where([
            'exam_calc_method' => 1, 
            'score_result > ' => 75, 
            "NOT" => ["user_name"=>"null"],
            "AND" => ["NOT"=>["user_name"=>""]],
        ]);
//            ->matching('Competitions', function(\Cake\ORM\Query $q) {
//                return $q->where(['Competitions.rec_state >' => 2]);
//            });
        echo json_encode(["status"=>"SUCCESS", "data"=>$latestScores], JSON_UNESCAPED_UNICODE); die();
    }
    function beforeFilter(Event $event) 
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['sharecounter', 'upld', 'delfiles', 'sess', 'notifications', 'sitemap', 'getscores']);
    }
}