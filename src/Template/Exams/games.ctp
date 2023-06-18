<?=$this->element('whereIm')?>

    <div id="header_games_slot" class="adArea"></div>

<section class="pro-content shop-content shop-special">
    <div class="container">
        <div class="row">
            <div class="pro-heading-title col-12">
                <h1><?=__('games_list')?></h1>
            </div>
        </div>

        <section class="row">

            <div class="col-lg-2  d-lg-block d-xl-block right-menu hideMob-lg">
                <?php echo $this->element('sidebar')?>
            </div>

            <div class="col-12 col-lg-8">
                <div class="products-area">
                    <div class="row">
                        <div id="swap" class="col-12 col-sm-12">
                            <div class="row">

                                <?php 
                                $ad_place = 0;
                                foreach ($exams as $k=>$itm){ 
                                    $ad_place++;
                                    if($ad_place==3){
                                        echo '<div id="listItem_games_'.ceil($k/3) .'_slot" class="adArea"></div>';
                                        $ad_place=0;
                                    }
                                ?>

                                <div class="col-12 col-md-6 col-lg-6 ">
                                    <div class="popular-product exam_itm mb-5">
                                        <article class="bgImg"
                                                  style="background-image: url('<?=$this->Url->build(
                                                        !empty($itm->seo_image) ? 
                                                        '/img/exams_photos/thumb/'.$itm->seo_image : '/img/think'.rand(0, 4).'.jpg'
                                                    )?>')">
                                            <div class="pro-description">
                                                <div>
                                                    <h2 class="pro-title"> 
                                                        <?=$this->Html->link($itm->exam_title, ["controller"=>"Exams", "action"=>"game", $itm->slug])?>
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
                                                        <?=$this->Html->link(__('start_game'), 
                                                                ["controller"=>"Exams", "action"=>"game", $itm->slug], 
                                                                ["class"=>"btn btn-secondary btn-block swipe-to-top"]) ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                </div>

                                <?php }; ?>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" pagination mb-5">
                    <?=$this->element('paginator')?>
                </div>
            </div>
            <div class="col-lg-2 text-center">
                <?=$this->element("sponsers_sidebar");?>
            </div>
        </section>
    </div>
</section>

    <div id="footer_games_slot" class="adArea"></div>
    