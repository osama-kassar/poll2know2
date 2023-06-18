<?=$this->element('whereIm')?>
<?php
	$this->assign('title',$score->result->result_name);

    if(!empty($score->result)){
        $res = [
            "result_name"=>$score->result->result_name,
            "result_text"=>$score->result->result_text
        ];
    }else{
        $ind = $score->score_result < 35 ? 1 : ($score->score_result > 35 && $score->score_result < 75 ? 2 : 3);
        
        $res = [
            "result_name"=>__("result_name_".$ind),
            "result_text"=>__("result_text_".$ind)
        ];
    }

    $percentage_mark='%';
    if((int)@$score->exam->exam_configs['examValue'] > 0){
        $percentage_mark = '/'.$score->exam->exam_configs['examValue'];
    }
?>
<section class="pro-content product-content" >
    <div class="container">
        <div class="product-detail-info">
            <div class="row">
                
                <!--       EXAM RESULT      -->
                <div class="col-12 col-sm-12">
                    <div class="row exam_view">
                        
                        <div class="col-12 col-md-8">
                            <div class="row ">
                                <div class="col-12 col-md-12">
                                    
                                    <div class="text-center">
                                        <h1><?=__('the_exam').': '.$score->exam->exam_title?></h1>

                                        <?php // show certificate ?>
                                        <div class="result_cert_div">
                                            <b class="blueText"><?=$score->user_name?></b><br>
                                            <div class="grayText"><?=__('congrats').' '.__('you_pass').' '.__('exam')?></div>
                                            <?=$score->exam->exam_title?><br>
                                            <b class="greenText"><?=$score->exam->exam_calc_method == 1 ? __('your_degree').' [ '.ceil($score->score_result).' '.($percentage_mark).' ]' : '-----------------------'?></b><br>
                                            <?=$res["result_name"]?>
                                        </div>

                                        <div id="middle_score_slot2" class="adArea"></div>

                                        <div class="result_div">
                                            <h2>
                                                <b><?=empty($score->user_name) ? __('you') : $score->user_name?></b>
                                                <div><?=$res["result_name"]?></div>
                                                
                                                <?php
                                                    if($score->exam->exam_calc_method==1){ 
                                                        echo '<strong><span class="greenText">'.$score->score_result.'</span></strong>'.$percentage_mark;
                                                    }
                                                ?>
                                            </h2>
                                            
                                            <div class="exam-desc"><?=$res["result_text"]?></div>
                                            
                                            <div ng-if="'<?=$score->exam->exam_calc_method?>' == 1">
                                                <?=__('right_answers').' '.$score->score_configs['right_answers']?> / <?=__('wrong_answers').' '.$score->score_configs['wrong_answers']?>
                                            </div>
                                        </div>
                                                
                                        <!-- Buttons -->
                                        <div class="col-12 mb-5 text-center">
                                            <?=$this->Html->link('<i class="fas fa-graduation-cap"></i> '.__('start_exam_or_start_competition'),
                                                                ["controller"=>"Exams", "action"=>"view", $score->exam->slug],
                                                                ["escape"=>false, "class"=>"btn btn-secondary swipe-to-top"] )?> 
                                        </div>
                                                
                                        <!--    SHARE COMPONENT   -->
                                        <?=$this->element("share", ["obj"=>$score, "mdl"=>"Scores"])?>
                                        
                                    </div>
                                </div>
                            </div>
                        
                            <!-- Exam Review -->
                            <?php if(
                                $score->exam->exam_calc_method == 1 &&
                                $score->exam->exam_configs['showReview'] == 1 &&
                                $isExamOwner){?>
                                <div class="col-12 mb-5 noselect">
                                    <?=$this->element('examReview', ["exam"=>$score->exam, "hits"=>$hits->toArray()])?>
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
    var isIp = '<?=$_SERVER["REMOTE_ADDR"] == $score->user_ip ? 1 : 0?>'*1;
    setTimeout(()=>{
        if(isIp == 1 && isReviewStarted == -1){
           $("#share_mdl_btn")[0].click();
        }
    }, 7000)
})
</script>

