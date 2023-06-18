<!-- Signup Content -->
<section class="pro-content login-content">
    <?php //echo '<h3 class="text-center mb-5">'.__('users_management_soon').'</h3>'; 
    ?>
    <!--    LOGIN -->
    <div class="container" ng-if="signMode=='login'">
        <div class="row">
            <div class="pro-heading-title">
                <h3>
                    <?= __('login') ?>
                </h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6">

                <div class="registration-process">
                    <form method="post" novalidate="novalidate" ng-submit="doLogin();" id="login_form">
                        <?php //echo $this->Form->create(null, ["url"=>["controller"=>"Users", "action"=>"login"], "ng-submit"=>"doLogin();"])
                        ?>
                        <div class="from-group row mb-4">
                            <div class="input-group col-12">
                                <?= $this->Form->control("email", [
                                    "class" => "form-control", "type" => "text", "ng-model" => "userdt.email", "placeholder" => __("email"), "label" => false,
                                    'templates' => ['inputContainer' => '{{content}}']
                                ]) ?>
                            </div>
                        </div>
                        <div class="from-group row mb-4">
                            <div class="input-group col-12">
                                <?= $this->Form->control("password", [
                                    "class" => "form-control", "ng-model" => "userdt.password",
                                    "type" => "password", "label" => false,
                                    "placeholder" => __("password"),
                                    'templates' => ['inputContainer' => '{{content}}']
                                ]) ?>
                            </div>
                        </div>
                        <div class="from-group">

                            <button class="btn btn-secondary swipe-to-top" id="login_btn">
                                <span><i class="fas fa-sign-in-alt"></i></span> <?= __('login') ?>
                            </button>

                            <a href class="" data-toggle="modal" data-target="#getpassword_mdl" data-dismiss="modal">
                                <?= __('forget_password') ?>
                            </a>
                            <?php //$this->Form->button(__('Submit'), ["class"=>"btn btn-secondary swipe-to-top", "id"=>"login_btn"]);
                            ?>
                        </div>
                    </form>
                    <?php //$this->Form->end()
                    ?>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                <h4>
                    <?= __('acount_features') ?>
                </h4>
                <div class="registration-process">
                    <p>
                        <?= __('account_features_msg') ?>
                    </p>
                    <?= __('dont_have_account') ?>
                    <div class="from-group">
                        <a href class="btn btn-primary swipe-to-top" data-toggle="modal" data-target="#register_mdl" data-dismiss="modal">
                            <i class="fas  fa-user-plus"></i> <?= __('register') ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php ?>
</section>