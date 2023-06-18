
<?=$this->element('whereIm')?>

<?php
	$this->assign('title', $this->request->getParam('keyword'));
?>

<section class="pro-content shop-content shop-special" 
         ng-init="currTab = '<?=!empty($exams) ? 2 : 1?>'">
    <div class="container ">
        
        <!--    POLLS    -->
        <section class="row">

            <div class="col-md-10">

                <div class="nav nav-pills mb-5 text-center my-tabs" role="tablist">

                    <a class="nav-link nav-item {{currTab==1 ? 'active' : ''}}" href ng-click="currTab=1">(<?=count($polls->toArray())?>) <?=__("polls")?></a>

                    <a class="nav-link nav-item  {{currTab==2 ? 'active' : ''}}" href ng-click="currTab=2">(<?=count($exams->toArray())?>) <?=__("exams")?></a>

                </div>

                <!--    POLLS content    -->
                <div class="tab-content">
                    <div class="products-area tab-pane fade {{currTab==1 ? 'active show' : ''}}">
                        <div class="row">
                            <div id="swap" class="col-12 col-sm-12">
                                <div class="row">
                                    <?php 
                                    if(empty($polls->toArray())){echo __("no_data");}else{
                                        foreach ($polls as $poll){ 
                                        $pollConfig = json_decode($poll->poll_configs);
                                        $pollType = __('single_answer');
                                        if($poll->poll_type == 1){
                                            $pollType = __('one_choice');
                                        }
                                        if($poll->poll_type == 2){
                                            $pollType = __('multiple_answer');
                                        }
                                        if($poll->poll_type == 3){
                                            $pollType = __('rating');
                                        }
                                        if($poll->poll_type == 4){
                                            $pollType = __('text_answer');
                                        }
                                        if($pollConfig->expireDate > 0){
                                            $pollType = __('limited_period_poll');
                                        }?>
                                    <div class="col-12 col-sm-6  col-lg-4">
                                        <div class="product">
                                            <article>
                                                <div class="pro-thumb ">
                                                    <div class="pro-tag bg-primary">
                                                        <?=$pollType?>
                                                    </div>
                                                    <div class="bgImg2" style="background-image: url('<?=$this->Url->build(
                                                            !empty($poll->seo_image) ? 
                                                            '/img/polls_photos/thumb/'.$poll->seo_image : '/img/think'.rand(0, 4).'.jpg'
                                                        )?>')">

                                                    </div>
                                                    <div class="pro-buttons d-lg-block d-xl-block">
                                                        <div class="desc"><?=$poll->poll_text?></div>
                                                        
                                                    </div>
                                                </div>


                                                <div class="pro-description ">
                                                    <h2 class="pro-title">
                                                        <?php echo $this->Html->link( $poll->poll_title ,       ["controller"=>"Polls", "action"=>"view", $poll->slug] )?>
                                                    </h2>
                                                    <div class="pro-price">
                                                        <span>
                                                            <i class="fa fa-eye"></i>
                                                            <?=$poll->stat_views?>
                                                        </span>
                                                        <span>
                                                            <i class="fa fa-share-alt"></i>
                                                            <?=$poll->stat_shares?>
                                                        </span>
                                                    </div>
                                                </div>

                                            </article>
                                        </div>
                                    </div>
                                    <?php }
                                    }; ?>
                                </div>
                            </div>
                        </div>
                    </div>





                    <!--    EXAMS content    -->
                    <div class="products-area tab-pane fade {{currTab==2 ? 'active show' : ''}}">
                        <div class="row">
                            <div id="swap" class=" col-sm-12">
                                <div class="row">

                                    <?php 
                                    if(empty($exams->toArray())){echo __("no_data");}else{
                                        foreach($exams as $itm){?>

                                    <div class="col-md-6 col-lg-6 ">
                                        <div class="popular-product exam_itm mb-5">
                                            <article class="bgImg"
                                                      style="background-image: url('<?=$this->Url->build(
                                                            !empty($itm->seo_image) ? 
                                                            '/img/exams_photos/thumb/'.$itm->seo_image : '/img/think'.rand(0, 4).'.jpg'
                                                        )?>')">
                                                <div class="pro-description">
                                                    <div>
                                                        <h2 class="pro-title">
                                                            <?=$this->Html->link($itm->exam_title, ["controller"=>"Exams", "action"=>"view", $itm->slug])?>
                                                        </h2>
                                                        <div class="pro-desc">
                                                            <?=$itm->exam_desc?>
                                                        </div>
                                                        <small class="pro-price"> 
                                                            <b><?=__('views')?></b> 
                                                            <ins><?=$itm->stat_views?></ins> &nbsp; 
                                                            <b><?=__('shares')?></b> 
                                                            <ins><?=$itm->stat_shares?></ins> 
                                                        </small>
                                                        <div class="pro-options">
                                                            <?=$this->Html->link(__('start_exam'), 
                                                                    ["controller"=>"Exams", "action"=>"view", $itm->slug], 
                                                                    ["class"=>"btn btn-secondary btn-block swipe-to-top"]) ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                    </div>

                                    <?php }
                                    }; ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-2  text-center">
                <?=$this->element("sponsers_sidebar")?>
            </div>
        </section>
    </div>
</section>
    