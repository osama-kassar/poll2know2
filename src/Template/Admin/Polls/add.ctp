<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?=__('add_poll')?></h3>
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
            <div class="col-md-12 col-sm-12  ">

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
                                <?= $this->Form->create($poll,
                                    ["novalidate"=>"novalidate", 
                                    'class'=>'form-label-left input_mask',
                                    'id'=>'poll_form', "enctype"=>"multipart/form-data"]) ?>

                                <div class="col-md-6 col-sm-6  form-group has-feedback">
                                    <label><?=__('language_id')?></label>
                                    <div class="div">
                                        <?=$this->Form->control('language_id', [
                                            'class'=>'form-control has-feedback-left',
                                            'label'=>false,
                                            'type'=>'select',
                                            'mg-model'=>'langId',
                                            'options'=>$this->Do->lcl($this->Do->get('langs'))
                                        ])?>
                                        <span class="fa fa-globe form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 col-sm-6  form-group has-feedback">
                                    <label><?=__('category_id')?></label>
                                    <div class="div">
                                        <?=$this->Form->control('category_id', [
                                            'type'=>'select', 'label'=>false,
                                            'options'=>$categories,
                                            'class'=>'form-control has-feedback-left', 
                                            'empty'=>true, 'mg-model'=>'rec.poll.category_id'
                                        ])?>
                                        <span class="fa fa-sitemap form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 col-sm-6  form-group has-feedback">
                                    <label><?=__('poll_title')?></label>
                                    <div class="div">
                                        <?=$this->Form->control('poll_title', [
                                            'type'=>'text', 'class'=>'form-control has-feedback-left', 'mg-model'=>'rec.poll.poll_title', 'label'=>false
                                        ])?>
                                        <span class="fa fa-header form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 col-sm-6  form-group has-feedback">
                                    <label><?=__('poll_type')?></label>
                                    <div class="div">
                                        <?=$this->Form->control('poll_type', [
                                            'type'=>'select', 'options'=>$this->Do->get('types'), 'class'=>'form-control has-feedback-left', 'mg-model'=>'rec.poll.poll_type', 'label'=>false
                                        ])?>
                                        <span class="fa fa-flag-o form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>
                                
                                <div class="col-md-10 col-sm-10  form-group has-feedback">
                                    <label><?=__('poll_text')?></label>
                                    <div class="div">
                                        <?=$this->Form->control('poll_text', [
                                            'type'=>'textarea', 'class'=>'form-control has-feedback-left', 'mg-model'=>'rec.poll.poll_text', 'label'=>false
                                        ])?>
                                        <span class="fa fa-paragraph form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>
                                
                                <div class="col-md-2 col-sm-2 form-group has-feedback">
                                    
                                    <label >
                                        <i class="fa fa-camera"></i> <?=__("add_change")?>
                                        <?=$this->Form->control("seo_image", [
                                            "class"=>"form-control hideIt", 'type'=>'file',
                                            "file-model"=>"files.polls", 
                                            "mg-model"=>"rec.poll.seo_image", 
                                            "id"=>"poll", 'label'=>false
                                        ])?>
                                    </label>
                                    <div class="double_images">
                                        <a href ng-click="
                                            filesInfo['seo_image'].tmp_name=null;
                                            rec.poll.seo_image=null;">
                                            <i class="fa fa-times"></i>
                                        </a>

                                        <img src="<?=$app_folder.'/img/polls_photos/thumb/'. (!empty($poll->seo_image)?$poll->seo_image:'image-placeholder.jpg')?>" class="img" style="height:120px;"> 
                                        <img ng-if="filesInfo['seo_image'].tmp_name" src="{{filesInfo['seo_image'].tmp_name}}" 
                                            alt="" class="img" style="height:120px;">
                                    </div>
                                </div>
                                
                                <div class="col-md-12 col-sm-12 form-group has-feedback">
                                    <label><?=__('poll_keywords')?></label>
                                    <div class="div form-control has-feedback-left">
                                        <?=$this->element("tagInput", ["name"=>"seo_keywords"]);?>
                                        <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>
                                
                                
                                <div class="col-md-12 col-sm-12  form-group has-feedback">
                                    <label><?=__('poll_tags')?></label>
                                    <div class="div form-control has-feedback-left">
                                        <?=$this->element("tags", ["name"=>"poll_tags"]);?>
                                        <span class="fa fa-tags form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>
                                
<!--
                                <div class="col-md-4 col-sm-4  form-group has-feedback">
                                    <label><?=__('poll_configs_isPublic')?></label>
                                    <div class="div">
                                        <?=$this->Form->control('stat_ispublic', $this->Do->get('bool'), [
                                        'type'=>'select', 'class'=>'form-control has-feedback-left', 'mg-model'=>'rec.poll.stat_ispublic', 'label'=>false
                                        ])?>
                                        <span class="fa fa-bullhorn form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>
-->
<!--
                                
                                <div class="col-md-4 col-sm-4  form-group has-feedback">
                                    <label><?=__('poll_configs_expireDate')?></label>
                                    <div class="div">
                                        <?=$this->Form->control('poll_configs.expireDate', [
                                        'type'=>'text', 'class'=>'form-control has-feedback-left', 'mg-model'=>'rec.poll.poll_configs.expireDate',
                                        "date-picker"=>"", 'label'=>false
                                        ])?>
                                        <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-4  form-group has-feedback">
                                    <label><?=__('poll_configs_time')?></label>
                                    <div class="div">
                                        <?=$this->Form->control('poll_configs.time', [
                                        'type'=>'text', 'class'=>'form-control has-feedback-left', 'mg-model'=>'rec.poll.poll_configs.time',
                                        'placeholder'=>'Ex: 45', 'label'=>false
                                        ])?>
                                        <span class="fa fa-clock-o form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>
                                
                                <div class="col-md-4 col-sm-4 form-group has-feedback">
                                    <label><?=__('poll_priority')?></label>
                                    <div class="div">
                                        <?=$this->Form->control('poll_priority', [
                                        'type'=>'text', 'class'=>'form-control has-feedback-left', 'placeholder'=>'99', 'mg-model'=>'rec.poll.poll_priority', 'label'=>false
                                        ])?>
                                        <span class="fa fa-sort-numeric-asc form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 col-sm-6 form-group has-feedback">
                                    <label><?=__('stat_publish_at')?></label>
                                    <div class="div">
                                        <?=$this->Form->control('stat_publish_at', [
                                        'type'=>'text', 'class'=>'form-control has-feedback-left', 'date-picker'=>'', 'mg-model'=>'rec.poll.stat_publish_at', 'label'=>false
                                        ])?>
                                        <span class="fa fa-calendar-check-o form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>
-->

                                <div class="clearfix"></div>
                                
                                <div class="form-group ">
                                    <div class="col-md-12 col-sm-6  form-group has-feedback ">
                                        <button class="btn btn-info" > <?=__('submit')?>
                                            <span><i class="fa fa-save"></i></span>
                                        </button>
<!--
                                        <button type="button" class="btn btn-info" id="poll_form_cvr"
                            ng-click="doSave( '<?=$this->Url->build(["action"=>"request", "save", "-1"])?>',  rec.poll,  'poll_form',  '<?=$this->Url->build(["action"=>"edit"])?>' )"> <?=__('submit')?>
                                            <span><i class="fa fa-save"></i></span>
                                        </button>
-->
                                    </div>
                                </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


<!-- 
            <div class="col-sm-3">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?=__('filters')?> <small><?=__('polls')?></small></h2>


                        <div class="clearfix"></div>
                        <div class="x_content">

                            <div class="clearfix"></div>
                            <div>
                                sidebar
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div>