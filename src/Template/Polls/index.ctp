
<?=$this->element('whereIm')?>


    <div id="header_polls_slot" class="adArea"></div>

<section class="pro-content shop-content shop-special">
    <div class="container">

        <section class="row">
            <div class="col-12 text-center mb-3">
                <h1><?=__('polls_list')?></h1>
            </div>
            <div class=" col-lg-3 d-lg-block d-xl-block right-menu hideMob-lg">
                <?php echo $this->element('sidebar')?>
            </div>
            
            <div class=" col-lg-7">
                <div class="products-area">
                    <div class="row">
                        <div id="swap" class="col-12">
                            <div class="row">
                                <?php 
                                
                                $ad_place = 0;
                                foreach ($polls as $k=>$poll){ 
                                    $ad_place++;
                                    if($ad_place==3){
                                        echo '<div id="listItem_polls_'.ceil($k/3) .'_slot" class="adArea"></div>';
                                        $ad_place=0;
                                    }
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
                                <div class="col-md-6">
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
                                                    <div class="desc">
                                                        <div><?=$this->Html->link( strip_tags($poll->poll_text) ,       ["controller"=>"Polls", "action"=>"view", $poll->slug] )?></div></div>
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
                                                <?php /*?><h2 class="pro-title">
                                                    <?php echo $this->Html->link( $poll->poll_title ,       ["controller"=>"Polls", "action"=>"view", $poll->slug] )?>
                                                </h2><?php */?>
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pagination justify-content-between mb-5">
                    <?=$this->element('paginator')?>
                </div>
            </div>
            
            <div class="col-lg-2 text-center">
                <?=$this->element("sponsers_sidebar");?>
            </div>
            
        </section>
    </div>
</section>

    <div id="footer_polls_slot" class="adArea"></div>
    