
<!-- Signup Content -->
<section class="pro-content login-content">
<!--    LOGIN -->
    <div class="container" ng-if="signMode=='login'">
        <div class="row">
            <div class="pro-heading-title">
                <h1>
                    <?=__('login')?>
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                <div class="registration-process">
                    <h2 >
                        <?=__('login_msg')?>
                    </h2>
<!--					<form method="post" novalidate="novalidate" ng-submit="doLogin();" id="login_form">-->
                    <?php $this->Form->create($user, ["url"=>["controller"=>"Users", "action"=>"login"]])?>
                        <div class="from-group row mb-4">
                            <div class="input-group col-12">
                                <?=$this->Form->text("email", ["class"=>"form-control", "ng-model"=>"userdt.email" , "placeholder"=>"email"])?>
                            </div>
                        </div>
                        <div class="from-group row mb-4">
                            <div class="input-group col-12">
                                <?=$this->Form->password("password", ["class"=>"form-control", "ng-model"=>"userdt.password" , "placeholder"=>"password"])?>
                            </div>
                        </div>
                        <div class="from-group">
                            
<!--
                            <button class="btn btn-secondary swipe-to-top", id="login_btn">
                                 <?=__('Submit')?> <span></span>
                            </button>
-->
                            <?=$this->Form->button(__('Submit'), ["class"=>"btn btn-secondary swipe-to-top", "id"=>"login_btn"]);?>
                        </div>
                    <form>
                    <?php $this->Form->end()?>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                <h2>
                    <?=__('acount_features')?>
                </h2>
                <div class="registration-process">
                    <p>
                        <?=__('account_features_msg')?>
                    </p>
                    <?=__('dont_have_account')?>
                    <div class="from-group"> 
                        <a href class="btn btn-primary swipe-to-top" data-toggle="modal" data-target="#register_mdl" data-dismiss="modal">
                            <?=__('register')?> <i class="fas  fa-user-plus"></i> 
                        </a> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
