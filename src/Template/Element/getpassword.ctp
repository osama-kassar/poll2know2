
<!-- get password -->
<section class="pro-content login-content">
    <div class="container">
        <div class="row">
            <div class="pro-heading-title">
                <h3>
                    <?=__('getpassword')?>
                </h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="registration-process">
                    <h4>
                        <?=__('getpassword_msg')?>
                    </h4>
					<form method="post" novalidate="novalidate" ng-submit="doGetPassword();" id="getpassword_form">
                        <div class="from-group row mb-4">
                            <div class="input-group col-12">
                                <?=$this->Form->control("email", ["class"=>"form-control", "type"=>"text" ,"ng-model"=>"userdt.email" , "placeholder"=>__("email"), "label"=>false, 
                                'templates' => ['inputContainer' => '{{content}}']])?>
                            </div>
                        </div>
                        <div class="from-group">
                            <button class="btn btn-secondary swipe-to-top" id="getpassword_btn" type="submit"  ng-click="doGetPassword();" >
                                 <span><i class="fas fa-lock"></i></span> <?=__('submit')?>
                            </button>
                            <a href class="" data-toggle="modal" data-target="#login_mdl" data-dismiss="modal">
                                 <?=__('login')?>
                            </a> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
