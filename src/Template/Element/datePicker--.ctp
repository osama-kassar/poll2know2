
<?php
     echo $this->Form->text($name, [
         "label"=>__($name), 
         "class"=>"form-control has-feedback-left", 
         "id"=>"datePicker_".$name, "date-picker"=>""]);
?>
<script>
    $('#datePicker_<?=$name?>').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true
    }, function(start, end, label) {
        
    });
</script>