<!-- commnets -->
<div class="row comments_style" >

    <?php if(!empty($comments)){?>
    <h2 class="col-12"><?=__('comments')?></h2>
    <div class="col-12 ">
        <?php foreach($comments as $comment){
                $configs = json_decode($comment->comment_configs)
        ?>
        <div class=" ">
            <div class="comment_text">
                <?=$comment->comment_text?>
            </div>
            <div class="comment_avatar">
                <?=$this->Html->image("/img/emojis/".$configs->emoji, [
                    "alt"=>"", "style"=>"height: 35px; width:auto;"
                ])?>
                <br> 
                <?=$comment->user_id?>, <?=$comment->stat_created?>
            </div>
        </div>
        <?php }?>
    </div>
    <?php } ?>
    
    <!-- Add comment form -->
    <div class="addcomment_style col-12 ">
        <h2 class="col-12"><?=__('addcomment')?></h2>
        <form ng-submit="doAddComment()" name="formAddComment" class="form_style1">
            <div class="col-12 emojis">
                <?php for($i=1; $i<13; $i++){?>
                <span >
                    <a href 
                       ng-click="newComment._configs.emoji=emoji+'.svg'"
                       ng-class="{'selected': newComment._configs.emoji == emoji}">
                        <?=$this->Html->image("/img/emojis/".$i.".svg", [
                            "alt"=>"", "style"=>"height: 25px"
                        ])?>
                    </a>
                </span>
                <?php }?>
            </div>
            <label class="col-12">
                <div>
                    <?=$this->Html->image("/img/emojis/".(@$configs->emoji || 2).'.svg', [
                        "alt"=>"", "style"=>"height: 70px; width:auto;"
                    ])?>
                </div>
                <?=__('commnet_text')?>
                <?=$this->Form->input("comment_text", [
                    "type"=>"textarea", "chk"=>"isEmpty", "label"=>false, "class"=>"form-control"
                ])?>
            </label>
            <div class="col-12">
                <button class="btn btn-info" ng-disabled="formAddComment.$invalid" type="submit">
                <?=__('submit')?></button>
            </div>
        </form>
    </div>
</div>