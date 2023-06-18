<?php 
    $from = $this->request->getQuery('from');
    $to = $this->request->getQuery('to');
?>
<div class="right_col" role="main" ng-init="
        doGet('/admin/comments/index?from=<?=$from?>&to=<?=$to?>&page=1', 'list', 'comments');
    ">
    <div class="">

        <div class="page-title">
            <div class=" col-12  col-sm-6 col-md-6 side_div1">
                <h3><?=__('comments_list')?></h3>
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
                        <h2><?=__('comments_list')?> 
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
                                    <a href ng-click="multiHandle('/admin/comments/delete')" class="dropdown-item">
                                        <i class="fa fa-trash"></i> <?=__('delete_selected')?>
                                    </a>
                                    <a href ng-click="multiHandle('/admin/comments/enable/1')" class="dropdown-item">
                                        <i class="fa fa-check"></i> <?=__('enable_selected')?>
                                    </a>
                                    <a href ng-click="multiHandle('/admin/comments/enable/0')" class="dropdown-item">
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
                                            <?=$this->element('colActions', ['url'=>'comments/index', 'col'=>'id', 'search'=>'stat_ip'])?>
                                            <?=__('id')?> </th>

                                        <th class="column-title">
                                            <?=$this->element('colActions', ['url'=>'comments/index', 'col'=>'comment_target_slug', 'search'=>'comment_target_slug'])?> 
                                            <?=__('comment_target')?> </th>

                                        <th class="column-title">
                                            <?=$this->element('colActions', ['url'=>'comments/index', 'col'=>'comment_text', 'search'=>'comment_text'])?> 
                                            <?=__('comment_text')?> </th>

                                        <th class="column-title">
                                            <?=$this->element('colActions', ['url'=>'comments/index', 'col'=>'comment_useremail'])?> 
                                            <?=__('comment_useremail')?> </th>

                                        <th class="column-title">
                                            <?=$this->element('colActions', ['url'=>'comments/index', 'col'=>'stat_created'])?> 
                                            <?=__('stat_created')?> </th>

                                        <th class="column-title">
                                            <?=$this->element('colActions', ['url'=>'comments/index', 'col'=>'rec_state', 'filter'=>$this->Do->get('bool')])?> 
                                            <?=__('status')?> </th>

                                        <th class="column-title no-link last"><span
                                                class="nobr"><?=__('action')?></span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <tr class="pointer" ng-repeat="itm in list.comments">
                                    <td class="a-center ">
                                            <label class="mycheckbox chkb">
                                                <input type="checkbox"  ng-model="selected[itm.id]" ng-value="{{itm.id}}">
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>{{itm.id}} 
                                            {{ DtSetter('stat_ip', itm.stat_ip) }}
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);" data-toggle="tooltip" title="{{itm.comment_target_id}}, {{itm.comment_target_slug}}" >[{{itm.comment_target}}]</a>
                                        </td>
                                        <td>
                                            {{itm.user_id}}, 
                                            {{itm.comment_username}} 
                                            <a href="javascript:void(0);" data-toggle="tooltip" title="{{itm.comment_text}}" ><i class="fa fa-comment"></i></a>
                                        </td>
                                        <td>{{itm.comment_useremail}} </td>
                                        <td>{{DtSetter('stat_created', itm.stat_created)}} </td>
                                        <td class="a-right a-right ">{{ DtSetter('rec_state', itm.rec_state) }}</td>
                                        
                                        <td class=" last">
                                            <a href="<?=$app_folder?>/admin/comments/view/{{itm.id}}"><i class="fa fa-eye"></i> <?=__('view')?></a>
                                            <!-- <a href="<?=$app_folder?>/admin/comments/edit/{{itm.id}}"><i class="fa fa-pencil"></i> <?=__('edit')?></a> -->
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









