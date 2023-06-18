

<div class="pro-banner-detial">
    <div class="row">
        <?php foreach($sponsers as $sponser){?>
        <div class="col-12 ">
            <div class="banner-single">
                <div class="panel">
                    <a href="<?=empty($sponser['link']) ? 'javascript:void(0);' : $sponser['link']?>" target="sponser">
                        <span><?=$this->Html->image("/img/sponsers/".$sponser['img'], ["alt"=>$sponser['name'], "style"=>"width:80%"])?></span>
                        <div class="block">
                            <h4 class="title"><?=$sponser['name']?></h4>
                            <p><?=$sponser['desc']?></p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <?php }?>
        <div class="col-12 ">
            <div class="banner-single">
                <div class="panel">
                    <a href ng-click="rec.emailus.reason = 'sponsership';
                                      toElm('bottom_div');">
                        <span class="fas fa-medal"></span>
                        <div class="block">
                            <h4 class="title"><?=__('be_our_sponsership')?></h4>
                            <p><?=__('add_your_logo_here')?></p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>