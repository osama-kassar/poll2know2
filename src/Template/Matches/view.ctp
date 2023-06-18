
<?php
	$this->assign('title',__('matching_between').' '.$match->score1->user_name.' - '.$match->score2->user_name);
?>
<?=$this->element('whereIm')?>
<section class="pro-content product-content" ng-init="toElm('match_result')">
    <div class="container">
        <div class="product-detail-info">
            <div class="row">
                
                <!--       EXAM RESULT      -->
                <div class="col-12 col-sm-12">
                    <div class="row exam_view">
                        
                        <div class="col-12 col-md-8">
                            <div class="row  ">
                                
                                <div class="col-12 col-md-12">
                                    <div class="text-center ">
                                        <h1><?=__('the_game').': '.$match->exam->exam_title?></h1>
                                        <div>
                                            <?=$this->Html->image("/img/exams_photos/".$match->exam->seo_image, 
                                                ["class"=>"w100-2"])?>
                                        </div>
                                
                                        <div class="col-12 mt-5 mb-5 result_div" id="match_result">

                                            <h1 class="text-center">
                                                <span><?=__("matching_between")?></span>: 
                                                <span><?=$match->score1->user_name?></span> 
                                                <span><?=__('and')?></span> 
                                                <span><?=$match->score2->user_name?></span> 
                                                <div class="greenText" style="font-size: 50px;"><?=$match->val?>%</div>
                                            </h1>
                                            
                                            <div class="gauge">
                                                <?=$this->element('charts', ["ind"=>0, "type"=>"gauge"])?>
                                            </div>
                                            
                                            <?php /*?>
                                            <div class="circles">
                                                <span style="right:<?=($match->val/4).'%'?>">&nbsp;<br><?=$match->score1->user_name?></span>
                                                <span style="left:<?=($match->val/4).'%'?>"><?=$match->score2->user_name?><br>&nbsp;</span>
                                                <div class="fas fa-grin-alt"></div>
                                            </div>
                                            <?php */?>
                                        </div>
                                        
                                        <!-- Buttons -->
                                        <div class="col-12 mb-5 text-center ">
                                            <?=$this->Html->link('<i class="fas fa-smile"></i> '.__('create_your_game'),
                                                ["controller"=>"Exams", "action"=>"game", $match->exam->slug],
                                                ["escape"=>false, "class"=>"btn btn-secondary swipe-to-top"] )?> 
                                        </div>
                                                
                                        <!--    SHARE COMPONENT   -->
                                        <?=$this->element("share", ["obj"=>$match, "mdl"=>"Matches"])?>
                                        
                                    </div>
                                </div>
                                <?php foreach($matchResults as $matchResult){?>
                                <div class="col-12">
                                    <div class="row answers_compare">
                                        <?=$matchResult?>
                                    </div>
                                </div>
                                <?php }?>
                            </div>
                        
                            <!-- Exam Review -->
                            <?php if(
                                $match->exam->exam_calc_method == 1 &&
                                $match->exam->exam_configs['showReview'] == 1 &&
                                $isExamOwner){?>
                                <div class="col-12 mb-5 noselect">
                                    <?=$this->element('examReview', ["exam"=>$match->exam, "hits"=>$hits->toArray()])?>
                                </div>
                            <?php }?>
                        </div>
                        
                        <!-- Related Exams -->
                        <div class="col-12 col-md-4">
                            <?php echo $this->element('sidebar')?>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<button class="hideElm" data-toggle="modal" id="share_mdl_btn" data-target="#share_mdl"></button>

<script>
$(document).ready(function(){
    var isReviewStarted = '<?=strlen($this->request->getQuery('p')) == 0 ? -1 : 1?>'*1;
    if(isReviewStarted > -1){
        toElmJs("exam_review");
    }
    var isIp = '<?=$_SERVER["REMOTE_ADDR"] == $match->user_ip ? 1 : 0?>'*1;
    setTimeout(()=>{
        if(isIp == 1 && isReviewStarted == -1){
           $("#share_mdl_btn")[0].click();
        }
    }, 7000)
})
</script>

