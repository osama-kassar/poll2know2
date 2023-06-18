<div id="tagInputDiv" ng-init="tags = '<?=empty($tags) ? '' : $tags?>'.split(',')">
    <div class="bootstrap-tagsinput">
        <span ng-repeat="tag in tags track by $index">
            <a href ng-click="remove_tag('#tags_<?=$name?>', $index)">{{tag}} <i class="fa fa-times"></i></a>
        </span>
        <input type="text" 
           ng-model="taginput"
           ng-change="searchTags(taginput);"
           id="inputter">
    </div>
    <div class="search_tag" ng-if="searchRes.length>0" id="tagsList">
        <div ng-repeat="itm in searchRes">
            <a href ng-click="add_tag( '#tags_<?=$name?>', itm.tag )"><i class="fa fa-plus"></i> {{itm.tag}}</a>
        </div>
    </div>
</div>
<?php
    $conf = [
        "class"=>"form-control has-feedback-left", 
        'type'=>'hidden',
        "id"=>"tags_".$name
    ];
    echo $this->Form->control($name, $conf);
?>

<script>
//var inc = 0;
//$("#tagInputDiv").keydown(function(e){
//    if($("#tagsList a").length>0){
//        if(e.which == 38 || e.which == 40){//up
//            $("#tagsList a")[inc].focus();
//            inc++;
//            if(inc>=($("#tagsList a").length)){inc=0}
//        }
//    }
//    $("#inputter").focus();
//})
</script>