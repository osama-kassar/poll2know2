<!--<div class="pagination justify-content-between ">-->
    <label class="col-form-label col-auto">
        <span class="showing_total_record">
            <?=__('pages').' '.$this->Paginator->params()['page'].'/'.$this->Paginator->params()['pageCount']?>
        </span>
    </label>
    
    <div class=" col-auto">
        <ol class="loader-page" style="direction: ltr;">
            
            <?php $this->Paginator->setTemplates([
    'prevActive' => '<li class="loader-page-item"><a href="{{url}}">'.__('prev').'</a></li> ',
    'number' => '<li class="loader-page-item"><a href="{{url}}">{{text}}</a></li>',
    'nextActive' => ' <li class="loader-page-item"> <a href="{{url}}">'.__('next').'</a> </li> ',
    'current' => '<li class="loader-page-item active"> <a href="javascript:void(0);">{{text}}</a></li>',
    'nextDisabled' => ' <li class="loader-page-item"> <a href="javascript:void(0);">'.__('next').'</a> </li> ',
    'prevDisabled' => ' <li class="loader-page-item">  <a href="javascript:void(0);">'.__('prev').'</a> </li> ',
            ]);?>
<?= $this->Paginator->prev('') ?>
<?= $this->Paginator->numbers() ?>
<?= $this->Paginator->next('') ?>

        </ol>
    </div>
    
<!--</div>-->
