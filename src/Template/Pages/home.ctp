<?php
	$this->assign('title', __('sitemotto'));
?>

    <div id="header_home_slot" class="adArea" style="display: block; max-width: 700px; margin:auto"></div>

<section class="pro-content pro-tab-content container">
    <div class="row">
        
        <div class="products-area col-lg-10">

            <div class="row justify-content-center">
                <div class="col-12 col-lg-12">
                    <div class="pro-heading-title">
                        <h1><?=__('latest-added-exams')?></h1>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <?php foreach($exams as $exam){?>
                <div class="col-12 col-md-6 col-lg-6 ">
                    <div class="popular-product exam_itm mb-5">
                        <article class="bgImg"
                                  style="background-image: url('<?=$this->Url->build(
                                        !empty($exam->seo_image) ? 
                                        '/img/exams_photos/thumb/'.$exam->seo_image : '/img/think'.rand(0, 4).'.jpg'
                                    )?>')">
                            <div class="pro-description">
                                <div>
                                    <h2 class="pro-title">
                                        <?=$this->Html->link($exam->exam_title, ["controller"=>"Exams", "action"=>"view", $exam->slug])?>
                                    </h2>
                                    <div class="pro-desc">
                                        <?=$exam->exam_desc?>
                                    </div>
                                    <small class="pro-price"> 
                                        <b><?=__('views')?></b> 
                                        <ins><?=$exam->stat_views?></ins> &nbsp; 
                                        <b><?=__('shares')?></b> 
                                        <ins><?=$exam->stat_shares?></ins> 
                                    </small>
                                    <div class="pro-options">
                                        <?=$this->Html->link(__('start_exam'), 
                                                ["controller"=>"Exams", "action"=>"view", $exam->slug], 
                                                ["class"=>"btn btn-secondary btn-block swipe-to-top"]) ?>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>

                <?php }; ?>
                
                <div class="col-12 text-center">
                    <?=$this->Html->link('<i class="fas fa-plus"></i> '.__('see_more_exams'), 
                        ["controller"=>"Exams"], ["class"=>"btn btn-light", "escape"=>false])?>
                </div>
            </div>

            
            <div class="clearfix mb-5"></div>
            
            <div class="row justify-content-center">
                <div class="col-12 col-lg-12">
                    <div class="pro-heading-title">
                        <h1><?=__('latest-added-polls')?></h1>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <?php foreach ($polls as $poll){ 
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
                <?php }; ?>
                
                <div class="col-12 text-center">
                    <?=$this->Html->link('<i class="fas fa-plus"></i> '.__('see_more_polls'), 
                        ["controller"=>"Polls"], ["class"=>"btn btn-light", "escape"=>false])?>
                </div>
            </div>
        </div>
        
        <div class="col-lg-2 text-center">
            <?=$this->element("sponsers_sidebar");?>
        </div>
    </div>
</section>

    <div id="footer_home_slot" class="adArea"></div>