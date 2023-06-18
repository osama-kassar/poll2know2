<?php 
    $from = $this->request->getQuery('from');
    $to = $this->request->getQuery('to');
?>

<div class="right_col" role="main" ng-init="
        doGet('/admin/polls/hits?from=<?=$from?>&to=<?=$to?>', 'list', 'polls');
    ">
    <div class="">

        <div class="page-title">
            <div class=" col-8  col-sm-8 col-md-8 side_div1">
                <h3><?=__('polls_list')?></h3>
            </div>
            <div class=" col-4 col-sm-4 col-md-4 side_div2" >
                    <?=$this->element('datePicker', ['from'=>$from, 'to'=>$to])?>
            </div>
        </div>

        <div class="clearfix"></div>
        
        <div class="row">
            <div class="col-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?=__('polls_list')?> 
                            <small>
                            <?=__('show').' '.__('from')?> 
                                {{ paging.start  }} <?=__('to')?> 
                                {{ paging.end }} <?=__('of')?> {{ paging.count }} </small> 
                        </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <!-- <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li> -->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <div class="dropdown-menu  <?= $currlang!='ar' ? 'dropdown-menu-right' : ''?>" aria-labelledby="dropdownMenuButton">
                                    <a href ng-click="multiHandle('/admin/polls/delete')" class="dropdown-item">
                                        <i class="fa fa-trash"></i> <?=__('delete_selected')?>
                                    </a>
                                    <a href ng-click="multiHandle('/admin/polls/enable/1')" class="dropdown-item">
                                        <i class="fa fa-check"></i> <?=__('enable_selected')?>
                                    </a>
                                    <a href ng-click="multiHandle('/admin/polls/enable/0')" class="dropdown-item">
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
                                            <?=$this->element('colActions', ['url'=>'polls/hits', 'col'=>'id'])?>
                                            <?=__('id')?> </th>

                                        <th class="column-title">
                                            <?=$this->element('colActions', ['url'=>'polls/hits', 'col'=>'poll_title'])?>
                                            <?=__('poll_title')?> </th>

                                        <th class="column-title">
                                            <?=$this->element('colActions', ['url'=>'polls/hits', 'col'=>'language_id'])?> 
                                            <?=__('language_id')?> </th>

                                        <th class="column-title">
                                            <?=$this->element('colActions', ['url'=>'polls/hits', 'col'=>'stat_views'])?> 
                                            <?=__('stat_views')?> </th>

                                        <th class="column-title">
                                            <?=$this->element('colActions', ['url'=>'polls/hits', 'col'=>'stat_shares'])?> 
                                            <?=__('stat_shares')?> </th>

                                        <th class="column-title">
                                            <?=$this->element('colActions', ['url'=>'polls/hits', 'col'=>'rec_state'])?> 
                                            <?=__('status')?> </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <tr class="pointer" ng-repeat="itm in list.polls">
                                        <td class="a-center ">
                                            <label class="mycheckbox chkb">
                                                <input type="checkbox"  ng-model="selected[itm.id]" ng-value="{{itm.id}}">
                                                <span></span>
                                            </label>
                                        </td>
                                        
                                        <td class=" ">{{ itm.id }}</td>
                                        <td class=" ">{{itm.poll_title}}</td>
                                        <td class=" ">{{ DtSetter( 'language_id', itm.language_id) }} </td>
                                        <td class=" ">{{ itm.stat_views }} </td>
                                        <td class=" ">{{ itm.stat_shares }} </td>
                                        <td class="a-right a-right ">{{ DtSetter( 'bool', itm.rec_state ) }} </td>
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