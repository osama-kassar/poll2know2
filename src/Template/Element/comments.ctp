<?php
    $isForm = empty($isForm) ? false : $isForm;
    $id = 0;
    !empty($poll->id) ? $id = $poll->id : '';
    !empty($exam->id) ? $id = $exam->id : '';
    !empty($score->id) ? $id = $score->id : '';

?>


<div class="nav nav-pills" role="tablist" ng-init="currTab='<?=empty($comments) ? 1 : 2?>'">
    <a class="nav-link nav-item {{currTab==1 ? 'active' : ''}}" href ng-click="currTab=1"><?=__("add_comment")?></a>
    
    <?php if(!empty($comments)){?>
    <a class="nav-link nav-item  {{currTab==2 ? 'active' : ''}}" href ng-click="currTab=2"><?=__("see_comments")?></a>
    <?php }?>
    
</div>
<div class="tab-content">
    <div class="tab-pane fade {{currTab==1 ? 'active show' : ''}}">
        <div class="reviews">
            
            
            <!-- Add comment form -->
            <div class="comments_style" ng-init="rec.comment.comment_target_id='<?=$id?>'">
                <form ng-submit="
                                 callAction ('/comments/add?ajax=1', 'comment', 'post', 'comment_btn', '', 'comments_form')
                                 " id="comments_form" class="form_style1 row">
                    <div class="col-12 emojis">
                        <div><?=__('select_emoji')?></div>
                        <span ng-repeat="n in range(12)">
                            <a href 
                               ng-click="rec.comment.comment_useremoji=n+'.svg';"
                               ng-class="{'selected': n+'.svg' == rec.comment.comment_useremoji}">
                                <img ng-src="<?=$path?>/img/emojis/{{n}}.svg" style="height: 25px">
                            </a>
                        </span>
                    </div>

                    <?php if(!empty($authUser)){ 
                                echo '<div class="col-12">'.$authUser['user_fullname'].'</div>';
                          }else{?>

                    <div class="col-sm-6">
                        <?=$this->Form->control("comment_username", [
                            "class"=>"form-control", "label"=>false, "placeholder"=>__("comment_username"), "ng-model"=>"rec.comment.comment_username"
                        ])?>
                    </div>
                    <div class="col-sm-6">
                        <?=$this->Form->control("comment_useremail", [
                            "class"=>"form-control", "label"=>false, "type"=>"text",  "placeholder"=>__("comment_email"), "ng-model"=>"rec.comment.comment_useremail"
                        ])?>
                    </div>

                    <?php }?>

                    <div class="col-12">
                        <?=$this->Form->control("comment_text", [
                            "type"=>"textarea", "class"=>"form-control", "label"=>false ,"placeholder"=>__("comment_text"), "ng-model"=>"rec.comment.comment_text"
                        ])?>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-info" id="comment_btn" type="submit">
                            <?=__('submit')?> <span></span></button>
                    </div>
                </form>
            </div>
            
            
            
        </div>
    </div>
    
    
    
    
    <div class="tab-pane fade {{currTab==2 ? 'active show' : ''}}">
        <div class="reviews">
            
            <!-- comments -->
            <div class="row comments_style">
                <?php if(!empty($comments)){?>
                <h2 class="col-12"><?=__('comments')?></h2>
                <div class="col-12 ">
                    <?php foreach($comments as $comment){
                        //debug($comment);
                    ?>
                    <div class=" ">
                        <div class="comment_text">
                            <?=$comment->comment_text?>
                        </div>
                        <div class="comment_avatar">
                            <?=$this->Html->image("/img/emojis/".$comment->comment_useremoji, [
                                "alt"=>"emoji"
                            ])?> <small> <?=($comment->comment_username||$comment->stat_ip)?> <?=$comment->comment_username?></small>
                        </div>
                    </div>
                    <?php }?>
                </div>
                <?php } ?>
            </div>
            
            
        </div>
    </div>
</div>





