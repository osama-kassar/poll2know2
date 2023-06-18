<?php
$fields = ['id', 'user_id', 'competitor_id', 'exam_id', 'score_result', 'score_configs', 'score_photo', 'user_ip', 'user_email', 'user_name', 'hits_ids', 'stat_created', 'stat_views', 'stat_shares', 'rec_state'];
?>

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?=__('view_score')?></h3>
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
                                        <td><?= $this->Do->DtSetter($score->$field, $field) ?></td>
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


