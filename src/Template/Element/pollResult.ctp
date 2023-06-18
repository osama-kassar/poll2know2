
    <?=$this->Form->create($poll)?>
    <?=$this->Form->control("poll.poll_type", ["type"=>"hidden", "value"=>$poll->poll_type])?>
    <?=$this->Form->control("poll.id", ["type"=>"hidden", "value"=>$poll->id])?>
<div class="row">
    <div class="col-12 <?php $poll->isHitted == 0 ? 'pollNotHitted' : 'pollNotHitted'?>">
        <h1 class="pro-title">
            <?=$poll->poll_title?>
        </h1>
        <p>
            <?=$poll->poll_text?>
        </p>
        
        
        <?php if($poll->poll_type < 3){?>
        <div class="row">
            <?php foreach($poll->options as $k=>$option){
                $img = empty($option->option_photo) ? "option.svg" : $option->option_photo;
            ?>
            <div class="funkyradio col-sm-<?=$poll->poll_configs->isBigPhoto == 1 ? '4 bigPhoto' : '12'?>">
                <div class="funkyradio-success">
                    <?php if($poll->isHitted == '0'){?>
                    <input  type="<?=$poll->poll_type==1 ? "radio" : "checkbox"?>"
                            name="<?=$poll->poll_type==1 ? "poll[options]" : "poll[options][]"?>"
                            ng-model="<?=$poll->poll_type==1 ? "poll.options" : "poll.options[".$option->id."]"?>"
                            value="<?=$option->id?>"
                            id="btn<?=$option->id?>"/>
                    <?php }?>
                    <label for="btn<?=$option->id?>">&nbsp;
                    <span><?=$this->Html->image("/img/options_photos/thumb/".$img, ["show-img"=>""])?></span> 
                    <span><?=$option->option_text?>
                        <i class="bordered-small">
                            <small> <?='('.floor($this->Do->prcntg($option->stat_hits, $poll->stat_hits)).'%)'?></small>
                            <?php if(in_array($option->id, $poll->userHitId)){?>
                            <small><i class="fas fa-check-circle"></i></small> 
                            <?php }?>
                        </i>
                    </span>
                    <span class="result-bar" style="max-width:<?=$this->Do->prcntg($option->stat_hits, $poll->stat_hits)?>%;"></span>
                    </label>
                </div>
            </div>
            <?php }?>
        </div>
        <?php }?>
        
        <?php if($poll->poll_type == 3){?>
        <div>
            <div class="rateOptionTitle"><?=$option->option_text?></div>
            <div class="rateOptions">
                <label for="radio<?=$option->id?>">
                <?=$this->element("rating", ["itm"=>$option])?>
                </label>
            </div>
        </div>
        <?php }?>
        
        <div class="pro-counter">
            <button type="submit" ng-if="'<?=$poll->isHitted?>' == 0" id="btn_poll" class="btn btn-secondary swipe-to-top">
                 <?=__("send_vote")?> <span><i class="fa fa-paper-plane"></i></span>
            </button>
        </div>
        <div class="pro-sub-buttons">
            <div class="buttons">
                <span>
                    <i class="fas fa-hand-pointer"></i>
                    <?=$poll->stat_hits?> <?=__('stat_hits')?>
                </span>
                <span>
                    <i class="fas fa-eye"></i>
                    <?=$poll->stat_views?> <?=__('stat_views')?>
                </span>
            </div>

            <!--    SHARE COMPONENT   -->
        </div>
        <div>
            <?=$this->element("tagsShow", ["tags"=>$poll->poll_tags])?>
        </div>
    </div>
</div>
    <?=$this->Form->end();?>
