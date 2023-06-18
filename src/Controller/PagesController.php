<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\Event;

class PagesController extends AppController
{

    public function display(...$path)
    {
        $count = count($path);
        if (!$count) {
            return $this->redirect('/');
        }
        if (in_array('..', $path, true) || in_array('.', $path, true)) {
            throw new ForbiddenException();
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }

        $slides = ["titles"=>[], "dt"=>[]];
        $slidesExams = ["titles"=>[], "dt"=>[]];
        
//        foreach($this->c_list as $v){
//            if(($v->polls_count) > 5){
                $polls = $this->loadModel('Polls')->find('all')->where([
//                    'category_id'=>$v->id, 
                    'language_id'=>$this->currlangid,
                    'exam_id'=>0
                ])
                ->select(['id','slug', 'poll_title', 'poll_text', 'poll_type', 'seo_image', 'stat_views', 'stat_shares'])
                ->order(['rand()'])
                ->limit(6)
                ->toArray();
//                if($polls){
//                    $slides['titles'][] = $v->category_name;
//                    $slides['dt'][] = $polls;
//                }
//            }
//            if(($v->exams_count) > 5){
                $exams = $this->loadModel('Exams')->find('all')->where([
//                    'category_id'=>$v->id, 
                    'language_id'=>$this->currlangid,
                    'exam_calc_method <'=>3
                ])
                    ->select(['id','slug', 'exam_title', 'exam_desc', 'seo_image', 'stat_views', 'stat_shares'])
                    ->order(['rand()'])
                    ->limit(8)
                    ->toArray();
//                if($exams){
//                    $slidesExams['titles'][] = $v->category_name;
//                    $slidesExams['dt'][] = $exams;
//                }
//            }
//        }
        
        $this->set(compact('page', 'subpage', 'polls', 'exams'));
        try {
            $this->render(implode('/', $path));
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }
    }
    
    public function beforeRender(Event $event){
        parent::beforeRender($event);
        if(strpos($_SERVER['REQUEST_URI'], "google7b28ba094589b3e4.html") !== false){
            $this->viewBuilder()->setLayout('ajax');
        }
    }
}
