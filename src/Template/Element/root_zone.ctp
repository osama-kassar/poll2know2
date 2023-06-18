<div class="col-md-12 col-sm-12 text-center">
    <b>ROOT ZONE</b>
</div>
<div class="col-md-6 col-sm-6  form-group has-feedback">
    <label><?=__('slug')?></label>
    <div class="div">
        <?=$this->Form->control('slug', [
            'class'=>'form-control has-feedback-left',
            'label'=>false,
            'type'=>'text'
        ])?>
        <span class="fa fa-header form-control-feedback left" aria-hidden="true"></span>
    </div>
</div>
<div class="col-md-2 col-sm-2  form-group has-feedback">
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
</div>
<div class="col-md-2 col-sm-2  form-group has-feedback">
    <label><?=__('stat_views')?></label>
    <div class="div">
        <?=$this->Form->control('stat_views', [
            'class'=>'form-control has-feedback-left',
            'label'=>false,
            'type'=>'text'
        ])?>
        <span class="fa fa-info form-control-feedback left" aria-hidden="true"></span>
    </div>
</div>
<div class="col-md-2 col-sm-2  form-group has-feedback">
    <label><?=__('stat_shares')?></label>
    <div class="div">
        <?=$this->Form->control('stat_shares', [
            'class'=>'form-control has-feedback-left',
            'label'=>false,
            'type'=>'text'
        ])?>
        <span class="fa fa-info form-control-feedback left" aria-hidden="true"></span>
    </div>
</div>
<div class="col-md-12 col-sm-12  form-group has-feedback">
    <label><?=__('seo_desc')?></label>
    <div class="div">
        <?=$this->Form->control('seo_desc', [
            'class'=>'form-control has-feedback-left',
            'label'=>false,
            'type'=>'textarea'
        ])?>
        <span class="fa fa-header form-control-feedback left" aria-hidden="true"></span>
    </div>
</div>
<div class="col-md-6 col-sm-6  form-group has-feedback">
    <label><?=__('slug')?></label>
    <div class="div">
        <?=$this->Form->control('user_id', [
            'class'=>'form-control has-feedback-left',
            'label'=>false,
            'type'=>'select',
            'options'=>$users
        ])?>
        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
    </div>
</div>
