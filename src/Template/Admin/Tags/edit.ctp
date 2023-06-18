<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?=__('add_tag')?></h3>
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
                        <?= $this->Form->create($tag, ['class'=>'form-label-left input_mask', "enctype"=>"multipart/form-data"]) ?>

                        <div class="col-12  form-group has-feedback">
                            <label><?=__('tag')?></label>
                            <div class="div">
                                <?=$this->Form->control('tag', [
                                    'class'=>'form-control has-feedback-left',
                                    'label'=>false,
                                    'type'=>'text'
                                ])?>
                                <span class="fa fa-tag form-control-feedback left" aria-hidden="true"></span>
                            </div>
                        </div>
                        
                        <div class="clearfix"></div>

                        <div class="form-group ">
                            <div class="col-12  form-group has-feedback ">
                                <!-- <button type="button" class="btn btn-primary">Cancel</button>
                            <button class="btn btn-primary" type="reset">Reset</button> -->
                                <button type="submit" class="btn btn-info"><?=__('submit')?></button>
                            </div>
                        </div>

                        <?=$this->Form->end();?>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>