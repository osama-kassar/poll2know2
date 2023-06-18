

<!-- Signup Content -->
<section class="pro-content login-content">
    <?php 
    if(empty($this->request->getQuery('debug'))){
        echo '<h3 class="text-center mb-5">'.__('users_management_soon').'<br>
        <a href class="btn btn-primary text-light swipe-to-top" 
            data-toggle="modal" 
            data-target="#login_mdl" data-dismiss="modal"> <i class="fas  fa-sign-in-alt"></i> '.__('login').'</a></h3>'; 
    }else{
    ?>
<!--    REGISTER -->
    <div class="container">
        <div class="row">
            <div class="pro-heading-title">
                <h3>
                    <?=__('register')?>
                </h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                <div class="registration-process">
					<form method="post" novalidate="novalidate" ng-submit="doRegister();" id="reg_form">
                    <?php //$this->Form->create($authUser, ["controller"=>"Users", "action"=>"register"])?>
                        <div class="from-group row mb-4">
                            <div class="input-group col-12">
                                <?=$this->Form->text("user_fullname", ["type"=>"text", "class"=>"form-control", "placeholder"=>__("user_fullname"), "ng-model"=>"userdt.user_fullname"])?>
                            </div>
                        </div>
                        <div class="from-group row mb-4">
                            <div class="input-group col-12">
                                <?=$this->Form->email("email", ["type"=>"text", "class"=>"form-control", "placeholder"=>__("email"), "ng-model"=>"userdt.email"])?>
                            </div>
                        </div>
                        <div class="from-group row mb-2">
                            <div class="input-group col-12">
                                <?=$this->Form->password("password", ["type"=>"password", "class"=>"form-control", "placeholder"=>__("password"), "ng-model"=>"userdt.password"])?>
                            </div>
                        </div>
                        <div class="from-group">
                            
                            <label class="mycheckbox" name="iagree">
                                <input type="checkbox" id="iagree" 
                                       ng-model="userdt.iagree"
                                       ng-false-value="false"
                                       ng-true-value="true"> 
                                <span></span> <?=__('terms_conditions')?>
                            </label>
                        </div>
<!--
                        <div class="from-group">
                            <label class="mycheckbox">
                                <input type="checkbox" name="maillist" id="maillist" 
                                       ng-model="userdt.maillist"
                                       ng-false-value="false"
                                       ng-true-value="true"> 
                                <span></span> <?=__('add_to_maillist')?>
                            </label>
                        </div>
-->
                        <div class="from-group">
                            <button class="btn btn-secondary swipe-to-top" id="register_btn">
                            <span><i class="fas  fa-user-plus"></i></span> <?=__('create_account')?> 
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                <h4>
                    <?=__('already_have_account')?>
                </h4>
                <div class="registration-process">
                    <p>
                        <?=__('already_have_account_msg')?>
                    </p>
                    <div class="from-group"> 
                        <a href class="btn btn-primary swipe-to-top" data-toggle="modal" data-target="#login_mdl" data-dismiss="modal" >
                            <i class="fas  fa-sign-in-alt"></i> <?=__('login')?> 
                        </a> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <div class="container">
        <div class="row">
        
            <div class="col-12 col-sm-12">
                <div class="registration-socials">
                    <p class="mb-3 text-center"><?=__('access_throught_socialmedia')?></p>
                    <div class="from-group">
                        <button type="button" class="btn btn-google swipe-to-top"><i class="fab fa-google-plus-g"></i> <?=__('google-plus')?></button>
                        <button type="button" class="btn btn-facebook swipe-to-top"><i class="fab fa-facebook-f"></i> <?=__('facebook')?></button>
                        <button type="button" class="btn btn-twitter swipe-to-top"><i class="fab fa-twitter"></i> <?=__('twitter')?></button>
                    </div>
                </div>
                <p><?=__('info_about_socialmedia_access')?></p>
            </div>
 
        </div>
    </div>
    <?php }?>
</section>
