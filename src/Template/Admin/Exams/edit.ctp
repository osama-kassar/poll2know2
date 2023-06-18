<?php //debug($exam->toArray());die();?>
<div class="right_col" role="main" 
     ng-init="
        getRec('/admin/exams/view/<?=$this->request->getParam('pass')[0]?>', 'exam');
        examId='<?=$exam->id?>';
        langId='<?=$exam->language_id?>';
        exam_desc='<?= htmlspecialchars($exam->exam_desc)?>';
              ">
<button type="button" id="get_exam" class="hideIt" ng-click="
        getRec('/admin/exams/view/'+examId, 'exam')"></button>
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?=__('edit_exam')?></h3>
            </div>
            <div class="title_right">
                
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="row">
                    
                    
                    <!-- Exam Edit -->
                    <div class="col-md-12 col-sm-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2><i class="fa fa-graduation-cap"></i> <?=__('exam_title')?>: <?=$exam->exam_title?>
                                </h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li class="icon2right"><a class="collapse-link"><i class="fa fa-eye"></i></a></li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>

                            <div class="x_content" >
                                <?= $this->Form->create($exam, ['class'=>'form-label-left input_mask', 'id'=>'exam_form', "novalidate"=>"novalidate", "enctype"=>"multipart/form-data"]) ?>
                                
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
                                    <label><?=__('exam_title')?></label>
                                    <div class="div">
                                        <?=$this->Form->control('exam_title', [
                                            'class'=>'form-control has-feedback-left',
                                            'label'=>false,
                                            'type'=>'text'
                                        ])?>
                                        <span class="fa fa-header form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 col-sm-6  form-group has-feedback">
                                    <label><?=__('category_id')?></label>
                                    <div class="div">
                                        <?=$this->Form->control('category_id', [
                                            'options'=>$categories, 
                                            'class'=>'form-control has-feedback-left',
                                            'label'=>false,
                                            'type'=>'select'
                                        ])?>
                                        <span class="fa fa-bars form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>
                                
                                <div class="clearfix"></div>
                                
                                <!-- <div class="col-md-3 col-sm-3  form-group has-feedback">
                                    <label><?=__('exam_period')?></label>
                                    <div class="div">
                                        <?=$this->Form->text('exam_period', [
                                            'type'=>'text', 'class'=>'form-control has-feedback-left'
                                        ])?>
                                        <span class="fa fa-clock-o form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div> -->
                                
                                <div class="col-md-4 col-sm-4  form-group has-feedback">
                                    <label><?=__('exam_calc_method')?></label>
                                    <div class="div">
                                        <?=$this->Form->control('exam_calc_method', [
                                            'options'=>$this->Do->get('exam_calc_method'), 
                                            'class'=>'form-control has-feedback-left',
                                            'label'=>false,
                                            'type'=>'select'
                                        ])?>
                                        <span class="fa fa-calculator form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>
                                
                                <div class="col-md-4 col-sm-4  form-group has-feedback">
                                    <label><?=__('exam_configs.showReview')?></label>
                                    <div class="div">
                                        <?=$this->Form->control('exam_configs.showReview', [
                                            'options'=>$this->Do->get('bool'), 
                                            'class'=>'form-control has-feedback-left',
                                            'label'=>false,
                                            'type'=>'select'
                                        ])?>
                                        <span class="fa fa-search form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>
                                
                                <div class="col-md-4 col-sm-4  form-group has-feedback">
                                    <label><?=__('exam_configs.showAnswers')?></label>
                                    <div class="div">
                                        <?=$this->Form->control('exam_configs.showAnswers', [ 
                                            'class'=>'form-control has-feedback-left',
                                            'label'=>false,
                                            'type'=>'select', 'options'=>$this->Do->get('bool')
                                        ])?>
                                        <span class="fa fa-check form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>
                                
                                <!-- <div class="col-md-3 col-sm-3  form-group has-feedback">
                                    <label><?=__('exam_configs.examValue')?></label>
                                    <div class="div">
                                        <?=$this->Form->control('exam_configs.examValue', [ 
                                            'class'=>'form-control has-feedback-left',
                                            'label'=>false,
                                            'type'=>'text',
                                            'placeholder'=>'Ex: 180',
                                        ])?>
                                        <span class="fa fa-check form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div> -->
                                
                                <div class="col-md-10 col-sm-10  form-group has-feedback">
                                    <label><?=__('exam_desc')?></label>
                                    <div class="div">
                                        <?=$this->Form->control('exam_desc', [
                                            'class'=>'form-control has-feedback-left',
                                            'label'=>false,
                                            'type'=>'textarea',
                                            'ckeditor'=>'ckoptions',
                                            'ng-model'=>'exam_desc'
                                        ])?>
                                        <span class="fa fa-paragraph form-control-feedback left"aria-hidden="true"></span>
                                    </div>
                                </div>
                                
                                <div class="col-md-2 col-sm-2  form-group has-feedback">
                                    <label >
                                        <i class="fa fa-camera"></i> <?=__("add_change")?>
                                        <?=$this->Form->control("seo_image", [
                                            "class"=>"form-control hideIt", 'type'=>'file',
                                            "file-model"=>"files.exams", 
                                            "mg-model"=>"rec.exam.seo_image", 
                                            "id"=>"exam", 'label'=>false
                                        ])?>
                                    </label>
                                    <div class="double_images" style="height:120px;">
                                        <a href ng-click="
                                            filesInfo['seo_image'].tmp_name=null;
                                            rec.exam.seo_image=null;">
                                            <i class="fa fa-times"></i>
                                        </a>
                                        <img src="<?=$app_folder.'/img/exams_photos/thumb/'. (!empty($exam->seo_image)?$exam->seo_image:'image-placeholder.jpg')?>" class="img" style="height:120px;"> 
                                        <img ng-if="filesInfo['seo_image'].tmp_name" ng-src="{{filesInfo['seo_image'].tmp_name}}" 
                                            alt="" class="img" style="height:120px;">
                                    </div>
                                </div>
                                
                                <div class="col-md-12 col-sm-12  form-group has-feedback">
                                    <label><?=__('seo_keywords')?></label>
                                    <div class="div form-control has-feedback-left">
                                        <?=$this->element("tagInput", ["name"=>"seo_keywords"]);?>
                                        <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>
                                
                                <div class="col-md-12 col-sm-12  form-group has-feedback">
                                    <label><?=__('exam_tags')?></label>
                                    <div class="div form-control has-feedback-left">
                                        <?=$this->element("tags", ["name"=>"exam_tags", "tags"=>$exam->exam_tags]);?>
                                        <span class="fa fa-tags form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>
                                
                                
                                
                                
                                
                                <?php if($authUser['user_role'] == 'admin.root'){
                                    echo $this->element('root_zone');
                                }?>

                                <div class="clearfix"></div>

                                <div class="form-group ">
                                    <div class="col-md-6 col-sm-6  form-group has-feedback ">
                                        <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> <?=__('submit')?></button>
                                    </div>
                                </div>

                                <?=$this->Form->end()?>

                            </div>
                        </div>
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        <!-- RESULT ADD/EDIT -->
                        <div class="title_left">
                            <h3><?=__('add_edit_result')?></h3>
                        </div>
                        <div class="x_panel">
                            <div class="x_title">
                                <h2><i class="fa fa-trophy"></i> <?=__('results_according_to_score')?>
                                </h2>
                                <div><?=__('results_according_to_score_desc')?></div>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li class="icon2right"><a class="collapse-link"><i class="fa fa-eye"></i></a></li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>

                            <div class="x_content" >
                                
                                <div class="col-sm-12 col-md-12 ">
                                    <div class="row result_item" ng-repeat="resItem in rec['exam'].results">
                                        <div class="col-sm-2 col-md-2">
                                            <img ng-src="<?=$app_folder?>/img/results_photos/thumb/{{chkImage(resItem.result_photos)}}">
                                        </div>
                                        <div class="col-sm-10 col-md-10">
                                            <h3>{{resItem.result_name}} [{{resItem.result_min}}-{{resItem.result_max}}]</h3>
                                            <p>
                                                {{resItem.result_text}} 
                                                <a href ng-click="rec.result = resItem; toElm('scroll_tar');" class="actionBtn"><i class="fa fa-pencil"></i></a>
                                                <a href ng-click="doDelete('/admin/results/delete/'+resItem.id, 'get_exam');" class="actionBtn"><i class="fa fa-times"></i></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                                <?= $this->Form->create($exam, ['class'=>'form-label-left input_mask', 'id'=>'result_form', "novalidate"=>"novalidate", "enctype"=>"multipart/form-data"]) ?>
                                
                                
                                <div class="col-md-6 col-sm-6  form-group has-feedback" id="scroll_tar">
                                    <label><?=__('result_name')?></label>
                                    <div class="div">
                                        <?=$this->Form->control('result_name', [
                                            'class'=>'form-control has-feedback-left',
                                            'label'=>false,
                                            'type'=>'text',
                                            'ng-model'=>'rec.result.result_name'
                                        ])?>
                                        <span class="fa fa-header form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>
                                <?php if($exam->exam_calc_method == 1){?>
                                <div class="col-md-3 col-sm-3  form-group has-feedback">
                                    <label><?=__('result_min')?></label>
                                    <div class="div">
                                        <?=$this->Form->control('result_min', [
                                            'class'=>'form-control has-feedback-left',
                                            'label'=>false,
                                            'type'=>'text',
                                            'ng-model'=>'rec.result.result_min'
                                        ])?>
                                        <span class="fa fa-minus form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3  form-group has-feedback">
                                    <label><?=__('result_max')?></label>
                                    <div class="div">
                                        <?=$this->Form->control('result_max', [
                                            'class'=>'form-control has-feedback-left',
                                            'label'=>false,
                                            'type'=>'text',
                                            'ng-model'=>'rec.result.result_max'
                                        ])?>
                                        <span class="fa fa-plus form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>
                                <?php }?>
                                
                                <div class="col-md-12 col-sm-12  form-group has-feedback">
                                    <label><?=__('result_text')?></label>
                                    <div class="div">
                                        <?=$this->Form->control('result_text', [
                                            'class'=>'form-control has-feedback-left',
                                            'label'=>false,
                                            'type'=>'textarea',
                                            'ng-model'=>'rec.result.result_text',
                                            'ckeditor'=>'ckoptions_img'
                                        ])?>
                                        <span class="fa fa-paragraph form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>
                                
                                
                                <div class="col-md-12 col-sm-12  form-group has-feedback">
                                    <label >
                                        <i class="fa fa-camera"></i> <?=__("add_change")?>
                                        <?=$this->Form->control("result_photos", [
                                            "class"=>"form-control hideIt", 'type'=>'file',
                                            "file-model"=>"files.results", 
                                            "id"=>"result", 'label'=>false
                                        ])?>
                                    </label>
                                    <div>
                                        <span class="imgform" ng-if="rec.result.result_photos">
                                            <a href 
                                               ng-click="
                                                     rec.result.result_photos = null;
                                                     filesInfo['result_photos'].tmp_name=null;">
                                                <i class="fa fa-times"></i>
                                            </a>
                                            <img ng-src="<?=$app_folder?>/img/results_photos/thumb/{{rec.result.result_photos}}" 
                                                 style="height:80px;">
                                        </span>
                                        <img ng-if="filesInfo['result_photos'].tmp_name" ng-src="{{filesInfo['result_photos'].tmp_name}}" 
                                             style="height:80px;">
                                    </div>
                                </div>
                                
                                <div class="form-group ">
                                    <div class="col-md-6 col-sm-6  form-group has-feedback ">
                                        
                                        <div ng-if="rec.result.id>-1" >
                                            <button type="button"id="result_btn" 
                                                    ng-click="saveResult()" class="btn btn-info"> 
                                                <span><i class="fa fa-save"></i></span> <?=__('update_result')?></button>
                                            <button type="button" class="btn btn-info" 
                                                    ng-click="rec.result={id:-1, result_photos:''}"> 
                                                <span><i class="fa fa-times"></i></span> <?=__('reset')?></button>
                                        </div>
                                        
                                        <button type="button" ng-if="rec.result.id<0" 
                                                ng-click="saveResult()" class="btn btn-info" id="result_btn">
                                            <span><i class="fa fa-plus"></i></span> <?=__('add_result')?>
                                        </button>
                                    </div>
                                </div>
                                
                                <?=$this->Form->end()?>
                            </div>
                        </div>
                    </div>
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    <!-- QUESTIONS ADD / EDIT -->
                    <div class="col-md-12 col-sm-12">
                        <h3><?=__('add-edit_questions')?></h3>
                        <div class="x_panel">
                            <div class="x_title">
                            <h2><i class="fa fa-align-left"></i> <?=__('questions_list')?></small>
                                </h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li class="icon2right"><a class="collapse-link"><i class="fa fa-eye"></i></a></li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                                <div class="clearfix"></div>

                                <!-- start accordion -->
                                <div class="accordion" id="accordion" role="tablist" aria-multiselectable="false">
                                    <div class="panel" 
                                        ng-repeat="poll in rec['exam'].polls track by $index">
                                        
                                        <form id="poll_form_{{$index}}">
                                        
                                        <div href="#collapse_{{$index}}"
                                            class="panel-heading collapsed"
                                            role="button" 
                                            id="heading_{{$index}}"
                                            data-toggle="collapse" 
                                            data-target="#collapse_{{$index}}"
                                            aria-expanded="true" 
                                            aria-controls="collapse_{{$index}}"
                                            close-accordions>
                                            <h4 class="panel-title">{{'q#'+($index+1)+' '+poll.poll_title}} 
                                                <?php if($authUser['user_role'] == 'admin.root'){?>
                                                <span> 
                                                    <a href="" 
                                                        ng-click="doDelete('/admin/polls/delete/'+poll.id, 'get_exam')"><i class="fa fa-trash"></i>
                                                    </a>
                                                </span>
                                                <?php }?>
                                            </h4>
                                        </div>
                                        <div class="panel-collapse in collapse" 
                                            id="collapse_{{$index}}" 
                                            role="tabpanel"
                                            aria-labelledby="heading_{{$index}}">

                                            <div class="panel-body">
                                                <div class="col-12">
                                                    <h3 class="row col-12"><?=__("question")?># {{$index+1}}</h3>
                                                </div>
                                                
                                                
                                                
                                                
                                                <!-- POLL INFO -->
                                                <div class="row col">
                                                    <div class="col-sm-10">
                                                        <div class="">
                                                            <div class="col-md-6 col-sm-6  form-group has-feedback">
                                                                <label><?=__('poll_title')?></label>
                                                                <div class="div">
                                                                    <?=$this->Form->text('poll_title', [ 
                                                                        'ng-model'=>'rec["exam"].polls[$index].poll_title',
                                                                        'placeholder'=>__('add_new_poll'),
                                                                        'class'=>'form-control has-feedback-left', 'id'=>'poll-title', 'del-error'=>''
                                                                    ])?>
                                                                    <span
                                                                        class="fa fa-question-circle  form-control-feedback left"
                                                                        aria-hidden="true"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6  form-group has-feedback">
                                                                <label><?=__('poll_type')?></label>
                                                                <div class="div">
                                                                    <?=$this->Form->select('poll_type', $this->Do->get('types'), [
                                                                        'ng-model'=>'rec["exam"].polls[$index].poll_type', 
                                                                        'id'=>'poll-type', 
                                                                        'class'=>'form-control has-feedback-left', 'del-error'=>''
                                                                    ])?>
                                                                    <span 
                                                                        class="fa fa-wrench form-control-feedback left"
                                                                        aria-hidden="true"></span>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12 col-sm-12  form-group has-feedback">
                                                                <div class="div">
                                                                    <div ckeditor="ckoptions" ng-model='rec["exam"].polls[$index].poll_text'  class="form-control has-feedback-left"></div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4 col-sm-4  form-group has-feedback">
                                                                <label><?=__('poll_configs_value')?></label>
                                                                <!-- NOT RATING type-->
                                                                <div class="div" ng-if="rec['exam'].exam_calc_method != 2">
                                                                    <?=$this->Form->text('poll_configs.value', [
                                                                 'ng-model'=>'rec["exam"].polls[$index].poll_configs.value', 
                                                                'class'=>'form-control has-feedback-left', 'placeholder'=>__('poll_configs_value_ph')
                                                                    ])?>
                                                                    <span
                                                                        class="fa fa-cube form-control-feedback left"
                                                                        aria-hidden="true"></span>
                                                                </div>
                                                                <!-- RATING type-->
                                                                <div class="div" ng-if="rec['exam'].exam_calc_method == 2">
                                                                    <?=$this->Form->select('poll_configs.value', $this->Do->get('btwn'), [
                                                                        'ng-model'=>'rec["exam"].polls[$index].poll_configs.value', 
                                                                        'class'=>'form-control has-feedback-left', 'placeholder'=>__('poll_configs_value_ph')
                                                                    ])?>
                                                                    <span
                                                                        class="fa fa-cube form-control-feedback left"
                                                                        aria-hidden="true"></span>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4 col-sm-4  form-group has-feedback">
                                                                <label><?=__('poll_configs_time')?></label>
                                                                <div class="div">
                                                                    <?=$this->Form->text('poll_configs.time', [
                                                                 'ng-model'=>'rec["exam"].polls[$index].poll_configs.time', 
                                                                'class'=>'form-control has-feedback-left', 'placeholder'=>__('poll_configs_time_ph')
                                                                    ])?>
                                                                    <span
                                                                        class="fa fa-hourglass-2 form-control-feedback left"
                                                                        aria-hidden="true"></span>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4 col-sm-4  form-group has-feedback">
                                                                <label><?=__('poll_configs_isBigPhoto')?></label>
                                                                <div class="div">
                                                                    <?=$this->Form->control('poll_configs.isBigPhoto', [
                                                                 'ng-model'=>'rec["exam"].polls[$index].poll_configs.isBigPhoto', 'type'=>'select', 'options'=>$this->Do->get('bool'), 'label'=>false,
                                                                'class'=>'form-control has-feedback-left'
                                                                    ])?>
                                                                    <span
                                                                        class="fa fa-image form-control-feedback left"></span>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4 col-xs-6  form-group has-feedback" ng-if="rec['exam'].polls[$index].poll_type == 2">
                                                                <label><?=__('poll_configs_minAnswers')?></label>
                                                                <div class="div">
                                                                    <?=$this->Form->text('poll_configs.minAnswers', [
                                                                 'ng-model'=>'rec["exam"].polls[$index].poll_configs.minAnswers', 
                                                                'class'=>'form-control has-feedback-left', 'placeholder'=>__('poll_configs_minAnswers_ph')
                                                                    ])?>
                                                                    <span
                                                                        class="fa fa-list-ol form-control-feedback left"
                                                                        aria-hidden="true"></span>
                                                                </div>
                                                            </div>

                                                            <?php if($authUser['user_role'] == 'admin.root'){?>
                                                            <div class="col-md-4 col-xs-6 form-group has-feedback">
                                                                <label class="">
                                                                    <?=$this->Form->checkbox('stat_ispoll', [ 
                                                                        'ng-model'=>'rec["exam"].polls[$index].stat_ispoll',
                                                                        'ng-true-value'=>'1',
                                                                        'ng-false-value'=>'0',
                                                                        'type'=>'checkbox', 'id'=>'stat-ispoll'
                                                                    ])?> <span></span> <?=__('stat_ispoll')?>
                                                                </label>
                                                            </div>
                                                            <?php }?>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    <!-- POLL PHOTO -->
                                                    <div class="col-sm-2">
                                                        <label> 
                                                            <i class="fa fa-camera"></i> <?=__("add_change")?>
                                                            <input type="file" class="form-control hidden" name="poll_{{poll.id}}" 
                                                                file-model="files.polls" id="poll_{{poll.id}}"
                                                                ng-model="poll.seo_image" del-error>
                                                            <input type="hidden" id="seo-image" name="seo_image" >
                                                        </label>
                                                        <div class="imgform">
                                                            <img ng-src="{{filesInfo['poll_'+poll.id].tmp_name || app_folder+'/img/polls_photos/thumb/'+(poll.seo_image==null ? 'image-placeholder.jpg' : poll.seo_image) }}" 
                                                            alt="" class="img">
                                                            <span>
                                                                <a href ng-click="
                                                    deletedphotos.push('polls/'+poll.seo_image);           
                                                    poll.seo_image=null;
                                                    filesInfo['poll_'+poll.id]=null;">
                                                                    <i class="fa fa-times"></i>
                                                                </a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="clearfix"><hr></div>
                                                    
                                                    <!-- POLL'S OPTIONS -->
                                                    <div class="col-md-12 col-sm-12 ">
                                                        <div class="col-md-12 col-sm-12 ">
                                                            <h3><?=__("options")?></h3>
                                                        </div>
                                                        <div ng-repeat="option in poll.options track by $index" class="clearfix">
                                                            <form id="option_form_{{$index}}" class="col-md-12 col-sm-12 ">
                                                                <div class="{{rec['exam'].exam_calc_method == 2 ? 'col-6 col-sm-7 col-md-7' : poll.poll_type == 4 ? 'col-12 col-sm-12 col-md-5' : 'col-8 col-sm-9 col-md-9'}} form-group has-feedback" 
                                                                        title="<?=__('select_correct_value')?>">
                                                                    <?=$this->Form->text('option_text', [
                                                                         'ng-model'=>'option.option_text',
                                                                        'placeholder'=>__('add_new_option'),
                                                                        'class'=>'form-control has-feedback-left', 'id'=>'option-text', 'del-error'=>''
                                                                    ])?>
                                                                    
                                                                    <a href ng-if="rec['exam'].polls[$parent.$index].poll_type == 1" 
                                                                        ng-click="option.option_configs.isCorrect = option.option_configs.isCorrect==1 ? 0 : 1">
                                                                        <span tooltip
                                                                            title="<?=__('select_correct_option')?>"
                                                                            class="fa fa-dot-circle-o {{option.option_configs.isCorrect == 1 ? 'blueText' : ''}} form-control-feedback left">
                                                                        </span>
                                                                    </a>
                                                                    <a href ng-if="rec['exam'].polls[$parent.$index].poll_type == 2" 
                                                                        ng-click="option.option_configs.isCorrect = option.option_configs.isCorrect==1 ? 0 : 1">
                                                                        <span tooltip
                                                                            title="<?=__('select_correct_option')?>"
                                                                            class="fa fa-check {{option.option_configs.isCorrect == 1 ? 'greenText' : ''}} form-control-feedback left">
                                                                        </span>
                                                                    </a>
                                                                    <span ng-if="rec['exam'].polls[$parent.$index].poll_type == 3" tooltip
                                                                            title="<?=__('rating_poll')?>"
                                                                            class="fa fa-star form-control-feedback left goldText">
                                                                    </span>
                                                                    <a href ng-if="rec['exam'].polls[$parent.$index].poll_type == 4" 
                                                                        ng-click="option.option_configs.isCorrect = option.option_configs.isCorrect==1 ? 0 : 1">
                                                                        <span tooltip
                                                                            title="<?=__('select_correct_option')?>"
                                                                            class="fa fa-commenting-o {{option.option_configs.isCorrect == 1 ? 'greenText' : ''}} form-control-feedback left">
                                                                        </span>
                                                                    </a>
                                                                </div>
                                                                
                                                                <!-- OPTION'S RESULT VALUE -->
                                                                <div class="col-2 col-sm-2 col-md-2" ng-if="rec['exam'].exam_calc_method == 2">
                                                                    <select class="form-control has-feedback-left" 
                                                                            name="option_value"
                                                                            ng-model="option.option_value"
                                                                            placeholder="<?=__('poll_configs_value_ph')?>">
                                                                        <option value="{{itm.id}}" ng-repeat="itm in rec['exam'].results">
                                                                            {{itm.result_name}}
                                                                        </option>
                                                                    </select>
                                                                    <span class="fa fa-certificate form-control-feedback left"></span>
                                                                </div>
                                                                <!-- OPTION'S TEXT VALUE -->
                                                                <div class="col-12 col-sm-12 col-md-4" 
                                                                     ng-if="poll.poll_type == 4">
                                                                    <input class="form-control has-feedback-left" 
                                                                            name="option_value"
                                                                            ng-model="option.option_value"
                                                                            placeholder="<?=__('poll_configs_value_ph')?>">
                                                                    <span class="fa fa-certificate form-control-feedback left"></span>
                                                                </div>
                                                                
                                                                <div class="col-3 col-sm-3 col-md-3 ">
                                                                    <span>
                                                                        <label  tooltip title="<?=__('change_photo')?>">
                                                                            <div class="imgform">
                                                                                <img ng-src="{{filesInfo['option_'+option.id].tmp_name || app_folder+'/img/options_photos/thumb/'+ (!isPhoto(option.option_photo) ? 'image-placeholder.jpg' : option.option_photo) }}" 
                                                                            alt="" class="opt_img" style="width:50px;">
                                                                                <span>
                                                                                    <a href ng-click="
                                                                        deletedphotos.push('options/'+option.option_photo);
                                        option.option_photo=null; filesInfo['option_'+option.id]=null">
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
                                                rec['exam'].polls[$parent.$index].options[$index].id < 0 ? 
                                                rec['exam'].polls[$parent.$index].options.pop() :
                                                doDelete('/admin/options/delete/'+option.id, 'get_exam' )
                                                                                "
                                                                            title="<?=__('delete_option')?>">
                                                                            <i class="fa fa-trash"></i>
                                                                        </a>
                                                                    </span>
                                                                </div>
                                                            </form>
                                                        </div>

                                                        <div class="col-md-12 col-sm-12 ">
                                                            <button class="btn btn-info" id="poll_form_{{$index}}_cvr"
                                                                ng-click="savePollWithOptions(rec['exam'].polls[$index], 'poll_form_'+$index)" >
                                                                <span><i class="fa fa-save"></i></span> <?=__('save_poll_options')?>
                                                            </button>
                                                            <button ng-if="rec['exam'].polls[$index].id>-1" class="btn btn-default" type="button" tooltip
                                                                title="<?=__("add_new_option")?>"
                                                                ng-click="
                                                                rec['exam'].polls[$index].options.push( newEntity('option', {poll_id: rec['exam'].polls[$index].id, id: (rec['exam'].polls[$index].options.length+1)}) )" >
                                                                <i class="fa fa-plus"></i> <?=__('add_option')?>
                                                            </button>
                                                            <div class=" mb-5" ></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- end of accordion -->
                                <button class="btn btn-info" type="button"
                                    ng-click="
                                          filesInfo = {}; 
                                          rec['exam'].polls.push( newEntity('poll') );
                                          updt('heading_' + (rec['exam'].polls.length-1))">
                                    <i class="fa fa-plus"></i> <?=__('add_question')?>
                                </button>
                                <div class=" mb-3" ></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


<!-- 
            <div class="col-sm-3">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?=__('filters')?> <small><?=__('exams')?></small></h2>
                        <div class="clearfix"></div>
                        <div class="x_content">
                            <div class="clearfix"></div>
                            <div>
                                sidebar -- {{deletedphotos}}
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        
        </div>
    </div>
</div>

<script>
    
$( document ).ready(function() {
//    $('#testarea').trumbowyg({
//        $svgPath: false,
////        hideButtonTexts: true,
//        btns: [
////            ['viewHTML'],
//            ['undo', 'redo'], // Only supported in Blink browsers
//            ['formatting'],
//            ['strong', 'em', 'del'],
//            ['superscript', 'subscript'],
////            ['link'],
////            ['insertImage'],
//            ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
//            ['unorderedList', 'orderedList'],
//            ['horizontalRule'],
//            ['removeformat'],
//            ['fullscreen']
//        ]
//    });
//    
//    var fontAwesomeButtons = {
//        "trumbowyg-viewHTML-button":        "fa fa-code",
//        "trumbowyg-undo-button":            "fa fa-undo",
//        "trumbowyg-redo-button":            "fa fa-redo",
//        "trumbowyg-formatting-button":      "fa fa-paragraph",
//        "trumbowyg-strong-button":          "fa fa-bold",
//        "trumbowyg-em-button":              "fa fa-italic",
//        "trumbowyg-del-button":             "fa fa-strikethrough",
//        "trumbowyg-superscript-button":     "fa fa-superscript",
//        "trumbowyg-subscript-button":       "fa fa-subscript",
//        "trumbowyg-link-button":            "fa fa-link",
//        "trumbowyg-insertImage-button":     "fa fa-image",
//        "trumbowyg-justifyLeft-button":     "fa fa-align-left",
//        "trumbowyg-justifyCenter-button":   "fa fa-align-center",
//        "trumbowyg-justifyRight-button":    "fa fa-align-right",
//        "trumbowyg-justifyFull-button":     "fa fa-align-justify",
//        "trumbowyg-unorderedList-button":   "fa fa-list-ul",
//        "trumbowyg-orderedList-button":     "fa fa-list-ol",
//        "trumbowyg-horizontalRule-button":  "fa fa-minus",
//        "trumbowyg-removeformat-button":    "fa fa-eraser",
//        "trumbowyg-fullscreen-button":      "fa fa-expand-arrows-alt"
//      }

// Loop through each button, insert an <i> element with the correct class
//  $('.trumbowyg-button-pane button').each( function(i,el){
//    var btnClass = $(el).attr('class').split(' ')[0];
//    var faClass = fontAwesomeButtons[btnClass];
//    $(el).html('<i class="'+faClass+'"></i>');
//  })
    
    
    
    
}) 
// $('#accordion').on('show.bs.collapse', function () {
//     toggleIcon(this)
    // $('.collapse').collapse()
        // $('#accordion .panel-collapse').addClass("collapse")
        // $('#accordion .panel-collapse').removeClass("show")
    // $('#accordion .panel-collapse').addClass("collapsed")
    // $('#accordion .panel-collapse').removeClass("show")
// })
// // SHOW BUTTON:
// $("#accordion .panel-heading").click(function(e) {
//     $(".panel-collapse").collapse("show");
// });

// // HIDE BUTTON:
// $("#accordion .panel-heading").click(function(e) {
//    $(".panel-collapse").collapse("hide");
// });
</script>