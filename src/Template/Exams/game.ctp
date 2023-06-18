<?=$this->element('whereIm')?>
<?php
	$this->assign('title', isset($_GET['matchid']) ? __('you_invited').': ' : '' . $exam->exam_title);
    @$poll->poll_configs['minAnswers'] = empty($poll->poll_configs['minAnswers']) ? 1 : $poll->poll_configs['minAnswers'];
    if(!empty($poll->seo_image)){
        $mainImg = '/img/polls_photos/'.$poll->seo_image;
        $img_w = '';
    }else{
        $mainImg = (!empty($exam->seo_image) ? '/img/exams_photos/'.$exam->seo_image : '/img/think'.rand(0, 4).'.jpg');
        $img_w = 'w100';
    }
//debug($exam);die();
?>

    <div id="header_game_slot" class="adArea"></div>

<section class="pro-content product-content" 
         ng-init="
                  '<?=isset($_GET['matchid'])?>' == 1 ? opAlert('<?php printf(__('you_invited_from', true), @$match->score1->user_name)?>', 'success') : '';
                  '<?=isset($_GET["p"])?>' == 1 ? toElm('poll_pos') : '';
                  ">
    <div class="container" id="top">
        <div class="product-detail-info">
            <div class="row">
                
                <!-- EXAM PREVIEW -->
                <?php if(empty($poll->id)){?>
                <div class="col-12 col-sm-12 ">
                    <div class="row exam_view">

                        <div class="col-12 col-md-4">

                            <?php /*$this->Html->image(
                                !empty($exam->seo_image) ? 
                                '/img/exams_photos/thumb/'.$exam->seo_image : '/img/think'.rand(0, 4).'.jpg', 
                                ["alt"=>$exam->exam_title, "class"=>"img-thumbnail ".$img_w, " show-img"] ) */?>
                                
                            <div id="listItem_games_1_slot" class="adArea" style="max-width: 100%; margin: auto;"></div>
                            <div id="listItem_exams_1_slot" class="adArea" style="max-width: 100%; margin: auto;"></div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="row ">
                                <div class="col-12 col-md-12">
                                    <h1 class="pro-title"><?=$exam->exam_title?></h1>

                                    
                                    
                                    <!-- User info -->
                                    <form class="row mb-5" action="<?=$path.'/'.$currlang?>/game/<?=$exam->slug?>?p=0" method="POST" name="userInfoForm">
                                                    
                                        <?=$this->Form->control("matchid", ["type"=>"hidden", "value"=>$this->request->getQuery('matchid')]);?>
                                        
                                        <?php if(!$authUser){?>
                                        <div class=" col col-12" id="user-info">
                                            <label><?=__('enter_your_name')?></label>
                                            <input type="text" name="name" class="form-control blinkIt" ng-model="userdt.user_name" chk="isEmpty">
                                        </div>
                                        
                                        <!-- <div class="col col-12">
                                            <label><?=__('enter_email_to_track_your_game')?></label>
                                            <input type="text" name="email" class="form-control" ng-model="userdt.user_email">
                                        </div> -->
                                        
                                        <?php }?>
                                        
                                        
                                        <div class="col-12 mt-3 text-center">
                                            <button class="btn btn-secondary swipe-to-top"
                                                    id="start_btn"
                                                    ng-disabled="userInfoForm.$invalid"> 
                                                <i class="fas fa-smile"></i> <?=__('start_the_game')?>
                                            </button>
                                        </div>
                                    </form>


                                    <p class="exam-desc"><?=($exam->exam_desc)?></p>
                                    <div class="mb-5">
                                        <?=$this->element("tagsShow", ["tags"=>$exam->seo_keywords, "type"=>"nolink"])?>
                                    </div>
                                    <div class="pro-infos">
                                        <div class="pro-single-info">
                                            <i class="fas fa-question-circle"></i> 
                                            <b><?=__('questions_number')?></b>:
                                            <?=$exam->polls_count?>
                                        </div>
                                        <?php if($exam->exam_period>0){?>
                                        <div class="pro-single-info">
                                            <i class="fas fa-clock"></i> 
                                            <b><?=__('exam_period')?></b>:
                                            <?=$exam->exam_period.' '.__('minutes')?>
                                        </div>
                                        <?php }?>
                                    </div>
                                    
                                    <!-- Example of the exams -->
                                    <div class="row mt-5 mb-5 example_div">
                                        <div class="col-12 col-md-12" ng-if="cmptId<0 && isInv<0">
                                            <h4 class="text-center"><?=__('example_of_exam')?></h4>
                                            <?php foreach($exExample as $poll){?>
                                            <div class="mb-4">
                                                <strong><?=$poll->poll_title?></strong>
                                                <div>
                                                    <?php 
                                                        if( !empty($poll->seo_image) ){
                                                            echo $this->Html->image( '/img/polls_photos/thumb/'.$poll->seo_image, 
                                                            ['alt'=>$poll->poll_title, 'style'=>'height:120px'] );
                                                        }
                                                    ?>
                                                    <?=$poll->poll_text?>
                                                </div>
                                                <?php if($poll->poll_type != 4){
                                                        foreach($poll->options as $option){?>
                                                    <span class="badge badge-secondary">
                                                        <?php if( !empty($option->option_photo) ){
                                                            echo $this->Html->image( '/img/options_photos/thumb/'.$option->option_photo, 
                                                            ['alt'=>$option->option_text, 'style'=>'height:80px'] );
                                                        }?>
                                                        <?=$option->option_text?>
                                                    </span>
                                                    <?php }
                                                    }?>
                                            </div>
                                            <hr>
                                            <?php }?>
                                        </div>
                                    </div>
                                    
                                    <div id="send_inv"></div>
                                    
                                </div>
                            </div>
                            
                            
                            <!--  COMMENTS & TAGS    -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-5">
                                        <?=$this->element('share', ["obj"=>$exam, "mdl"=>"Exams"])?>
                                    </div>
                                    <div class="mb-5">
                                        <?=$this->element('comments', ["comments"=>$exam->comments])?>
                                    </div>
                                    <div class="mb-5">
                                        <?=$this->element("tagsShow", ["tags"=>$exam->exam_tags])?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-md-none d-lg-block col-lg-2">
                            <?php echo $this->element("sponsers_sidebar")?>
                        </div>
                    </div>
                </div>
                <?php }?>
                
                
                
                <!--       EXAM START      -->
                <?php if(isset($_GET['p']) && !empty($poll->id)){?>
                <div class="col-12 col-sm-12 ">
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-4 ">
                            <span>
                            <?php echo $this->Html->image( $mainImg , 
                                    ["class"=>"img-thumbnail ".$img_w, "show-img"=>"", "alt"=>""]); ?>
                            </span>                            
                        </div>
                        
                        <div class="col-12 col-md-6">
                            
                            
                            <form class="row" 
                                  action="<?=$path.'/'.$currlang?>/exams/answer"
                                  method="POST" id="poll_cvr">
                                
                                <?=$this->Form->control("poll.id", ["type"=>"hidden", "value"=>$poll->id]);?>
                                <?=$this->Form->control("poll.poll_type", ["type"=>"hidden", "value"=>$poll->poll_type]);?>
                                <?=$this->Form->control("poll.total_polls", ["type"=>"hidden", "value"=>$poll->total_polls]);?>
                                <?=$this->Form->control("poll.exam_slug", ["type"=>"hidden", "value"=>$exam->slug]);?>
                                <?=$this->Form->control("poll.exam_id", ["type"=>"hidden", "value"=>$exam->id]);?>
                                <?=$this->Form->control("poll.p", ["type"=>"hidden", "value"=>$this->request->getQuery('p')]);?>
                                <?=$this->Form->control("poll.matchid", ["type"=>"hidden", "value"=>$this->request->getQuery('matchid')]);?>
                                <?=$this->Form->control("poll.exam_calc_method", ["type"=>"hidden", "value"=>$exam->exam_calc_method]);?>
                                
                                <div class="col-12">
                                    <h1 class="pro-title"  id="poll_pos">
                                        <?=$poll->poll_title?>
                                        <small><?=($poll->total_answers*1)+1?> / <?=$poll->total_polls?></small>
                                    </h1>
                                    <p>
                                        <?=$poll->poll_text?>
                                        <div><small class="redText">
                                            <?= @$poll->poll_configs['minAnswers']*1 > 2 ? __('must_answer_at_least').' '.$poll->poll_configs['minAnswers'].' '.__('answers') : ''?>
                                        </small></div>
                                    </p>
                                    
                                    <div class="row mb-3">
                                        <?php foreach($poll->options as $k=>$option){
                                                $type = $this->Do->get('types_input')[$poll->poll_type];
                                                $mdl = $poll->poll_type == 1 ? "poll.selectedOptions" : "poll.selectedOptions[".$option->id."]";
                                                $name = $poll->poll_type == 1 ? "poll[options]" : "poll[options][]";
                                                $optImg = !empty($option->option_photo) ? $option->option_photo : 'option.svg';
                                                $isBigPhoto = @$poll->poll_configs['isBigPhoto'] == '1' ? '12 bigPhoto' : '12';
                                                $showImg = 'show-img';
                                                if($exam->exam_calc_method == 3){
                                                    $isBigPhoto = '-sm-4 col-6 bigPhoto';
                                                    $showImg = '';
                                                }
                                        ?>
                                            <?php if($poll->poll_type==4){ ?>
                                        <div class="col-12 mb-2">
                                            <label><?=($k+1).'-'.__('answer_with_text_value')?></label>
                                            <?=$this->Form->control("poll[options][".$option->id."]", [
                                                "label"=>false,
                                                "type"=>"text",
                                                "class"=>"form-control",
                                                "ng-model"=>$mdl,
                                                "autocomplete"=>"off"
                                            ])?>
                                        </div>
                                            <?php }else{ ?>
                                        <div class="funkyradio col-<?=$isBigPhoto?>">
                                            
                                            <div class="funkyradio-success ">
                                                <input type="<?=$type?>" name="poll[options][<?=$option->id?>]" ng-model="<?=$mdl?>" value="<?=$option->id?>" id="poll-options-<?=$option->id?>">
                                                <label for="poll-options-<?=$option->id?>">&nbsp;
                                                    <span>
                                                        <?=$this->Html->image("/img/options_photos/thumb/". $optImg, [$showImg=>""])?>
                                                    </span> 
                                                    <span><?=$option->option_text?></span>
                                                </label>
                                            </div>
                                        </div>
                                            <?php }?>
                                        <?php }?>
                                    </div>
                                    
                                    <div><small class="redText">
                                        <?= @$poll->poll_configs['minAnswers']*1 > 2 ? __('must_answer_at_least').' '.$poll->poll_configs['minAnswers'].' '.__('answers') : ''?>
                                    </small></div>

                                    <div class="pro-counter mb-5 ">
                                        <button type="submit" id="poll_btn"
                                                ng-disabled=" !isMinAnswers('<?=$poll->poll_configs['minAnswers']?>'*1, poll.selectedOptions);" class="btn btn-secondary swipe-to-top">
                                            <b><?=$poll->total_answers < $poll->total_polls ? __('do_answer') : __('answer_and_result')?></b>
                                            <span><i class="fa fa-paper-plane"></i></span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        
                            <div class="row">
                                <?php if(!$isLocal){?>
                                    <div class="col-12" id="1st_ad"></div>
                                <?php }?>
                            </div>
                        </div>
                        
                        <div class="col-12 d-md-none d-lg-block col-lg-2">
                            <?php echo $this->element("sponsers_sidebar")?>
                        </div>
                    </div>
                    
                    
                </div>
                <?php }?>
            </div>
        </div>
    </div>
</section>

    <div id="footer_game_slot" class="adArea"></div>
