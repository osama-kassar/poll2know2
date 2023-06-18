<?= $this->element('whereIm') ?>
<?php

    $this->assign('title', $poll->poll_title);
    $isBigPhoto = 'col-12';
    if (@$poll->poll_configs->isBigPhoto == 1 && $poll->isHitted == 0) {
        $isBigPhoto = 'col-12 bigPhoto'; //'col-6 col-sm-4 bigPhoto';
    }
    if (@$poll->poll_configs->isBigPhoto == 1 && $poll->poll_type == 3) {
        $isBigPhoto = 'col-12 bigRate';
    }
?>

<div id="header_poll_slot" class="adArea"></div>

<section class="pro-content product-content" ng-init="poll.id = '<?= $poll->id ?>';
                  poll.isHitted = '<?= $poll->isHitted ?>';
                  poll.poll_type = '<?= $poll->poll_type ?>'">
    <div class="container">
        <div class="product-detail-info">
            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <?= $this->Html->image(
                                !empty($poll->seo_image) ?
                                    '/img/polls_photos/thumb/' . $poll->seo_image : '/img/think' . rand(0, 4) . '.jpg',
                                ["alt" => strip_tags($poll->poll_title), "class" => "img-thumbnail w100", "show-img" => ""]
                            ) ?>
                        </div>
                        <div class="col-12 col-lg-6">



                            <?= $this->Form->create($poll) ?>
                            <?= $this->Form->control("poll.poll_type", ["type" => "hidden", "value" => $poll->poll_type]) ?>
                            <?= $this->Form->control("poll.total_options", ["type" => "hidden", "value" => count($poll->options)]) ?>
                            <?= $this->Form->control("poll.id", ["type" => "hidden", "value" => $poll->id]) ?>

                            <?php // Options
                            ?>
                            <div class="row">
                                <div class="col-12 <?= $poll->isHitted == 0 ? 'pollNotHitted' : 'pollHitted' ?>">
                                    <h1 class="pro-title">
                                        <?= $poll->poll_title ?>
                                    </h1>
                                    <?php if ($poll->poll_type < 3) { ?>
                                        <div class="row">
                                            <?php foreach ($poll->options as $k => $option) {
                                                $img = empty($option->option_photo) ? "option.svg" : $option->option_photo;
                                            ?>
                                                <div class="funkyradio <?= $isBigPhoto ?> option_style">
                                                    <div class="funkyradio-success">
                                                        <?php if ($poll->isHitted == '0') { ?>
                                                            <input type="<?= $poll->poll_type == 1 ? "radio" : "checkbox" ?>" name="<?= $poll->poll_type == 1 ? "poll[options]" : "poll[options][]" ?>" ng-model="<?= $poll->poll_type == 1 ? "poll.options" : "poll.options[" . $option->id . "]" ?>" value="<?= $option->id ?>" id="btn<?= $option->id ?>" />
                                                        <?php } ?>
                                                        <label for="btn<?= $option->id ?>">&nbsp;
                                                            <span>
                                                                <?=(($poll->isHitted != 0 && $option->option_configs->isCorrect == '1') ? '<i class="fly-badge fa fa-check-circle"></i>' : '')?>
                                                                <?= $this->Html->image("/img/options_photos/thumb/" . $img, ["show-img" => "", "alt" => strip_tags($option->option_text)]) ?>
                                                            </span>
                                                            <span><?= $option->option_text ?>
                                                                <i class="bordered-small">
                                                                    <small> <?= '(' . floor($this->Do->prcntg($option->stat_hits, $poll->stat_hits)) . '%)' ?></small>
                                                                    <?php if (in_array($option->id, $poll->userHitId)) { ?>
                                                                        <small><i class="fas fa-check-circle"></i></small>
                                                                    <?php } ?>
                                                                </i>
                                                            </span>
                                                            <span class="result-bar" style="max-width:<?= $this->Do->prcntg($option->stat_hits, $poll->stat_hits) ?>%;"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>

                                    <?php if ($poll->poll_type == 3) {
                                        foreach ($poll->options as $k => $option) {
                                            $img = empty($option->option_photo) ? "option.svg" : $option->option_photo;
                                        ?>
                                            <div class="">
                                                <div class="rateOptionTitle"><?= $option->option_text ?></div>
                                                <div class="rateOptions <?= $isBigPhoto ?>">
                                                    <label for="radio<?= $option->id ?>">
                                                        <?= $this->element("rating", ["itm" => $option]) ?>
                                                    </label>
                                                </div>
                                            </div>
                                    <?php }
                                    } ?>

                                    <div class="pro-counter">
                                        <button type="submit" ng-if="'<?= $poll->isHitted ?>' == 0" id="btn_poll" class="btn btn-secondary swipe-to-top">
                                            <?= __("send_vote") ?> <span><i class="fa fa-paper-plane"></i></span>
                                        </button>
                                    </div>



                                    <!--  SHOW RESULT    -->
                                    <div class="row" ng-if="'<?= $poll->isHitted ?>' == 1">
                                        <div class="col-12">
                                            <?= $this->element('charts', ["ind" => 0, "type" => "pie"]) ?>
                                        </div>
                                    </div>

                                    <p>
                                        <?= ($poll->poll_text) ?>
                                    </p>
                                    <div>
                                        <?= $this->element("tagsShow", ["tags" => $poll->seo_keywords, "type" => "nolink"]) ?>
                                    </div>

                                </div>
                            </div>
                            <?= $this->Form->end(); ?>


                            <!-- MINI COMMNET-->
                            <!--
                        <div class="mt-3">
                            <? //=$this->element('mini_comment', ["comments"=>$poll->comments])
                            ?>
                        </div>
-->



                            <!--  COMMENTS & TAGS    -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-5">
                                        <?= $this->element('share', ["obj" => $poll, "mdl" => "Polls"]) ?>
                                    </div>
                                    <div class="mb-5">
                                        <?= $this->element("tagsShow", ["tags" => $poll->poll_tags]) ?>
                                    </div>
                                    <div class="mb-5">
                                        <?= $this->element('comments', ["comments" => $poll->comments]) ?>
                                    </div>
                                </div>
                            </div>

                            <!--   STATISTICS & TAGS   -->
                            <div class="pro-sub-buttons">
                                <div class="buttons">
                                    <span>
                                        <i class="fas fa-hand-pointer"></i>
                                        <?= $poll->stat_hits ?> <?= __('stat_hits') ?>
                                    </span>
                                    <span>
                                        <i class="fas fa-eye"></i>
                                        <?= $poll->stat_views ?> <?= __('stat_views') ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-md-none d-lg-block col-lg-2">
                            <?php echo $this->element("sponsers_sidebar") ?>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <!--

        <div class="related-product-content">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-6">
                    <div class="pro-heading-title">
                        <h1><?= __('related_polls') ?></h1>
                    </div>
                </div>
            </div>
            <?php //echo $this->element("h_slide", ["dt"=>$related])
            ?>

        </div>
-->
    </div>
</section>

<div id="footer_poll_slot" class="adArea"></div>


<button class="hideElm" data-toggle="modal" id="share_mdl_btn" data-target="#share_mdl"></button>
<script>
    setTimeout(() => {
        if ('<?= $poll->isHitted ?>' > 0) {
            $("#share_mdl_btn")[0].click();
        }
    }, 4000)
</script>