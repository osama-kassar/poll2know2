<?php 
    $from = $this->request->getQuery('from');
    $to = $this->request->getQuery('to');
?>
<div class="right_col" role="main" ng-init="
        doGet('/admin/matches/index?from=<?=$from?>&to=<?=$to?>&page=1', 'list', 'matches');
    ">
    <div class="">

        <div class="page-title">
            <div class=" col-12  col-sm-6 col-md-6 side_div1">
                <h3><?=__('matches_list')?></h3>
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
                        <h2><?=__('matches_list')?> 
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
                                    <a href ng-click="multiHandle('/admin/matches/delete')" class="dropdown-item">
                                        <i class="fa fa-trash"></i> <?=__('delete_selected')?>
                                    </a>
                                    <a href ng-click="multiHandle('/admin/matches/enable/1')" class="dropdown-item">
                                        <i class="fa fa-check"></i> <?=__('enable_selected')?>
                                    </a>
                                    <a href ng-click="multiHandle('/admin/matches/enable/0')" class="dropdown-item">
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
                                            <?=$this->element('colActions', ['url'=>'matches/index', 'col'=>'id', 'search'=>'stat_ip'])?>
                                            <?=__('id')?> </th>

                                        <th class="column-title">
                                            <?=$this->element('colActions', ['url'=>'matches/index', 'col'=>'exam_title', 'search'=>'exam_title'])?> 
                                            <?=__('exam_title')?> </th>

                                        <th class="column-title">
                                            <?=$this->element('colActions', ['url'=>'matches/index', 'col'=>'match_score1'])?> 
                                            <?=__('match_score1')?> </th>

                                        <th class="column-title">
                                            <?=$this->element('colActions', ['url'=>'matches/index', 'col'=>'match_score2'])?> 
                                            <?=__('match_score2')?> </th>

                                        <th class="column-title">
                                            <?=$this->element('colActions', ['url'=>'matches/index', 'col'=>'stat_created'])?> 
                                            <?=__('stat_created')?> </th>

                                        <th class="column-title">
                                            <?=$this->element('colActions', ['url'=>'matches/index', 'col'=>'rec_state', 'filter'=>$this->Do->get('bool')])?> 
                                            <?=__('status')?> </th>

                                        <th class="column-title no-link last"><span
                                                class="nobr"><?=__('action')?></span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <tr class="pointer" ng-repeat="itm in list.matches">
                                    <td class="a-center ">
                                            <label class="mycheckbox chkb">
                                                <input type="checkbox"  ng-model="selected[itm.id]" ng-value="{{itm.id}}">
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>{{itm.id}}, 
                                            <a href="{{ipUrl+'/'+itm.stat_ip}}" target="_ip">
                                                {{itm.stat_ip}}
                                            </a>
                                        </td>
                                        <td>
                                            {{itm.exam.exam_title}}
                                        </td>
                                        <td>
                                            <a ng-if="itm.score1 != null" href="<?=$app_folder?>/matches/view/{{itm.id}}"
                                                target="_new">{{itm.score1.user_name}}</a>,
                                            <a ng-if="itm.score1 != null" href="{{ipUrl+'/'+itm.score1.user_ip}}" target="_ip">
                                                {{itm.score1.user_ip}}
                                            </a>
                                        </td>
                                        <td>
                                            <a ng-if="itm.score2 != null" href="<?=$app_folder?>/matches/view/{{itm.id}}"
                                                target="_new">{{itm.score2.user_name}}</a>,
                                            <a ng-if="itm.score2 != null" href="{{ipUrl+'/'+itm.score2.user_ip}}" target="_ip">
                                                {{itm.score2.user_ip}}
                                            </a>
                                        </td>
                                        <td>{{DtSetter('stat_created', itm.stat_created)}} </td>
                                        <td class="a-right a-right ">{{ DtSetter('rec_state', itm.rec_state) }}</td>
                                        
                                        <td class=" last">
                                            <a href="<?=$app_folder?>/admin/matches/view/{{itm.id}}"><i class="fa fa-eye"></i> <?=__('view')?></a>
                                            <!-- <a href="<?=$app_folder?>/admin/matches/edit/{{itm.id}}"><i class="fa fa-pencil"></i> <?=__('edit')?></a> -->
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
