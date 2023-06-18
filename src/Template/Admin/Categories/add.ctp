<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?=__('edit_category')?></h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="<?=__('searchfor')?>">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button"><?=__('go')?></button>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-9 col-sm-9  ">

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
                                <?= $this->Form->create($category, ['class'=>'form-label-left input_mask']) ?>
                                
                                <div class="col-md-7 col-sm-7  form-group has-feedback">
                                    <label><?=__('category_name')?></label>
                                    <div class="div">
                                        <?=$this->Form->text('category_name', [
                                            'type'=>'text', 'class'=>'form-control has-feedback-left'
                                        ])?>
                                        <span class="fa fa-header form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-6  form-group has-feedback">
                                    <label><?=__('language_id')?></label>
                                    <div class="div">
                                        <?=$this->Form->select('language_id', $languages, [
                                            'class'=>'form-control has-feedback-left'
                                        ])?>
                                        <span class="fa fa-globe form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-6  form-group has-feedback">
                                    <label><?=__('parent_id')?></label>
                                    <div class="div">
                                        <?=$this->Form->select('parent_id', $parents, [
                                            'class'=>'form-control has-feedback-left', 'empty'=>true
                                        ])?>
                                        <span class="fa fa-sitemap form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>
                                
                                <div class="clearfix"></div>
                                
                                <div class="col-md-4 col-sm-4  form-group has-feedback">
                                    <label><?=__('category_params_icon')?></label>
                                    <div class="div">
                                        <?=$this->Form->text('category_params.icon', [
                                        'type'=>'text', 'class'=>'form-control has-feedback-left', 'placeholder'=>'fa fa-*'
                                        ])?>
                                        <span class="fa fa-asterisk form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>
                                
                                <div class="col-md-4 col-sm-4  form-group has-feedback">
                                    <label><?=__('category_params_link')?></label>
                                    <div class="div">
                                        <?=$this->Form->text('category_params.link', [
                                        'type'=>'text', 'class'=>'form-control has-feedback-left', 'placeholder'=>'/categories/add'
                                        ])?>
                                        <span class="fa fa-link form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>
                                
                                <div class="col-md-4 col-sm-4  form-group has-feedback">
                                    <label><?=__('category_params_isProtected')?></label>
                                    <div class="div">
                                        <?=$this->Form->select('category_params.isProtected', ["0"=>__("no"), "1"=>__("yes")], [
                                        'type'=>'text', 'class'=>'form-control has-feedback-left'
                                        ])?>
                                        <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>
                                
                                <div class="col-md-4 col-sm-4 form-group has-feedback">
                                    <label><?=__('category_priority')?></label>
                                    <div class="div">
                                        <?=$this->Form->number('category_priority', [
                                        'type'=>'text', 'class'=>'form-control has-feedback-left', 'placeholder'=>'99'
                                        ])?>
                                        <span class="fa fa-sort-numeric-asc form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>

                                <div class="clearfix"></div>

                                <div class="form-group ">
                                    <div class="col-md-12 col-sm-6  form-group has-feedback ">
                                        <button type="submit" class="btn btn-info"><?=__('submit')?></button>
                                    </div>
                                </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-sm-3">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?=__('filters')?> <small><?=__('categories')?></small></h2>


                        <div class="clearfix"></div>
                        <div class="x_content">

                            <div class="clearfix"></div>
                            <div>
                                sidebar
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>