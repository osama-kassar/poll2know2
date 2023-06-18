<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <ul class="nav side-menu">
        <?php foreach($admin_menu as $itm){ 
                $names = array_values(array_column($itm["sub"], "name"));
                $names[] = $itm["name"];
                $isActive = '';
                foreach($names as $name){
                    if(strpos($_SERVER['REQUEST_URI'], strtolower($name) ) !== false){
                        $isActive = 'active';
                    }
                }
            ?>
            <li class="<?=$isActive?>"><a><i class="fa fa-<?=$itm['icon']?>"></i> <?=__($itm['name'])?> <span class="fa fa-chevron-down"></span></a>
                
                <ul class="nav child_menu" style="<?=!empty($isActive) ? 'display: block' : ''?>;">
                <?php foreach($itm['sub'] as $subitm){ ?>
                    <li><?=$this->Html->link(__($subitm['name']), ['lang'=>$currlang, 'controller'=>$subitm["url"][0], 'action'=>$subitm["url"][1], $subitm["url"][2]])?></li>
                <?php }?>
                </ul>
            </li>
        <?php }?>
        </ul>
    </div>
</div>
<!-- /sidebar menu -->