<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?=__('categories_list')?></h3>
            </div>
        </div>

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?=__('categories_list')?> <small><?=__('show').' '. count($categories)  .' / '.$this->Paginator->params()['count']?></small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                    <a href ng-click="multiHandle('/admin/categories/delete')" class="dropdown-item">
                                        <i class="fa fa-trash"></i> <?=__('delete_selected')?>
                                    </a>
                                    <a href ng-click="multiHandle('/admin/categories/enable/1')" class="dropdown-item">
                                        <i class="fa fa-check"></i> <?=__('enable_selected')?>
                                    </a>
                                    <a href ng-click="multiHandle('/admin/categories/enable/0')" class="dropdown-item">
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
                                        <th class="column-title"><?=__('id').', '.__('slug')?> </th>
                                        <th class="column-title"><?=__('language_id')?> </th>
                                        <th class="column-title"><?=__('parent_id')?> </th>
                                        <th class="column-title"><?=__('category_name')?> </th>
                                        <th class="column-title"><?=__('status')?> </th>
                                        <th class="column-title no-link last"><span
                                                class="nobr"><?=__('action')?></span>
                                        </th>
                                        <th class="bulk-actions" colspan="7">
                                            <a class="antoo"><?=__('bulk_action')?> <i
                                                    class="fa fa-chevron-down"></i></a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $inc=0; 
                                        foreach($categories as $itm){
                                    ?>
                                    <tr class="pointer">
                                        <td class="a-center ">
                                            <div class="icheckbox_flat-green">
                                                <?=$this->Form->checkbox("selections", ["class"=>"flat", "name"=>"table_records", "ng-value"=>$itm->id])?>
                                            </div>
                                        </td>
                                        <td class=" "><?=$itm->id.', '.$itm->slug?> </td>
                                        <td class=" "><?=$this->Do->DtSetter( $itm->language_id, "language_id" )?> </td>
                                        <td class=" "><?=$itm->parent_id?> </td>
                                        <td class=" "><?=$itm->category_name?> </td>
                                        <td class="a-right a-right "><?=$this->Do->DtSetter( $itm->rec_state, "rec_state")?></td>
                                        <td class=" last">
                                            <?=$this->Html->link('<i class="fa fa-eye"></i> '.__('view'), [
                                                'controller'=>$this->request->getParam('controller'), 'action'=>'view', $itm->id
                                            ],['escape'=>false])?> 
                                            <?=$this->Html->link('<i class="fa fa-pencil"></i> '.__('edit'), [
                                                'controller'=>$this->request->getParam('controller'), 'action'=>'edit', $itm->id
                                                ],['escape'=>false])?>
                                            <?=$this->Form->postLink('<i class="fa fa-times"></i> '.__('delete'), [
                                                'controller'=>$this->request->getParam('controller'), 'action'=>'delete', $itm->id
                                            ], ['confirm' => __('delete_record').' #'.$itm->id, 'escape'=>false])?>

                                        </td>
                                    </tr>
                                    <?php 
                                            $inc++; 
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

        </div>
    </div>
</div>