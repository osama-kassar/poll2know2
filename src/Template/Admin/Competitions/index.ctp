<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?=__('competitions_list')?></h3>
            </div>
            
            <div class="title_right">
                <div class="col-md-5 col-sm-5 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="<?=__('searchfor')?>">
                        <span class="input-group-btn">
                            <button class="bttn btn-default" type="button"><?=__('go')?></button>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-9 col-sm-9  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?=__('competitions_list')?> <small><?=__('show').' '. count($competitions)  .' / '.$this->Paginator->params()['count']?></small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                    <a href ng-click="multiHandle('/admin/competitions/delete')" class="dropdown-item">
                                        <i class="fa fa-trash"></i> <?=__('delete_selected')?>
                                    </a>
                                    <a href ng-click="multiHandle('/admin/competitions/enable/1')" class="dropdown-item">
                                        <i class="fa fa-check"></i> <?=__('enable_selected')?>
                                    </a>
                                    <a href ng-click="multiHandle('/admin/competitions/enable/0')" class="dropdown-item">
                                        <i class="fa fa-times"></i> <?=__('disable_selected')?>
                                    </a>
                                </div>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">

                        <!-- <p>Add class <code>bulk_action</code> to table for bulk actions options on row select</p> -->

                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                    <tr class="headings">
                                        <th>
                                            <input type="checkbox" id="check-all" class="flat">
                                        </th>
                                        <th class="column-title"><?=__('id')?> </th>
                                        <th class="column-title"><?=__('exam_id')?> </th>
                                        <th class="column-title"><?=__('competition_title')?> </th>
                                        <th class="column-title"><?=__('stat_views')?> </th>
                                        <th class="column-title"><?=__('stat_shares')?> </th>
                                        <th class="column-title"><?=__('stat_created')?> </th>
                                        <th class="column-title"><?=__('status')?> </th>
                                        <th class="column-title no-link last">
                                            <span class="nobr"><?=__('action')?></span>
                                        </th>
                                        <th class="bulk-actions" colspan="8">
                                            <a class="antoo"><?=__('bulk_action')?> <i class="fa fa-chevron-down"></i></a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        foreach($competitions as $i=>$itm){
                                    ?>
                                    <tr class="pointer">
                                        <td class="a-center ">
                                            <div class="icheckbox_flat-green">
                                                <?=$this->Form->checkbox("selections", ["class"=>"flat", "name"=>"table_records", "ng-value"=>$itm->id])?>
                                            </div>
                                        </td>
                                        <td><?=$itm->id?> 
                                            <?=$this->Html->link('<i class="fa fa-external-link"></i>', 
                                                ["prefix"=>false, "controller"=>"Competitions", "action"=>"view", $itm->id], 
                                                ["escape"=>false, "target"=>"_new"])?>
                                        </td>
                                        <td><?=$itm->exam_id?> </td>
                                        <td><?=$itm->competition_title?> 
                                            <a href="javascript:void(0);" data-toggle="tooltip" title="<?=implode(", ",array_column($itm->competitors, "competitor_name"))?>" ><i class="fa fa-users"></i></a>
                                        </td>
                                        <td><?=$itm->stat_views?> </td>
                                        <td><?=$itm->stat_shares?> </td>
                                        <td><?=$this->Do->DtSetter($itm->stat_created, "stat_created")?> </td>
                                        <td class="a-right a-right "><?=$itm->rec_state?></td>
                                        <td class=" last">
                                            <?=$this->Html->link('<i class="fa fa-eye"></i> '.__('view'), [
                                                'controller'=>$this->request->getParam('controller'), 'action'=>'view', $itm->id
                                            ],['escape'=>false])?> 
<!--
                                            <?=$this->Html->link('<i class="fa fa-pencil"></i> '.__('edit'), [
                                                'controller'=>$this->request->getParam('controller'), 'action'=>'edit', $itm->id
                                                ],['escape'=>false])?>
                                            <?=$this->Form->postLink('<i class="fa fa-times"></i> '.__('delete'), [
                                                'controller'=>$this->request->getParam('controller'), 'action'=>'delete', $itm->id
                                            ], ['confirm' => __('delete_record').' #'.$itm->id, 'escape'=>false])?>

-->
                                        </td>
                                    </tr>
                                    <?php 
                                        }
                                    ?>
                                </tbody>
                            </table>
                            
                            <div class="paginator">
                                <ul class="pagination">
                                    <?php echo $this->Paginator->numbers() ?>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <div class="col-sm-3">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?=__('filters')?> <small><?=__('competitions')?></small></h2>


                        <div class="clearfix"></div>
                        <div class="x_content">

                        <div class="clearfix"></div>
                        <div> 
                            sidebar
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>