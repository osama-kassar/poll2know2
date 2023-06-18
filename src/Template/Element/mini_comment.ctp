<?php
    $isForm = empty($isForm) ? false : $isForm;
    $id = 0;
    !empty($poll->id) ? $id = $poll->id : '';
    !empty($exam->id) ? $id = $exam->id : '';
    !empty($score->id) ? $id = $score->id : '';
?>

<div class="reviews">
    <!-- Add comment form -->
    <div class="comments_style" 
         ng-init="rec.comment.comment_target_id='<?=$id?>'">
        <form ng-submit="callAction ('/comments/add?ajax=1', 'comment', 'post', 'comment_btn', '', 'comments_form')" 
              id="comments_form" class="form_style1 row">


            <div class="col-12">
                <?=$this->Form->control("comment_text", [
                    "type"=>"textarea", "class"=>"form-control", 
                    "label"=>false ,"placeholder"=>__("tell_why"), 
                    "ng-model"=>"rec.comment.comment_text", "style"=>"height:50px"
                ])?>
            </div>

            <?php if(!empty($authUser)){ ?>
                <div class="col-6"><?=$authUser['user_fullname']?></div>
            <?php }else{?>
                <div class="col-6">
                    <?=$this->Form->control("comment_username", [
                        "class"=>"form-control", "label"=>false, "placeholder"=>__("comment_username"), "ng-model"=>"rec.comment.comment_username"
                    ])?>
                </div>
            <?php }?>

            <div class="col-6">
                <button class="btn btn-info" id="comment_btn" type="submit" style="padding: 7px 16px;">
                    <?=__('submit')?> <span></span></button>
            </div>
        </form>
    </div>
</div>





