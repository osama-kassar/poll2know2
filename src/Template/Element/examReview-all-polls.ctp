<section class="pro-content cart-content">
   <div class="" id="accordion">
      <div class="row">
         <div class="col-12">
            <h1>
               <?=__('exam_review')?>
            </h1>
            <small><?=__('exam_review_desc')?></small>
         </div>
      </div>
            
<?php 
    $exam->exam_configs = (object)$exam->exam_configs;
    foreach($exam->polls as $k=>$poll){ 
       ?>
       <div class="row exam_review">
          <div  class="col-12" data-toggle="collapse" data-target="#poll<?=$poll->id?>" aria-expanded="true" aria-controls="contact_section">
              <h4 class="card-header">
                  <span><i class="fa fa-<?=$poll->isCorrectAnswer == 1 ? 'check-circle greenText' : 'times-circle redText'?>"></i></span>
                  <span><?=$k+1?></span> 
                  <?=$poll->poll_title?> <small><i class="fa fa-angle-down" style="float: left;line-height: 30px;"></i></small> 
              </h4>
          </div>
          <div class="col-12">
              <div class="row collapse" data-parent="#accordion" id="poll<?=$poll->id?>">
                  <div class="col-sm-3 col-md-3 col-12 hideMob">
                    <?=$this->Html->image('/img/polls_photos/thumb/'.empty($poll->seo_image) ? '/img/think'.rand(0, 4).'.jpg' : $poll->seo_image, ["style"=>"width:100%;"])?>
                  </div>
                  <div class="col-sm-9 col-md-9 col-12 reviewOptions">

                      <p><?=$poll->poll_text?></p>

                      <?php 
                            foreach($poll->options as $option){
                                $option->option_configs = (object)$option->option_configs;
                                $isCorrect = false;
                                if(@$exam->exam_configs->showAnswers == 1 && $this->request->getParam('controller') == "Scores"){
                                    $isCorrect = $option->option_configs->isCorrect ==1 ? true : false;
                                }
                      ?>
                          <div class="<?=$isCorrect ? "greenText" : ""?>">
                          <span><i class="fa fa-<?=$option->isHitted == 1 ? 'check-circle' : 'circle'?>"></i></span>
                          <?=$option->option_text?>
                          </div>
                      <?php }?>
                      
                  </div>
              </div>
          </div>
      </div>
       
<?php } ?>
       
   </div>
</section>