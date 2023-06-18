 
<?php
    $ctrl = strtolower($this->request->getParam('controller'));
    $from = $this->request->getQuery('from');
    $to = $this->request->getQuery('to');
?>
 <div style="min-width: 80px;">
<?php if(isset($col)){?>
<span>
    <a href class="btnIcon" ng-click="
        sort['<?=$col?>'] = sort['<?=$col?>'] == 'ASC' ? 'DESC' : 'ASC';
        doGet('/admin/<?=$url?>?from=<?=@$from?>&to=<?=@$to?>&direction='+sort['<?=$col?>']+'&col=<?=$col?>', 'list', '<?=$ctrl?>');" > 
            <i class="fa fa-{{sort['<?=$col?>']=='ASC' ? 'sort-amount-asc' : 'sort-amount-desc'}}"></i> 
    </a>
</span>
<?php }?>

<?php if(isset($search)){?>
<span  click-outside="
                isSearch=[];
                    ">
    <a href class="btnIcon" ng-click="
            isSearch['<?=$col?>'] == 'open' ? isSearch = [] :  isSearch = [] ; 
            isSearch['<?=$col?>'] = 'open';
        " > <i class="fa fa-search"></i> </a>

    <div class="input-on-fly {{isSearch['<?=$col?>'] == 'open' ? '' : 'hideIt'}}">
        <a href class="icn" ng-click="
                goTo('/admin/<?=$url?>?from=<?=@$from?>&to=<?=@$to?>&k='+filter.kword+'&col=<?=$col?>&method=like');
            " > <i class="fa fa-thumb-tack"></i> </a>
        <?=$this->Form->control($col, [
            'empty'=>true,
            'label'=>false,
            'type'=>'text',
            'name'=>false,
            'ng-model'=>'filter.kword',
            'ng-change' => "doGet('/admin/".$url."?from=".@$from."&to=".@$to."&k='+filter.kword+'&col=".$search."&method=like' , 'list', '".$ctrl."');"
        ])?>
    </div>
</span>
<?php }?>

<?php if(isset($filter)){?>
<span  click-outside="
                isSearch=[];
                    ">
    <a href class="btnIcon" ng-click="
            isSearch['<?=$col?>'] == 'open' ? isSearch = [] :  isSearch = [] ; 
            isSearch['<?=$col?>'] = 'open';
        " > <i class="fa fa-filter"></i> </a>

    <div class="input-on-fly {{isSearch['<?=$col?>'] == 'open' ? '' : 'hideIt'}}">
        <a href class="icn" ng-click="
                goTo('/admin/<?=$url?>?from=<?=@$from?>&to=<?=@$to?>&k='+filter.kword+'&col=<?=$col?>&method=filter');
            " > <i class="fa fa-thumb-tack"></i> </a>
        <?=$this->Form->control($col, [
            'label'=>false,
            'empty'=>true,
            'type'=>'select',
            'ng-model'=>'filter.kword',
            'options'=>$filter,
            'ng-change' => "doGet('/admin/".$url."?from=".@$from."&to=".@$to."&k='+filter.kword+'&col=".$col."&method=filter' , 'list', '".$ctrl."');"
        ])?>
        
    </div>
</span>
<?php }?>
 </div>