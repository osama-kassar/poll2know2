<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?=__('add_exam')?></h3>
            </div>

            <div class="title_right">
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

                                <!-- <p>Add class <code>bulk_action</code> to table for bulk actions options on row select</p> -->
                                <?= $this->Form->create($exam, ['class'=>'form-label-left input_mask', "enctype"=>"multipart/form-data", "novalidate"=>"novalidate"]) ?>

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
                                <!-- <div class="col-md-6 col-sm-6  form-group has-feedback">
                                    <label><?=__('exam_period')?></label>
                                    <div class="div">
                                        <?=$this->Form->control('exam_period', [
                                            'type'=>'text', 'class'=>'form-control has-feedback-left', 'type'=>'text', 'label'=>false
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

                                <div class="col-md-10 col-sm-10  form-group has-feedback">
                                    <label><?=__('exam_desc')?></label>
                                    <div class="div">
                                        <?=$this->Form->control('exam_desc', [
                                        'type'=>'textarea', 'class'=>'form-control has-feedback-left', 'label'=>false
                                    ])?>
                                        <span class="fa fa-paragraph form-control-feedback left"
                                            aria-hidden="true"></span>
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
                                    <div class="double_images" style="height:120px">
                                        <a href ng-click="
                                            filesInfo['seo_image'].tmp_name=null;
                                            rec.exam.seo_image=null;">
                                            <i class="fa fa-times"></i>
                                        </a>
                                        <img src="<?=$app_folder.'/img/exams_photos/thumb/'. (!empty($exam->seo_image)?$exam->seo_image:'image-placeholder.jpg')?>" class="img" style="height:120px;"> 
                                        <img ng-if="filesInfo['seo_image'].tmp_name" src="{{filesInfo['seo_image'].tmp_name}}" 
                                            alt="" class="img" style="height:120px;">
                                    </div>
                                </div>

                                
                                <div class="col-md-12 col-sm-12  form-group has-feedback">
                                    <label><?=__('seo_keywords')?></label>
                                    <div class="div form-control has-feedback-left" >
                                        <?=$this->element("tagInput", ["name"=>"seo_keywords"]);?>
                                        <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>
                                
                                <div class="col-md-12 col-sm-12  form-group has-feedback">
                                    <label><?=__('exam_tags')?></label>
                                    <div class="div form-control has-feedback-left">
                                        <?=$this->element("tags", ["name"=>"exam_tags", "ng"=>"exam"]);?>
                                        <span class="fa fa-tags form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>

                                <div class="clearfix"></div>

                                <div class="form-group ">
                                    <div class="col-md-12 col-sm-6  form-group has-feedback ">
                                        <!-- <button type="button" class="btn btn-primary">Cancel</button>
                                    <button class="btn btn-primary" type="reset">Reset</button> -->
                                        <button type="submit" class="btn btn-info">Submit</button>
                                    </div>
                                </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- <div class="col-sm-3">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?=__('filters')?> <small><?=__('exams')?></small></h2>


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