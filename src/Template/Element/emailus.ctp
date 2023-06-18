<?php
    $id=empty($id) ? 0 : $id;
?>
<form class="row emailus" name="emailus_form_<?=$id?>" id="emailus_form" novalidate="novalidate" 
      ng-submit="
        rec.emailus.CaptchaCodeSource = getAttr('#CaptchaCode<?=$id?>', 'dt-src');
        rec.emailus.captchaId = '<?=$id?>';
        rec.emailus.CaptchaCode = CaptchaCode<?=$id?>;
        rec.emailus.page = '<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>';
        callAction('/contacts/emailus?ajax=1', 'emailus', 'POST', 'emailus_btn', 'paper-plane', 'emailus_form');">
    <div class="col-sm-6">
        <?=$this->Form->control("rec.emailus.name", 
            ["class"=>"form-control", "type"=>"text", "placeholder"=>__("name"), "label"=>false, "ng-model"=>"rec.emailus.from", "chk"=>"isEmpty"])?>
    </div>
    <div class="col-sm-6">
        <?=$this->Form->control("rec.emailus.email", 
            ["class"=>"form-control", "type"=>"text", "placeholder"=>__("email"), "label"=>false, "ng-model"=>"rec.emailus.email", "chk"=>"isEmail"])?>

    </div>
    <div class="col-12">
        <?=$this->Form->control("rec.emailus.message", 
            ["class"=>"form-control", "type"=>"textarea", "placeholder"=>__("message"), "label"=>false, "ng-model"=>"rec.emailus.message", "chk"=>"isParagraph", "style"=>"height:60px"])?>
    </div>
    <div class="col-auto">
        <button class="btn btn-secondary swipe-to-top" type="submit" ng-disabled="emailus_form_<?=$id?>.$invalid" id="emailus_btn">
             <span><i class="fas fa-paper-plane"></i></span> <?=__('send')?>
        </button>
    </div>
    <div class="col text-left" style="padding-top: 4px ">
        <?=$this->Do->captcha($id)?>
    </div>
</form>