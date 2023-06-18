    <span class="rateImg">
    <?php 
        if(!empty($itm->option_photo)){
            echo $this->Html->image("/img/options_photos/thumb/".$itm->option_photo, ["alt"=>"", "class"=>"", "show-img"=>""]);
        };
        $itmId = $itm->id;
    ?>
    </span>
    <span class="rateRes">
        <span class="result-bar" ng-if="poll.isHitted == 1"><?=$itm->stat_totalrate?> / 5</span>
        <?php if(in_array($itm->id, $poll->userHitId)){?>
        <i class="bordered-small">
            <small><i class="fas fa-check-circle"></i></small> 
        </i>
        <?php }?>
    </span>
    <fieldset style="z-index: 22" class="rating" ng-init="poll.options['<?=$itmId?>'] = poll.isHitted == 1 ? '<?=$this->Do->rounder($itm->stat_totalrate)?>' : 0">
            
    <?php for($i=1; $i<6; $i++){ ?>
        <input type="radio" id="star<?=$i?>_<?=$itmId?>" 
               name="poll[options][<?=$itmId?>]" 
               value="<?=6-$i?>"
               ng-model="poll.options['<?=$itmId?>']" />
        <label class = "full" for="star<?=$i?>_<?=$itmId?>"></label>

        <input type="radio" id="star<?=$i?>half_<?=$itmId?>" 
               name="poll[options][<?=$itmId?>]" 
               value="<?=5-$i?>.5"
               ng-model="poll.options['<?=$itmId?>']"  />
        <label class="half" for="star<?=$i?>half_<?=$itmId?>"></label>
    <?php }?>
    </fieldset>