<?php
namespace App\Controller;

use App\Controller\AppController;

class CategoriesController extends AppController
{
    public function index($keyword=null, $category_id=null)
    {
        $examsCond = ["language_id"=>$this->currlangid];
        $pollsCond = ["language_id"=>$this->currlangid, "exam_id"=>0];
        
        if($category_id>0){
            $examsCond["category_id"]=$category_id;
            $pollsCond["category_id"]=$category_id;
        }else{
            $examsCond["OR"][] = [" exam_tags LIKE "=>"%". $keyword."%"];
            $examsCond["OR"][] = [" exam_title LIKE "=>"%". $keyword."%"];
            $examsCond["OR"][] = [" exam_desc LIKE "=>"%". $keyword."%"];
            $pollsCond["OR"][] = [" poll_tags LIKE "=>"%". $keyword."%"];
            $pollsCond["OR"][] = [" poll_title LIKE "=>"%". $keyword."%"];
            $pollsCond["OR"][] = [" poll_text LIKE "=>"%". $keyword."%"];
        }
        $exams = $this->loadModel("Exams")->find("all")
            ->where($examsCond)
            ->order(["id"=>"DESC"]);
        $polls = $this->loadModel("Polls")->find("all")
            ->where($pollsCond)
            ->order(["id"=>"DESC"]);
        
        if($this->request->getQuery('ajax') == 1){
            $this->autoRender = false;
            echo json_encode(["status"=>"SUCCESS", "data"=>["exams"=>$exams->toArray(), "polls"=>$polls->toArray()]], JSON_UNESCAPED_UNICODE);die();
        }
        
        $this->set(compact('exams', 'polls'));
    }
    
}
