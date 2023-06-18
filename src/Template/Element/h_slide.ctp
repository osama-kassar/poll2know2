
<!--

<div class="tab-carousel-js row">

    <?php /*foreach($dt as $slide){
        $pollConfig = json_decode($slide->poll_configs);
        $pollType = __('single_answer');
            if($slide->poll_type == 1){
                $pollType = __('one_choice');
            }
            if($slide->poll_type == 2){
                $pollType = __('multiple_answer');
            }
            if($slide->poll_type == 3){
                $pollType = __('rating');
            }
            if($slide->poll_type == 4){
                $pollType = __('text_answer');
            }
        if($pollConfig->expireDate > 0){
            $pollType = __('limited_period_poll');
        }
    ?>

    <div class="col-12 col-sm-6  col-lg-4">
        <div class="product">
            <article>
                <div class="pro-thumb ">
                    <div class="pro-tag bg-primary">
                        <?=$pollType?>
                    </div>
                    <div class="bgImg2" style="background-image: url('<?=$this->Url->build(
                            !empty($slide->seo_image) ? 
                            '/img/polls_photos/thumb/'.$slide->seo_image : '/img/think'.rand(0, 4).'.jpg'
                        )?>')">

                    </div>
                    <div class="pro-buttons d-lg-block d-xl-block">
                        <div class="desc"><?=$slide->poll_text?></div>
<!--
                        <div class="pro-icons">
                            <a href="wishlist.html" class="icon active swipe-to-top">
                              <i class="fas fa-eye"></i>
                            </a>
                            <a href="compare.html" class="icon swipe-to-top"><i class="fas fa-share-alt" data-fa-transform="rotate-90"></i></a>
                        </div>
-->
                    </div>
                </div>


                <div class="pro-description ">
                    <h2 class="pro-title">
                        <?php echo $this->Html->link( $slide->poll_title ,       ["controller"=>"Polls", "action"=>"view", $slide->slug] )?>
                    </h2>
                    <div class="pro-price">
                        <span>
                            <i class="fa fa-eye"></i>
                            <?=$slide->stat_views?>
                        </span>
                        <span>
                            <i class="fa fa-share-alt"></i>
                            <?=$slide->stat_shares?>
                        </span>
                    </div>
                </div>

            </article>
        </div>
    </div>

    <?php }*/?>
</div>
-->