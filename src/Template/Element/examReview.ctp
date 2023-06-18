<section class="pro-content cart-content">
   <div class="" id="accordion">
      <div class="row">
         <div class="col-12">
            <h1>
               <?=__('exam_review')?> <i class="fa fa-info-circle" data-toggle="tooltip" title="<?=__('exam_review_desc')?>"></i>
            </h1>
         </div>
      </div>
            
<?php 
    $exam->exam_configs = (object)$exam->exam_configs;
    $poll = $exam->polls[0];
    $k = empty($this->request->getQuery('p')) ? 0 : $this->request->getQuery('p')*1;
?>
       <div class="row exam_review" >
          <div  class="col-12" id="exam_review">
              <h4 class="card-header">
                  <span><i class="fa fa-question-circle"></i></span>
                  <span><?=$k+1?></span> 
                  <?=$poll->poll_title?> 
              </h4>
          </div>
          <div class="col-12">
              <div class="row collapse show">
                  <div class=" col-3 <?= empty($poll->seo_image) ? 'hideMob' : ''?>">
                    <?=$this->Html->image(empty($poll->seo_image) ? '/img/think'.rand(0, 4).'.jpg' : '/img/polls_photos/thumb/'.$poll->seo_image, ["style"=>"width:100%;"])?>
                  </div>
                  <div class="<?=empty($poll->seo_image) ? 'col-12' : 'col-sm-9 col-md-9 col-12'?> reviewOptions">
                      <p><?=$poll->poll_text?></p>
                      
                      <?php 
                        foreach($poll->options as $option){
                            $option->option_configs = (object)$option->option_configs;
                            $isCorrect = false;

                            // if(@$exam->exam_configs->showAnswers == 1 && $this->request->getParam('controller') == "Scores"){
                                if($poll->poll_type == 4){
                                    $ind = array_search($option['id'], array_column($hits, 'option_id'));
                                    $isCorrect = $option->option_value == $hits[$ind]['hit_answer'];
                                }else{
                                    $isCorrect = $option->option_configs->isCorrect ==1 ? true : false;
                                }
                            // } ?>
                          <div class="brdr <?=(@$exam->exam_configs->showAnswers == 1 && $isCorrect)  ? "greenText" : ""?>">
                              <?php if(!empty( $option->option_photo) ){?>
                              <span>
                                  <?=$this->Html->image("/img/options_photos/thumb/".$option->option_photo, 
                                        ["style"=>"height:40px;", "show-img"=>""])?>
                              </span>
                              <?php }?>
                              <span>
                                  <i class="fas fa-<?=$option->isHitted != 1 ? 'circle' : ($isCorrect ? 'check-circle greenText ' : 'times-circle redText ');?>"></i>
                              </span>
                              
                              <?php if(!empty($option->option_text)){?>
                                  <b><?=$option->option_text?></b>
                              <?php }?>
                              
                              <span><?=$option->option_value?></span>
                              <?php if($poll->poll_type == 4){?>
                                  <span class="greyText">
                                      [<small><?=$hits[$ind]['hit_answer']?></small>]
                                  </span>
                              <?php }?>
                          </div>
                      <?php }?>
                      
                  </div>
              </div>
           </div>
           
           <div id="adArea_2nd_ad" class="adArea"></div>
           
           <div class="col-12 text-center mb-3 mt-3">
               <hr>
               <?=$this->Html->link('<i class="fa fa-angle-double-'. ($currlang=='ar' ? 'right' : 'left') .'"></i> '.__('next'),
                ["controller"=>"Scores", "action"=>"view", $score->id, "p"=>$k+1], 
                ["class"=>"btn btn-secondary swipe-to-top ".($k === 'done' ? 'disabled' : ''), "escape"=>false])?>
               
               <?=$this->Html->link(__('prev').' <i class="fa fa-angle-double-'. ($currlang=='ar' ? 'left' : 'right') .'"></i>',
                ["controller"=>"Scores", "action"=>"view", $score->id, "p"=>$k-1], 
                ["class"=>"btn btn-secondary swipe-to-top ".($k<1 ? 'disabled' : ''), "escape"=>false])?>
           </div>
      </div>
   </div>
</section>