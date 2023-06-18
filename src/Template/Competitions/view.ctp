
<?=$this->element('whereIm')?>

<?php
	$this->assign('title',$exam->exam_title);
    $ind = $this->Do->get('uid') == $competition->competitors[0]->stat_ip ? 1 : -1;
?>
<section class="pro-content product-content" 
         ng-init="
            chkCompetitionResult(<?=$this->request->getParam('pass')[0]?>);
            currTab=rec.cmptRes.comments.length>0 ? 1 : 0;
            " id="top">
    <div class="container">
        <div class="product-detail-info">
            <div class="row">
                <!--       EXAM PREVIEW      -->
                <div class="col-12 col-sm-12 animationIf" ng-if="!poll.isExamStarted">
                    <div class="row exam_view">
                        <div class="col-12 col-md-4 hideMob">
                            <?=$this->Html->image(
                                !empty($exam->seo_image) ? 
                                '/img/exams_photos/thumb/'.$exam->seo_image : '/img/think'.rand(0, 4).'.jpg', 
                                ["alt"=>$exam->exam_title, "style"=>"width:100%;"]
                                )?>
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="row ">
                                <div class="col-12 col-md-12">
                                    <h1 class="pro-title"><?=$exam->exam_title?></h1>
                                    <p class="exam-desc"><?=$exam->exam_desc?></p>
                                    
                                    <!-- WINNER Competitor -->
                                    <div class="row text-center">
                                        <div class="avatar_div col-12">
                                            <div class="avatar">
                                                <img src="<?=$path?>/img/avatars/crown_4.png" class="crown" alt="crown">
                                                <span ng-if="rec.cmptRes.winner.competitor_configs.isFounder==1">
                                                    <i class="fa fa-star goldText isFounder_star" title="<?=__('isFounder')?>" data-toggle="tooltip"></i>
                                                </span>
                                                <div class="bg2">
                                                    <img ng-src="<?=$path?>/img/avatars/{{rec.cmptRes.winner.competitor_configs.competitor_avatar}}" alt="avatar">
                                                </div>
                                                <div class="bg1">
                                                    <img src="<?=$path?>/img/avatars/frame_10.png" alt="frame">
                                                </div>
                                                <div class="name">
                                                    <div>[{{rec.cmptRes.winner.competitor_name}}]</div>
                                                    <b>[{{rec.cmptRes.winner.score.score_result}}%]</b>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    <!-- Competitors list before start -->
                                    <div class="row mb-5">
                                        <div class="col-12">
                                            <div ng-repeat="itm in rec.cmptRes.competitors">
                                                <div class="cmpttr_res">
                                                    <span><img ng-src="{{app_folder}}/img/avatars/{{itm.competitor_configs.competitor_avatar}}" alt="avatar" style="height: 40px">
                                                        <i ng-if="itm.competitor_configs.isFounder==1" class="fa fa-star goldText pos-right-top" title="<?=__('isFounder')?>"></i>
                                                    </span>
                                                    <span>
                                                        <i ng-if="(itm.competitor_configs.answers.length != rec.cmptRes.total_polls)" class="fas fa-circle-notch fa-spin"></i>
                                                        <i ng-if="(itm.competitor_configs.answers.length == rec.cmptRes.total_polls)" class="fas fa-check"></i>
                                                    </span> <span> {{itm.competitor_name}} </span> <span>  [{{itm.competitor_configs.answers.length||0}} / {{rec.cmptRes.total_polls}}] </span>
                                                    <span><b>{{itm.competitor_score}}%</b></span>
                                                    <ii style="width:{{itm.competitor_score}}%"></ii>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Buttons -->
                                <div class="col-12 mb-5 text-center">
                                    <?=$this->Html->link('<i class="fas fa-graduation-cap"></i> '.__('start_exam_or_start_competition'),
                                                        ["controller"=>"Exams", "action"=>"view", $exam->slug],
                                                        ["escape"=>false, "class"=>"btn btn-secondary swipe-to-top"] )?> 
                                    <?php if($ind>-1){?>
                                    <a href="javascript:void(0);" 
                                       class="btn btn-secondary swipe-to-top"
                                       ng-if="rec.cmptRes.rec_state != 3"
                                       ng-click="rec.cmptRes.rec_state=3;
                                                 rec.cmptRes.stat_created='<?=date('Y-m-d H:i:s')?>';
                                                 callAction('/competitions/edit/'+rec.cmptRes.id+'?ajax=1', rec.cmptRes, 'POST')">
                                        <i class="fas fa-power-off"></i> <?=__('close_competition')?>
                                    </a>
                                    <?php }?>
                                </div>

                                <!-- Share bar -->
                                <div class="col-12 ">
                                    <?=$this->element('share', ["obj"=>$competition, "mdl"=>"Competitions"])?>
                                </div>
                                <?php 
//                                    debug($exam->exam_configs);
//                                    debug($hits);
//                                    die();
                                ?>

                                <!-- Exam review -->
                                <?php if($ind > -1){?>
                                <div class="col-12 mb-5">
                                    <?=$this->element('examReview', ["exam"=>$exam, "hits"=>$hits])?>
                                </div>
                                <?php }?>

                                <!-- Comments -->
                                <div class="col-12 mb-5">
                                    <?=$this->element('comments', ["comments"=>$competition->comments])?>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<button class="hideElm" data-toggle="modal" id="share_mdl_btn" data-target="#share_mdl"></button>
<script>
    setTimeout(()=>{
        if('<?=$ind > -1?>' == 1){
           $("#share_mdl_btn")[0].click();
        }
    }, 4000)
</script>
