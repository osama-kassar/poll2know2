<div class="right_col" role="main" 
     ng-init="
        getRec('/admin/polls/view/<?=$this->request->getParam('pass')[0]?>', 'poll');
        pollId='<?=$poll->id?>';
        langId='<?=$poll->language_id?>';">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?=__('edit_poll')?></h3>
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

                
                
                
                
                <?php // Add Poll info?>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2><i class="fa fa-question"></i> <?=$poll->poll_title?>
                                </h2>
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
                                            'ng-model'=>'langId',
                                            'options'=>$this->Do->lcl($this->Do->get('langs'))
                                        ])?>
                                        <span class="fa fa-globe form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-6  form-group has-feedback">
                                    <label><?=__('category_id')?></label>
                                    <div class="div">
                                        <?=$this->Form->select('category_id', $categories, [
                                            'class'=>'form-control has-feedback-left', 'empty'=>true, 'mg-model'=>'rec.poll.category_id', 'label'=>false
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
                                            'options'=>$this->Do->get('types'),
                                            'type'=>'select', 'class'=>'form-control has-feedback-left', 'mg-model'=>'rec.poll.poll_type', 'label'=>false
                                        ])?>
                                        <span class="fa fa-flag-o form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>
                                
                                <div class="col-md-10 col-sm-10  form-group has-feedback">
                                    <label><?=__('poll_text')?></label>
                                    <div class="div">
                                        <?=$this->Form->control('poll_text', [
                                            'type'=>'textarea', 'class'=>'form-control has-feedback-left', 'ng-model'=>'rec.poll.poll_text', 'label'=>false,
                                            'ckeditor'=>'ckoptions'
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
                                    <label><?=__('seo_keywords')?></label>
                                    <div class="div form-control has-feedback-left">
                                        <?=$this->element("tagInput", ["name"=>"seo_keywords"]);?>
                                        <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>
                                
                                
                                
                                
                                
                                <?php if($authUser['user_role'] == 'admin.root'){
                                    echo $this->element('root_zone');
                                }?>
                                
                                
                                <div class="col-md-12 col-sm-12  form-group has-feedback">
                                    <label><?=__('poll_tags')?></label>
                                    <div class="div form-control has-feedback-left">
                                        <?=$this->element("tags", ["name"=>"poll_tags", "tags"=>$poll->poll_tags]);?>
                                        <span class="fa fa-tags form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>
                                
                                <div class="col-md-4 col-sm-4  form-group has-feedback">
                                    <label><?=__('poll_configs_isPublic')?></label>
                                    <div class="div">
                                        <?=$this->Form->control('stat_ispublic', [
                                        'type'=>'select', 'options'=>$this->Do->get('bool'), 'class'=>'form-control has-feedback-left', 'mg-model'=>'rec.poll.stat_ispublic', 'label'=>false
                                        ])?>
                                        <span class="fa fa-bullhorn form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>
                                
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

                                <div class="col-md-4 col-sm-4  form-group has-feedback">
                                    <label><?=__('poll_configs_isBigPhoto')?></label>
                                    <div class="div">
                                        <?=$this->Form->control('poll_configs.isBigPhoto', [
                                            'mg-model'=>'rec["exam"].polls[$index].poll_configs.isBigPhoto', 'type'=>'select', 'options'=>$this->Do->get('bool'), 'label'=>false,
                                            'class'=>'form-control has-feedback-left'])?>
                                        <span class="fa fa-image form-control-feedback left"></span>
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
                                
                                <div class="col-md-4 col-sm-4 form-group has-feedback">
                                    <label><?=__('stat_publish_at')?></label>
                                    <div class="div">
                                        <?=$this->Form->control('stat_publish_at', [
                                        'type'=>'text', 'class'=>'form-control has-feedback-left', 'date-picker'=>'', 'mg-model'=>'rec.poll.stat_publish_at', 'label'=>false
                                        ])?>
                                        <span class="fa fa-calendar-check-o form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                                
                                <div class="form-group ">
                                    <div class="col-md-12 col-sm-6  form-group has-feedback ">
                                        <button type="submit" class="btn btn-info" id="poll_form_cvr"> 
                                            <span><i class="fa fa-save"></i></span> <?=__('submit')?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                                
                                
 <button type="button" ng-click="getRec('/admin/polls/view/<?=$this->request->getParam('pass')[0]?>', 'poll')" class="hidden" id="updt_poll"></button>
                                
                                
                                
                <?php // Add Options?>
                
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2><i class="fa fa-bars"></i> <?=__("options")?></h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li class="icon2right"><a class="collapse-link"><i class="fa fa-eye"></i></a></li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content row">
                                <div class="col-md-12 col-sm-12 " ng-repeat="option in rec.poll.options track by $index">

                                    <div class="row">
                                        <div class="col-sm-9 form-group has-feedback" 
                                                title="<?=__('select_correct_value')?>">

                                            <div ckeditor="ckoptions_min" ng-model='option.option_text'  class="form-control has-feedback-left" placeholder="<?=__('add_new_option')?>"></div>
                                            
                                            <a href ng-if="'<?=$poll->poll_type?>' == 1" 
                                                ng-click="option.option_configs.isCorrect = option.option_configs.isCorrect==1 ? 0 : 1">
                                                <span tooltip
                                                    title="<?=__('select_correct_option')?>"
                                                    class="fa fa-dot-circle-o {{option.option_configs.isCorrect == 1 ? 'blueText' : ''}} form-control-feedback left"></span>
                                            </a>
                                            <a href ng-if="'<?=$poll->poll_type?>' == 2" 
                                                ng-click="option.option_configs.isCorrect = option.option_configs.isCorrect==1 ? 0 : 1">
                                                <span tooltip
                                                    title="<?=__('select_correct_option')?>"
                                                    class="fa fa-check {{option.option_configs.isCorrect == 1 ? 'greenText' : ''}} form-control-feedback left"></span>

                                            </a>
                                            <span ng-if="'<?=$poll->poll_type?>' == 3" tooltip
                                                    title="<?=__('rating_poll')?>"
                                                    class="fa fa-star form-control-feedback left goldText"></span>
                                            <a href ng-if="'<?=$poll->poll_type?>' == 4" 
                                                ng-click="option.option_configs.isCorrect = option.option_configs.isCorrect==1 ? 0 : 1">
                                                <span tooltip
                                                    title="<?=__('select_correct_option')?>"
                                                    class="fa fa-commenting-o {{option.option_configs.isCorrect == 1 ? 'greenText' : ''}} form-control-feedback left"></span>
                                            </a>
                                        </div>
                                        <div class="col-sm-3 h-tool">
                                            <span>
                                                <label  tooltip title="<?=__('change_photo')?>">
                                                    <div class="imgform">
                                                        <img src="{{filesInfo['option_'+option.id].tmp_name || app_folder+'/img/options_photos/thumb/'+ (!isPhoto(option.option_photo) ? 'image-placeholder.jpg' : option.option_photo) }}" 
                                                        alt="" class="opt_img" style="width:50px;">
                                                    
                                                        <span>
                                                            <a href ng-click="
                                                deletedphotos.push('options/'+option.option_photo);           
                                                option.option_photo=null;">
                                                                <i class="fa fa-times"></i>
                                                            </a>
                                                        </span>
                                                    </div>
                                                    <input type="file" class="form-control hidden" name="option_{{option.id}}" 
                                                        file-model="files.options[$index]" 
                                                        ng-model="option.option_photo">
                                                </label>
                                            </span>
                                            <span>
                                                <a href tooltip 
                                                    ng-click="
                                                              
                                                        rec.poll.options[$index].id < -1 ? 
                                                        rec.poll.options.pop() :
                                                        doDelete('/admin/options/delete/'+option.id, 'poll_'+$index );
                                                              
                                                        "
                                                    title="<?=__('delete_option')?>">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12 ">
                                    <button class="btn btn-info" type="button" id="updt_poll_cvr"
                                        ng-click="saveOptions(rec.poll, 'updt_poll')" >
                                        <span><i class="fa fa-save"></i></span> <?=__('save_poll_options')?>
                                    </button>
                                    <button class="btn btn-default" type="button" tooltip
                                        title="<?=__("add_new_option")?>"
                                        ng-click="
                                        rec.poll.options.push( newEntity('option', {poll_id: rec.poll.id, id: (rec.poll.options.length+1)}) )" >
                                        <i class="fa fa-plus"></i> <?=__('add_option')?>
                                    </button>
                                    <div class=" mb-5" ></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- <div class="col-sm-3">
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