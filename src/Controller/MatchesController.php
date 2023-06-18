<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class MatchesController extends AppController
{
    public function index($id = null)
    {
        $matches = $this->Matches->find("all", [
            'conditions' => ["match_score1"=>$id], 
            'contain' => [ "Exams.Polls.Options", "Score1", "Score2" ],
        ])->toArray();
        
        foreach($matches as $k => $match){
            if($match->match_score2!= null){
                $matches[$k]->score1->hits = $this->loadModel("Hits")->find("all", [
                    "fields"=>["id", "poll_id", "option_id"]
                ])->where(["id IN "=>explode(",", $matches[$k]->score1->hits_ids)])->toArray();

                $matches[$k]->score2->hits = $this->loadModel("Hits")->find("all", [
                    "fields"=>["id", "poll_id", "option_id"]
                ])->where(["id IN "=>explode(",", $matches[$k]->score2->hits_ids)])->toArray();
            }else{
                $match_id=$matches[0]->id;
                unset($matches[$k]);
            }
        }
        
        if(count($matches)==0){
            return $this->redirect(["action"=>"readylink", $match_id]);
        }
        
        $matches = $this->calcResult( $matches );
        $chartsObj = json_encode($matches['chartsObj'], JSON_UNESCAPED_UNICODE);
        unset($matches['chartsObj']);
        
        $img = $matches[0]->exam->seo_image == null ? "/img/think".rand(0,4).".jpg" : "/img/exams_photos/thumb/".$matches[0]->exam->seo_image;
        $metaDt = [ 
            "_title"=>$matches[0]->exam->exam_title.' '.$matches[0]->score1->user_name, 
            "_keywords"=>$matches[0]->exam->seo_keywords, 
            "_description"=>$matches[0]->exam->seo_desc, 
            "_photo"=>$img 
        ];
        $this->set(compact('matches', 'metaDt', 'chartsObj'));
    }
    
    public function view($id = null)
    {
        $match = $this->Matches->get($id, [
            'contain' => [ "Exams.Polls.Options", "Score1", "Score2" ],
        ]);
        
        if($match->match_score2 == null){
            return $this->redirect(["action"=>"readylink", $match->id]);
        }
        
        $match->score1->hits = $this->loadModel("Hits")->find("all", [
            "fields"=>["id", "poll_id", "option_id"]
        ])->where(["id IN "=>explode(",", $match->score1->hits_ids)])->toArray();
        
        $match->score2->hits = $this->loadModel("Hits")->find("all", [
            "fields"=>["id", "poll_id", "option_id"]
        ])->where(["id IN "=>explode(",", $match->score2->hits_ids)])->toArray();
        
        $matches = $this->calcResult( [$match] );
        
        $match = $matches[0];
        $chartsObj = json_encode($matches['chartsObj'], JSON_UNESCAPED_UNICODE);
        
        $matchResults = [$matches[0]->matchResult];
        
        $img = $match->exam->seo_image == null ? "/img/think".rand(0,4).".jpg" : "/img/exams_photos/".$match->exam->seo_image;
        $metaDt = [ 
            "_title"=>$match->exam->exam_title.' '.__('matching_between').' '.$match->score1->user_name.' - '.$match->score2->user_name, 
            "_keywords"=>$match->exam->seo_keywords, 
            "_description"=>$match->exam->seo_desc, 
            "_photo"=>$img ];
        
        $this->set(compact('match', 'metaDt', 'chartsObj', 'matchResults'));
    }
    
    public function readylink($id = null)
    {
        $match = $this->Matches->get($id, [
            'contain' => [ "Exams.Polls.Options", "Score1", "Score2" ],
        ]);
        
        $match->score1->hits = $this->loadModel("Hits")->find("all", [
            "fields"=>["id", "poll_id", "option_id"]
        ])->where(["id IN "=>explode(",", $match->score1->hits_ids)])->toArray();
        
        if(!empty( $match->score2 )){
            $match->score2->hits = $this->loadModel("Hits")->find("all", [
                "fields"=>["id", "poll_id", "option_id"]
            ])->where(["id IN "=>explode(",", $match->score2->hits_ids)])->toArray();
        }
        
        $matches = $this->calcResult( [$match] );
        
        $chartsObj = json_encode($matches[0]['chartsObj'], JSON_UNESCAPED_UNICODE);
        
        $matchResults = [$matches[0]->matchResult];
        
        $img = $match->exam->seo_image == null ? "/img/think".rand(0,4).".jpg" : "/img/exams_photos/".$match->exam->seo_image;
        $metaDt = [ 
            "_title"=>$match->exam->exam_title.' '.__('matching_between').' '.$match->score1->user_name.' - '.empty($match->score2) ? __('unknown') : $match->score2->user_name, 
            "_keywords"=>$match->exam->seo_keywords, 
            "_description"=>$match->exam->seo_desc, 
            "_photo"=>$img ];
            
        $related = $this->Matches->Exams->find('all')->where(['exam_calc_method'=>3, 'language_id'=>$this->currlangid]);
        $this->set(compact('match', 'matches', 'metaDt', 'chartsObj', 'matchResults', 'related'));
    }
    
    private function calcResult( $matches ) 
    {
        $chartsObj=[];
        foreach( $matches as $key => $match ){
            
            // calc value
            $total_match=0;
            // dd($match->score1->user_name);
            $matchResult = '<div class="col-6"><b>'.$match->score1->user_name.'</b></div>
                <div class="col-6"><b>'.(empty($match->score2) ? __('unknown') : $match->score2->user_name).'</b></div>';
            foreach($match->exam->polls as $k1 => $poll){

                $ind1 = $ind2 = '-1';
                $poll->options['-1']=(object)['id'=>0, 'option_photo'=>'think4.jpg', 'option_text'=>''];

                foreach($poll->options as $k=>$option){
                    $optInd1 = array_search($option->id , array_column($match->score1->hits, 'option_id'));
                    $optInd2 = empty($match->score2) ? false : array_search($option->id , array_column($match->score2->hits, 'option_id'));
                    if($optInd1 != false){ $ind1 = $k; }
                    if($optInd2 != false){ $ind2 = $k; }
                }

                if( $ind1 != '-1' ){
                    $img1 = $img2 = '';
                    $clr = 'grayBg';
                    
                    if($poll->options[$ind1]->id == $poll->options[$ind2]->id){
                        $total_match++;
                        $clr = 'greenBg';
                    }
                    if(!empty($poll->options[$ind1]->option_photo)){
                        $img1 = '<img src="'.$this->path.'/img/options_photos/thumb/'.$poll->options[$ind1]->option_photo.'" style="height:120px;" show-img> ';
                        $img2 = '<img src="'.$this->path.'/img/options_photos/thumb/'.$poll->options[$ind2]->option_photo.'" style="height:120px;" show-img> ';
                    }
                    $matchResult .= '<i class="col-12 mt-3 '.$clr.'">'.($k1.'-'.$key).$poll->poll_text.'</i>';
                    $matchResult .= '<div class="col-6 ">'.$img1.' '.$poll->options[$ind1]->option_text.'</div>';
                    $matchResult .= '<div class="col-6 ">'.$img2.' '.$poll->options[$ind2]->option_text.'</div>';
                }
            }
            $matches[$key]->val = ceil($total_match / count($match->exam->polls) *100);            
            $matches[$key]->matchResult = $matchResult;
            
            array_push($chartsObj, $this->Do->setChartObj((object)["name"=>__("matching_val"), "val"=>$matches[$key]->val], "gauge"));
            $matches[$key]['chartsObj'] = $chartsObj;
        }
        return $matches;
    }
    
    function beforeFilter(Event $event) 
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['readylink']);
    }
}
