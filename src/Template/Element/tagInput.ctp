
<?php
    $conf = [
        "label"=>empty($lbl) ? false : __($name), 
        "data-role"=>"tagsinput", 
        "type"=>"text",
        "id"=>"tagInput_".$name
    ];
    !empty($ng) ? $conf["ng-model"] = $ng : "";
    echo $this->Form->control($name, $conf);
?>
<script>
    (function(){
        var target = $("#tagInput_<?=$name?>").tagsinput("input");
//        $(".bootstrap-tagsinput").addClass("form-control");
    })
</script>