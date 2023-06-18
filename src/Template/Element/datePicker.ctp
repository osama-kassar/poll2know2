
<?php
$ctrl = $this->request->getParam('controller'); 
$actn = $this->request->getParam('action'); 
    // echo $this->Form->text($name, [
    //     "label"=>__($name), 
    //     "ng-model"=>$ng, 
    //     "class"=>"form-control has-feedback-left", 
    //     "id"=>"datePicker_".$name, "date-picker"=>""]);
?>
<?php if(!empty($from)){?>
    <a class="btn btn-danger" href="<?=$app_folder?>/<?=$currlang?>/admin/<?=strtolower($ctrl).'/'.$actn?>"><i class="fa fa-times"></i></a>
<?php }?>
<button date-picker="" class="btn btn-info"><?=$from.' '.$to?> <i class="fa fa-calendar"></i> </button> 
<script>
    // $('#datePicker_<?=@$name?>').daterangepicker({
    //     singleDatePicker: true,      
    //     autoUpdateInput: false,
    //     showDropdowns: true
    // }, function(start, end, label) {
    //     console.log('start, end, label', start, end, label)
    // });
</script>
