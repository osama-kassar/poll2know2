<?php
$fields = ['id', 'user_id', 'parent_id', 'comment_target', 'comment_target_id', 'comment_target_slug', 'comment_text', 'comment_username', 'comment_useremail', 'comment_useremoji', 'comment_info', 'stat_ip', 'stat_created', 'rec_state'];
?>

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?=__('view_comment')?></h3>
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
                                        <td><?= $this->Do->DtSetter($comment->$field, $field) ?></td>
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


