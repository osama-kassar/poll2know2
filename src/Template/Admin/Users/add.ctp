<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?=__('add_user')?></h3>
            </div>

            <div class="title_right">
                
            </div>
        </div>

        <div class="clearfix"></div>


        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <ul class="nav navbar-right panel_toolbox">
                            <li class="icon2right"><a class="collapse-link"><i class="fa fa-eye"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">

                        <!-- <p>Add class <code>bulk_action</code> to table for bulk actions options on row select</p> -->
                        <?= $this->Form->create($user, ['class'=>'form-label-left input_mask', "enctype"=>"multipart/form-data"]) ?>

                        <div class="col-sm-6  form-group has-feedback">
                            <label><?=__('user_fullname')?></label>
                            <div class="div">
                                <?=$this->Form->control('user_fullname', [
                                    'class'=>'form-control has-feedback-left',
                                    'label'=>false,
                                    'type'=>'text'
                                ])?>
                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="col-sm-6  form-group has-feedback">
                            <label><?=__('email')?></label>
                            <div class="div">
                                <?=$this->Form->control('email', [
                                    'class'=>'form-control has-feedback-left',
                                    'label'=>false,
                                    'type'=>'text'
                                ])?>
                                <span class="fa fa-at form-control-feedback left" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="col-sm-6  form-group has-feedback">
                            <label><?=__('password')?></label>
                            <div class="div">
                                <?=$this->Form->control('password', [
                                    'class'=>'form-control has-feedback-left',
                                    'label'=>false,
                                    'type'=>'password'
                                ])?>
                                <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="col-sm-6  form-group has-feedback">
                            <label><?=__('user_role')?></label>
                            <div class="div">
                                <?=$this->Form->control('user_role', [
                                    'class'=>'form-control has-feedback-left',
                                    'label'=>false,
                                    'type'=>'select',
                                    'options'=>$this->Do->get('roles')
                                ])?>
                                <span class="fa fa-shield form-control-feedback left" aria-hidden="true"></span>
                            </div>
                        </div>
                        
                        <div class="form-group ">
                            <div class="col-12 col-sm-12  form-group has-feedback ">
                                <button type="submit" class="btn btn-info"><?=__('submit')?></button>
                            </div>
                        </div>
                        <?=$this->Form->control('iagree', [
                                    'value'=>true,
                                    'type'=>'hidden'
                                ])?>
                        <?=$this->Form->end();?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>