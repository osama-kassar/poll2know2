<?php /*?><div class="tab-carousel-js row">

    <?php foreach($dt as $slide){ ?>

    <div class="col-12 col-sm-6  col-lg-4">
        <div class="product">
            <article>
                <div class="pro-thumb ">
                    <div class="pro-tag bg-primary">
                        <?=$slide->exam_tags?>
                    </div>
                    <div class="bgImg2" style="background-image: url('<?=$this->Url->build(
                            !empty($slide->seo_image) ? 
                            '/img/exams_photos/thumb/'.$slide->seo_image : '/img/think'.rand(0, 4).'.jpg'
                        )?>')">

                    </div>
                    <div class="pro-buttons d-lg-block d-xl-block">
                        <div class="desc"><?=$slide->exam_title?></div>
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
                        <?php echo $this->Html->link( $slide->exam_title ,       ["controller"=>"Polls", "action"=>"view", $slide->slug] )?>
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

    <?php }?>
</div>
<?php */?>