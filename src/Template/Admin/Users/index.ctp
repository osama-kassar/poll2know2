
<div class="right_col" role="main" ng-init="
        doGet('/admin/users/index?from=<?=$from?>&to=<?=$to?>&k=<?=$k?>&col=<?=$col?>&method=<?=$method?>', 'list', 'users');
    ">
    <div class="">

        <div class="page-title">
            <div class=" col-8  col-sm-8 col-md-8 side_div1">
                <h3><?=__('users_list')?></h3>
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
                        <h2><?=__('users_list')?> 
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
                                    <a href ng-click="multiHandle('/admin/users/delete')" class="dropdown-item">
                                        <i class="fa fa-trash"></i> <?=__('delete_selected')?>
                                    </a>
                                    <a href ng-click="multiHandle('/admin/users/enable/1')" class="dropdown-item">
                                        <i class="fa fa-check"></i> <?=__('enable_selected')?>
                                    </a>
                                    <a href ng-click="multiHandle('/admin/users/enable/0')" class="dropdown-item">
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
                                            <?=$this->element('colActions', ['url'=>'users/index', 'col'=>'id'])?>
                                            <?=__('id')?> </th>

                                        <th class="column-title">
                                            <?=$this->element('colActions', ['url'=>'users/index', 'col'=>'user_fullname', 'search'=>'user_fullname'])?> 
                                            <?=__('user_fullname')?> </th>

                                        <th class="column-title"> <?=__('user_email')?> </th>

                                        <th class="column-title">
                                            <?=$this->element('colActions', ['url'=>'users/index', 'col'=>'user_role', 'filter'=>$this->Do->get('AdminRoles')])?> 
                                            <?=__('user_role')?> </th>

                                        <th class="column-title">
                                            <?=$this->element('colActions', ['url'=>'users/index', 'col'=>'stat_lastlogin'])?> 
                                            <?=__('stat_lastlogin')?> </th>

                                        <th class="column-title">
                                            <?=$this->element('colActions', ['url'=>'users/index', 'col'=>'stat_logins'])?> 
                                            <?=__('stat_logins')?> </th>

                                        <th class="column-title">
                                            <?=$this->element('colActions', ['url'=>'users/index', 'col'=>'rec_state', 'filter'=>$this->Do->get('bool')])?> 
                                            <?=__('status')?> </th>

                                        <th class="column-title no-link last"><span
                                                class="nobr"><?=__('action')?></span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <tr class="pointer" ng-repeat="itm in list.users">
                                        <td class="a-center ">
                                            <label class="mycheckbox chkb">
                                                <input type="checkbox"  ng-model="selected[itm.id]" ng-value="{{itm.id}}">
                                                <span></span>
                                            </label>
                                        </td>
                                        
                                        <td class=" ">{{ itm.id }}</td>
                                        <td class=" ">{{ itm.user_fullname }} </td>
                                        <td class=" ">{{ itm.user_email }} </td>
                                        <td class=" ">{{ itm.user_role }} </td>
                                        <td class=" ">{{ itm.stat_lastlogin }} </td>
                                        <td class=" ">{{ itm.stat_logins }} </td>
                                        <td class="a-right a-right ">{{ DtSetter( 'bool', itm.rec_state ) }} </td>
                                        <td class=" last">
                                            <a href="<?=$app_folder?>/admin/users/view/{{itm.id}}"><i class="fa fa-eye"></i> <?=__('view')?></a>
                                            <a href="<?=$app_folder?>/admin/users/edit/{{itm.id}}"><i class="fa fa-pencil"></i> <?=__('edit')?></a>
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


