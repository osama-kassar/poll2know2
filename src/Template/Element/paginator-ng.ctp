<?php 
    $path = strtolower( $this->request->getParam('controller') );
?>
<div class="paginator"> 
    <div  ng-if="paging.count > paging.perPage" class="pagination">
        <span ng-class="{active: paging.page<2}"> <a href="javascript:void(0);"
            ng-click="doGet('/admin/<?=$path?>?page=1&list=1', 'list', '<?=$path?>')">
            <i class="fa fa-angle-double-left"></i>
        </a> </span>
        
        <span ng-class="{active: paging.page<2}"> <a href="javascript:void(0);"
            ng-click="doGet('/admin/<?=$path?>?page='+(paging.page-1)+'&list=1', 'list', '<?=$path?>')">
            <i class="fa fa-chevron-left"></i>
        </a> </span> 

        <span ng-repeat="page in pager( paging.pageCount, paging.page ) track by $index" 
            ng-class="{active : page == paging.page*1}"> <a href="javascript:void(0);"
            ng-click="doGet('/admin/<?=$path?>?page='+(page)+'&list=1', 'list', '<?=$path?>')">
            <span>{{page}}</span>
        </a> </span> 
        
        <span ng-class="{active: paging.page >= paging.pageCount}" > <a href="javascript:void(0);"
            ng-click="doGet('/admin/<?=$path?>?page='+(paging.page+1)+'&list=1', 'list', '<?=$path?>')">
            <i class="fa fa-chevron-right"></i>
        </a> </span>
        
        <span ng-class="{active: paging.page >= paging.pageCount}" > <a href="javascript:void(0);"
            ng-click="doGet('/admin/<?=$path?>?page='+paging.pageCount+'&list=1', 'list', '<?=$path?>')">
            <i class="fa fa-angle-double-right"></i>
        </a> </span> 
    </div>
    <span class="paginator_info" ng-if="paging.count>0">

        <?=__('show').' '.__('from')?> 
            {{ paging.start  }} <?=__('to')?> 
            {{ paging.end }} <?=__('of')?> {{ paging.count }} 
            
    </span>
</div>