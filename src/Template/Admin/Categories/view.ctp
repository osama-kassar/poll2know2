<?php
$fields = ['id','language_id','slug','parent_id','category_name','category_params','category_priority','rec_state'];
?>

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?=__('view_category')?></h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">

                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="x_panel">
                            
                            <div class="view_page">
                                <table class="table table-striped table-hover">

                                <?php foreach($fields as $field):?>
                                    <tr>
                                        <th><?= __($field) ?></th>
                                        <td><?= $this->Do->DtSetter( $rec->$field, $field) ?></td>
                                    </tr>
                                <?php endforeach?>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


