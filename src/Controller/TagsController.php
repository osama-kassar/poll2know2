<?php
namespace App\Controller;

use App\Controller\AppController;

class TagsController extends AppController
{
    public function index($id=null)
    {
        $tag = $this->Tags->find("all")
            ->where(["tag"=>$id])
            ->matching('Exams', function(\Cake\ORM\Query $q) use ($id) {
                return $q->where(['Exams.exam_tags LIKE' => "%$id%"]);
            })
            ->matching('Polls', function(\Cake\ORM\Query $q) use ($id) {
                return $q->where(['Polls.poll_tags LIKE' => "%$id%"]);
            });
        debug($tag->toArray());die();

        $this->set('tag', $tag);
    }
    
}
