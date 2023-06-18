<div class="sponsurships">
<?php 
            foreach($sponsers as $k => $sponser){
                if($k == 1){
                    echo '<div id="sponsor_slot" class="adArea"></div>';
                }
        ?>
              <div class="sponsure text-center">
                <a href="<?=empty($sponser['link']) ? 'javascript:void(0);' : $sponser['link']?>" target="sponser">
                <?=$this->Html->image("/img/sponsers/".$sponser['img'], ["alt"=>$sponser['name'], "style"=>"width:80%"])?>
                  <h2><?=$sponser['name']?></h2>
                  <p><?=$sponser['desc']?></p>
                </a>
              </div>
              <?php }?>
              <div class="sponsure text-center">
                <a
                  href="https://api.whatsapp.com/send/?phone=905346346466&text&app_absent=0l"
                  target="_blank"
                >
                  <span
                    class="icon-medal"
                    style="font-size: 42px; padding: 20px"
                  ></span>
                  <h2><?=__('be_our_sponsership')?></h2>

                  <p><?=__('add_your_logo_here')?></p>
                </a>
              </div>

            </div>

