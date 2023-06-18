<?php
$ctrl = $this->request->getParam('controller');
$name = 'exam_title';
$desc = 'exam_desc';
$ctrl_reverse = 'Exams';
if(in_array($ctrl, ['Exams'])){
    $name = 'poll_title';
    $desc = 'poll_text';
    $ctrl_reverse = 'Polls';
}
?>
    <!--  Categories  -->
<?php if(in_array($ctrl, ["Exams", "Polls"])){ ?>
    <div class="accordion shop-bar-categories">
        <div class="card">
          <div class="card-header">
            <a href="" class="mb-0"  data-toggle="collapse" data-target="#categories">
                <?=__('cats').' '.__($ctrl)?>
            </a>
          </div>

          <div id="categories" class="collapse show">
            <div class="card-body">
                <ul  class="brands">
                    <?php 
                        $related_tar = strtolower($ctrl).'_count';
                        foreach($c_list as $k=>$itm){
                            if($itm->$related_tar > 0){?>
                    <li>
                        <?=$this->Html->link('<i class="fas fa-angle-right"></i> '.__($itm->category_name).' <small>('.$itm->$related_tar.')</small>' , 
                            ["controller"=>$ctrl, "action"=>"index", "0", $itm->id, __($itm->category_name)], 
                            ["class"=>"brands-btn", "escape"=>false])?>
                    </li>
                    <?php } 
                    }?>
                </ul>
            </div>
          </div>
        </div>
    </div>
<?php }?>


    <!--  Related  -->
<?php if(in_array($ctrl, ["Exams", "Polls", "Scores", "Matches"])){ ?>
    <div class="accordion shop-bar-categories">
        <div class="card">
            <div class="card-header">
              <a href="" class="mb-0"  data-toggle="collapse" data-target="#related">
                  <?=__('related_'.strtolower($ctrl_reverse))?>
              </a>
            </div>

            <div id="related" class="collapse show">
              <div class="">
                  <ul class="sidebar_itm">
                    <?php 
                        foreach($related as $itm){
                            $img = empty($itm->seo_image) ? 'think'.rand(0, 4).'.jpg' : strtolower($ctrl_reverse).'_photos/thumb/'.$itm->seo_image;
                    ?>
                        <li class="">
                            <div >
                                <?=$this->Html->image("/img/".$img)?>
                            </div>
                            <div >
                                <div>
                                    <b><?=$this->Html->link( $itm->$name, 
                                    ["controller"=>$ctrl_reverse, "action"=>"view", $itm->slug], 
                                    ["class"=>"brands-btn", "escape"=>false])?></b>
                                </div>
                                <p>
                                    <small><?=substr($itm->$desc, 0 , 100)?></small>
                                    <?=$this->Html->link( ' <i class="fas fa-angle-double-right"></i> '.__('more'), 
                                    ["controller"=>$ctrl_reverse, "action"=>"view", $itm->slug], 
                                    ["class"=>"brands-btn", "escape"=>false])?>
                                </p>
                            </div>
                        </li>  
                    <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php }?>
<!-- 
    <div class="accordion shop-bar-categories" id="accordionExample3">
        <div class="card"> 
            <div class="card-header" id="CardThree">
              <a href="" class="mb-0"  data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseOne">
                  Color Selection
              </a>
            </div>

            <div id="collapseThree" class="collapse show" aria-labelledby="CardThree" data-parent="#accordionExample3">
              <div class="card-body">
                  <div class="pro-options">
                      <div class="color-selection">

                        <ul>
                          <li class="active"><a class="bg-primary " href="javascript:void(0);"></a></li>
                          <li ><a class="bg-secondary " href="javascript:void(0);"></a></li>
                          <li ><a class="bg-success " href="javascript:void(0);"></a></li>
                          <li ><a class="bg-info " href="javascript:void(0);"></a></li>
                          <li ><a class="bg-warning " href="javascript:void(0);"></a></li>
                          <li ><a class="bg-danger " href="javascript:void(0);"></a></li>

                          <li ><a class="bg-light " href="javascript:void(0);"></a></li>
                          <li ><a class="bg-dark " href="javascript:void(0);"></a></li>
                        </ul>
                        </div>

                  </div>
              </div>
            </div>
        </div> 
    </div>
-->
<!--
    <div class="accordion shop-bar-categories" id="accordionExample4">
        <div class="card">
            <div class="card-header" id="CardFour">
              <a href="" class="mb-0"  data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseOne">
                  Size Selection
              </a>
            </div>

            <div id="collapseFour" class="collapse show" aria-labelledby="CardFour" data-parent="#accordionExample4">
              <div class="card-body">
                  <div class="pro-options">
                  <div class="size-selection">

                        <ul>
                          <li class="active"><a href="javascript:void(0);" tabindex="0">28</a></li>
                          <li><a href="javascript:void(0);" tabindex="0">32</a></li>
                          <li><a href="javascript:void(0);" tabindex="0">34</a></li>
                          <li><a href="javascript:void(0);" tabindex="0">36</a></li>
                          <li><a href="javascript:void(0);" tabindex="0">38</a></li>
                          <li><a href="javascript:void(0);" tabindex="0">40</a></li>
                          <li><a href="javascript:void(0);" tabindex="0">42</a></li>
                          <li><a href="javascript:void(0);" tabindex="0">44</a></li>
                          <li><a href="javascript:void(0);" tabindex="0">46</a></li>
                        </ul>
                        </div>
                      </div>
              </div>
            </div>
        </div>
    </div>-->
