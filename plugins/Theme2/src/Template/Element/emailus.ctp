<?php
$id = empty($id) ? 0 : $id;
?>


<form class="row align-items-center" name="emailus_form_<?= $id ?>" id="emailus_form" novalidate="novalidate" ng-submit="
        rec.emailus.CaptchaCodeSource = getAttr('#CaptchaCode<?= $id ?>', 'dt-src');
        rec.emailus.captchaId = '<?= $id ?>';
        rec.emailus.CaptchaCode = CaptchaCode<?= $id ?>;
        rec.emailus.page = '<?= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>';
        callAction('/contacts/emailus?ajax=1', 'emailus', 'POST', 'emailus_btn', 'paper-plane', 'emailus_form');">
    <div class="col-sm-6 ">
        <?= $this->Form->control(
            "rec.emailus.name",
            ["class" => "form-control", "type" => "text", "placeholder" => __("name"), "label" => false, "ng-model" => "rec.emailus.from", "chk" => "isEmpty", "templates"=>["inputContainer"=>"{{content}}"]]
        ) ?>
    </div>
    <div class="col-sm-6 ">
        <?= $this->Form->control(
            "rec.emailus.email",
            ["class" => "form-control", "type" => "text", "placeholder" => __("email"), "label" => false, "ng-model" => "rec.emailus.email", "chk" => "isEmail", "templates"=>["inputContainer"=>"{{content}}"]]
        ) ?>
    </div>
    <div class="col-12">
        <?= $this->Form->control(
            "rec.emailus.message",
            ["class" => "form-control", "type" => "textarea", "placeholder" => __("message"), "label" => false, "ng-model" => "rec.emailus.message", "chk" => "isParagraph", "rows" => "2"]
        ) ?>
    </div>
    
    <div class='col'>
        <button class="btn disabled d-flex justify-content-between align-items-center gap-2" type="submit" ng-disabled="emailus_form_<?= $id ?>.$invalid" id="emailus_btn">
            <i class="fas fa-paper-plane"></i>
            <?= __('send') ?>
        </button>
    </div>
    
    <div class="col" style="padding-top: 4px ">
        <?= $this->Do->captcha($id) ?>
    </div>
</form>