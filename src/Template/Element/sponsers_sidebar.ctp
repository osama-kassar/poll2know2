

<div class="pro-banner-detial">
    <div class="row">
        
        <div class="col-12 mb-5"></div>
            
        <?php 
            foreach($sponsers as $k => $sponser){
                if($k == 1){
                    echo '<div id="sponsor_slot" class="adArea"></div>';
                }
        ?>
        
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
                    <a href="https://bit.ly/3qEH6j0" target="new">
                        <span class="fas fa-medal" style="font-size: 42px; padding: 20px;"></span>
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