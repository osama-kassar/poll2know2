<?=$this->element('whereIm')?>
<?php
// dd($matches);
    $exam = $match->exam;
	$this->assign('title',$exam->exam_title);
?>
<section class="pro-content product-content" ng-init="
    toElm('game_link')
" >
    <div class="container">
        <div class="product-detail-info">
            <div class="row">
                
                <!--       EXAM RESULT      -->
                <div class="col-12 col-sm-12">
                    <div class="row exam_view">
                        
                        <div class="col-12 col-md-8">
                            <div class="row ">
                                <div class="col-12 text-center">
                                    
                                    <h1><?=__('the_game').': '.$exam->exam_title?></h1>
                                    <?php /*?><div>
                                        <?=$this->Html->image("/img/exams_photos/".$exam->seo_image, 
                                            ["class"=>"w100-2"])?>
                                    </div><?php */?>
                                </div>

                                <div class="col-12 mt-5" id="game_link">
                                    <h3><?=__('game_link')?></h3> 
                                    <p><?=__('game_link_desc')?></p>
                                    <a href class="send2friend" ng-click="copyToClipBoard('#inv_link')">
                                        <?=$this->Html->image('/img/send2friend.png', ['alt'=>'Send the link to friend'])?>
                                        <div><?=__('game_link')?></div>
                                    </a>
                                    <div class="text-center invLink">
                                        <button class="btn btn-secondary swipe-to-top"
                                                ng-click="copyToClipBoard('#inv_link')">
                                            <i class="fa fa-link"></i> <?=__('copy_the_link')?>
                                        </button>
                                        
                                        <div>
                                            <a href ng-click="copyToClipBoard('#inv_link')"><i id="inv_link">
                                                <?=$protocol.':'.$path.'/'.$currlang.'/game/'.$exam->slug.'?matchid='.$match->id?>
                                            </i></a>
                                        </div>
                                    </div>
                                    
                                    <div class="text-center">
                                        <?=$this->element('share', [ "obj"=>$match, "link"=>$protocol.':'.$path.'/'.$currlang.'/game/'.$exam->slug.'?matchid='.$match->id ])?>
                                    </div>
                                </div>
                                <?php /*?>
                                <div class="col-12 mt-5 ">
                                    <h3><?=__('your_matches_link')?></h3>
                                    <p><?=__('your_matches_link_desc')?></p>
                                    <p>
                                    <?=__('link_sent_to_your_email').' '.$match->score1->user_email?></p>
                                    <div class="text-center">
                                        <button class="btn btn-danger swipe-to-top"
                                                ng-click="copyToClipBoard('#inv_link2')">
                                            <i class="fa fa-link"></i> <span id="inv_link2">
                                            <?=$protocol.':'.$path.'/'.$currlang.'/matches/index/'.$match->match_score1?></span>
                                        </button>
                                    </div>
                                </div>
                                <?php */?>
                            </div>
                        
                            <!-- Exam Review -->
                            <?php /*if(
                                $exam->exam_calc_method == 1 &&
                                $exam->exam_configs['showReview'] == 1 &&
                                $isExamOwner){?>
                                <div class="col-12 mb-5 noselect">
                                    <?=$this->element('examReview', ["exam"=>$exam, "hits"=>$hits->toArray()])?>
                                </div>
                            <?php }*/?>
                            
                            <div class="row">
                                <?php foreach($matches as $k => $match){  ?>
                                    <div class="col-12 mt-5 result_div">
                                        <h1 class="text-center">
                                            <span><?=__("matching_between")?></span>: 
                                            <span><?=$match->score1->user_name?></span> 
                                            <span><?=__('and')?></span> 
                                            <span><?=empty( $match->score2->user_name ) ? 
                                                '<a href ng-click="copyToClipBoard(\'#inv_link\')"> <i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i> '.__('game_link').'</a>' : 
                                                $match->score2->user_name?></span> 
                                            <div class="greenText" style="font-size: 50px;"><?=$match->val?>%</div>
                                        </h1>
                                    </div>
                                    <div class="col-12 result_div">
                                        <div class="gauge">
                                            <?=$this->element('charts', ["ind"=>$k, "type"=>"gauge"])?>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row answers_compare">
                                            <?=$match->matchResult?>
                                        </div>
                                    </div>
                                <?php }?>   
                            </div>
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
$(window).ready(function(){
    var isReviewStarted = '<?=strlen($this->request->getQuery('p')) == 0 ? -1 : 1?>'*1;
    if(isReviewStarted > -1){
        toElmJs("exam_review");
    }
    var isIp = '<?=$_SERVER["REMOTE_ADDR"] == $matches[0]->score1->user_ip ? 1 : 0?>'*1;
    
    setTimeout(()=>{
        if(isIp == 1 && isReviewStarted == -1){
           $("#share_mdl_btn").click();
        }
    }, 2000)
})
</script>

