<?php
$this->assign('title', __('sitemotto'));
?>

<div id="header_home_slot" class="adArea" style="display: block; max-width: 700px; margin:auto"></div>

<section class="page-content">

    <div class="container">
        <div class="row">

            <div class="col-12 col-md-8 articles">
                <h2 class="heading"><?= __('latest-added-exams') ?></h2>
                <div class="row">
                    
                    <?php foreach ($exams as $exam) { ?>
                        <a href="<?= $this->Url->build(["controller" => "Exams", "action" => "view", $exam->slug])?>" class="card col-12 col-lg-6 rounded-0 border-0">
                            <img class="card-img-top rounded-0" 
                                src="<?= $this->Url->build( !empty($exam->seo_image) ? '/img/exams_photos/thumb/' . $exam->seo_image : '/img/think' . rand(0, 4) . '.jpg' ) ?>" 
                                alt="<?=$exam->exam_title?>" />
                            <div class="card-body">
                                <span class="greenText">Learning</span>
                                <h5 class="card-title">
                                    <?= $exam->exam_title ?>
                                </h5>
                                <div class='card-text'>
                                    <?= $exam->exam_desc ?>
                                </div>
                                <p class="card-text">
                                    <small class="text-muted d-flex">
                                        <span><?= $exam->stat_views ?> <?=__('views')?></span>
                                        <span><?= $exam->stat_shares ?> <?=__('shares')?></span>
                                    </small>
                                </p>
                            </div>
                        </a>
                    <?php }; ?>

                    <div class="latest-polls">
                        <h2 class="heading"><?= __('latest-added-polls') ?></h2>
                        <?php foreach ($polls as $poll) {
                            $pollConfig = json_decode($poll->poll_configs);
                            $pollType = __('single_answer');
                            if ($poll->poll_type == 1) {
                                $pollType = __('one_choice');
                            }
                            if ($poll->poll_type == 2) {
                                $pollType = __('multiple_answer');
                            }
                            if ($poll->poll_type == 3) {
                                $pollType = __('rating');
                            }
                            if ($poll->poll_type == 4) {
                                $pollType = __('text_answer');
                            }?>
                            <div class="poll pb-4">
                                
                                <!-- <div href="#"> -->
                                <a href="<?= $this->Url->build(["controller" => "Polls", "action" => "view", $poll->slug])?>">
                                    
                                    <div class="row">
                                        <div class="col-5 image">
                                            <img 
                                                src="<?= $this->Url->build( !empty($poll->seo_image) ? '/img/polls_photos/thumb/' . $poll->seo_image : '/img/think' . rand(0, 4) . '.jpg' ) ?>" 
                                                alt="" />
                                        </div>
                                        <div class="info col-7">
                                            <span class="catagory"> <?= $pollType ?> </span>
                                            <h4> <?= $poll->poll_title ?></h4>
                                            <div class='poll-desc'>
                                                <?= $poll->poll_text ?>
                                            </div>
                                            <small class="text-muted d-flex">
                                                <span><?= $poll->stat_views ?> <?=__('views')?></span>
                                                <span><?= $poll->stat_shares ?> <?=__('shares')?></span>
                                            </small>
                                        </div>
                                    </div>

                        </a>
                            </div>
                        <?php }; ?>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4 side-bar">

                <div class="latest-posts">
                    <h4 class="head"><?=__('latest-added-exams')?></h4>
                    <?php foreach ($exams as $exam) { ?>
                        <div href="" class="post row">
                            <div class="col-4 image">
                                <img 
                                    src="<?= $this->Url->build(!empty($exam->seo_image) ? '/img/exams_photos/thumb/' . $exam->seo_image : '/img/think' . rand(0, 4) . '.jpg' ) ?>" 
                                    alt="" />
                            </div>
                            <div class="col-8">
                                <h5><?= $this->Html->link($exam->exam_title, ["controller" => "Exams", "action" => "view", $exam->slug]) ?>
                                </h5>
                                <small class="text-muted d-flex">
                                    <span><?= $poll->stat_views ?> <?=__('views')?></span>
                                    <span><?= $poll->stat_shares ?> <?=__('shares')?></span>
                                </small>
                            </div>
                        </div>
                    <?php }; ?>
                </div>

                <div class="catagories">
                    <h4 class="head"><?=__('categories')?></h4>
                    <div class="catagory-links">
                        <?php
                        foreach ($c_list as $itm) {
                            if ($itm->total_related > 0) {
                                echo $this->Html->link(__($itm->category_name) . " (" . $itm->total_related . ")", ["controller" => "Categories", "action" => "index", __($itm->category_name), $itm->id], ["class" => "link d-flex justify-content-between "]);
                            }
                        }
                        ?>
                    </div>
                </div>
                
                <?= $this->element("sponsers_sidebar"); ?>

            </div>
        </div>
    </div>
</section>

<!--  -->

<div id="footer_home_slot" class="adArea"></div>