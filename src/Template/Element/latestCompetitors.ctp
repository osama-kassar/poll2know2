

<ul class="shopping-cart-items dropdown_list">
    <?php foreach($latestCompetitors as $itm){
            $conf = json_decode($itm->competitor_configs);
    ?>
    <li>
        <div class="img">
            <?=$this->Html->image('/img/avatars/'.$conf->competitor_avatar)?>
        </div>
        <div class="desc">
            <div><b><?=$itm->competitor_name?></b></div>
            <div class="greenText"><?=__('score').' <b>'.$itm->competitor_score.'%</b>'?></div>
            <div><?=$this->Html->link('<i class="fas fa-angle-double-right"></i> '.__('see_more'), ["controller"=>"competitions", "action"=>"view", $itm->competition_id], ["escape"=>false])?></div>
        <div>
    </li>
    <?php }?>
</ul>