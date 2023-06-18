<?php 
    $from = $this->request->getQuery('from');
    $to = $this->request->getQuery('to');
    $k = $this->request->getQuery('k');
    $col = $this->request->getQuery('col');
    $method = $this->request->getQuery('method');
?>

<div class="right_col" role="main" ng-init="
        doGet('/admin/scores/index?from=<?=$from?>&to=<?=$to?>&k=<?=$k?>&col=<?=$col?>&method=<?=$method?>', 'list', 'scores');
    ">
    <div class="">

        <div class="page-title">
            <div class=" col-12  col-sm-6 col-md-6 side_div1">
                <h3><?=__('scores_list')?></h3>
            </div>
            <div class=" col-12 col-sm-6 col-md-6 side_div2" >
                    <?=$this->element('datePicker', ['from'=>$from, 'to'=>$to])?>
            </div>
        </div>

        <div class="clearfix"></div>
        
        <div class="row">
            <div class="col-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?=__('scores_list')?> 
                            <span>
                            <?=__('show').' '.__('from')?> 
                                {{ paging.start  }} <?=__('to')?> 
                                {{ paging.end }} <?=__('of')?> {{ paging.count }} </span> 
                        </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <!-- <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li> -->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <div class="dropdown-menu  <?= $currlang!='ar' ? 'dropdown-menu-right' : ''?>" aria-labelledby="dropdownMenuButton">
                                    <a href ng-click="multiHandle('/admin/scores/delete')" class="dropdown-item">
                                        <i class="fa fa-trash"></i> <?=__('delete_selected')?>
                                    </a>
                                    <a href ng-click="multiHandle('/admin/scores/enable/1')" class="dropdown-item">
                                        <i class="fa fa-check"></i> <?=__('enable_selected')?>
                                    </a>
                                    <a href ng-click="multiHandle('/admin/scores/enable/0')" class="dropdown-item">
                                        <i class="fa fa-times"></i> <?=__('disable_selected')?>
                                    </a>
                                </div>
                            </li>
                            <!-- <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li> -->
                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                    <tr class="headings">
                                        <th>
                                            <label class="mycheckbox">
                                                <input type="checkbox" ng-click="chkAll('.chkb', !selectAll)" ng-model="selectAll">
                                                <span></span>
                                            </label>
                                        </th>
                                        <th class="column-title">
                                            <?=$this->element('colActions', ['url'=>'scores/index', 'col'=>'id', 'search'=>'user_ip'])?>
                                            <?=__('id')?> </th>

                                        <th class="column-title">
                                            <?=$this->element('colActions', ['url'=>'scores/index', 'col'=>'user_name', 'search'=>'user_name'])?> 
                                            <?=__('user_name')?> </th>

                                        <th class="column-title">
                                            <?=$this->element('colActions', ['url'=>'scores/index', 'col'=>'exam_title', 'search'=>'exam_title'])?> 
                                            <?=__('exam_title')?> </th>

                                        <th class="column-title">
                                            <?=$this->element('colActions', ['url'=>'scores/index', 'col'=>'score_result'])?> 
                                            <?=__('score_result')?> </th>

                                        <th class="column-title">
                                            <?=$this->element('colActions', ['url'=>'scores/index', 'col'=>'stat_views'])?> 
                                            <?=__('stat_views')?> </th>

                                        <th class="column-title">
                                            <?=$this->element('colActions', ['url'=>'scores/index', 'col'=>'stat_created'])?> 
                                            <?=__('stat_shares')?> </th>

                                        <th class="column-title">
                                            <?=$this->element('colActions', ['url'=>'scores/index', 'col'=>'rec_state', 'filter'=>$this->Do->get('bool')])?> 
                                            <?=__('status')?> </th>

                                        <th class="column-title no-link last"><span
                                                class="nobr"><?=__('action')?></span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <tr class="pointer" ng-repeat="itm in list.scores">
                                        <td class="a-center ">
                                            <label class="mycheckbox chkb">
                                                <input type="checkbox"  ng-model="selected[itm.id]" ng-value="{{itm.id}}">
                                                <span></span>
                                            </label>
                                        </td>
                                        
                                        <td class=" ">
                                            {{ itm.id }}
                                            <a href="{{ipUrl+'/'+itm.user_ip}}" target="_ip">
                                                {{itm.user_ip}}
                                            </a>
                                            <a href="<?=$app_folder?>/<?=$currlang?>/admin/scores/view/{{itm.id}}" target="_new">
                                                <i class="fa fa-external-link"></i>
                                            </a>
                                        </td>
                                        <td class=" ">{{ itm.user_name }} </td>
                                        <td class=" ">{{ itm.exam.exam_title }} </td>
                                        <td class=" ">{{ itm.score_result }} </td>
                                        <td class=" ">{{ itm.stat_views }} </td>
                                        <td class=" ">{{ itm.stat_created }} </td>
                                        <td class="a-right a-right ">{{ DtSetter( 'bool', itm.rec_state ) }} </td>
                                        <td class=" last">
                                            <a href="<?=$app_folder?>/admin/scores/view/{{itm.id}}"><i class="fa fa-eye"></i> <?=__('view')?></a>
                                            <!-- <a href="<?=$app_folder?>/admin/scores/edit/{{itm.id}}"><i class="fa fa-pencil"></i> <?=__('edit')?></a> -->
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                                            
                            <?php echo $this->element('paginator-ng')?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
