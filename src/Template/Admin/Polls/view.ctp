<?php
$fields = ['id', 'slug', 'language_id', 'user_id', 'category_id', 'exam_id', 'poll_title', 'poll_text', 'poll_type', 'poll_priority', 'poll_configs', 'poll_tags', 'seo_keywords', 'seo_desc', 'seo_image', 'stat_hits', 'stat_created', 'stat_publish_at', 'stat_views', 'stat_shares', 'rec_state'];
?>

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?=__('view_poll')?></h3>
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
                                        <td><?= $this->Do->DtSetter($poll->$field, $field) ?></td>
                                    </tr>
                                <?php endforeach?>
                                </table>
                            </div>
                            
                            <h4><?=__('options')?></h4>
                            <ul class="related">
                                <?php foreach($poll->options as $option){
                                    ?>
                                    <li><?=$option->option_text?></li>
                                <?php }?>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="col-md-12 col-sm-12 text-cetner">
                        <?php 
                        foreach($this->Do->get('langs') as $k=>$lng){
                            if($poll->language_id != $k){
                                echo $this->Form->postLink(' '.__('duplicate').' '.__($lng), 
                                    ["action"=>"duplicate", $poll->id, "l"=>$lng], 
                                    ["class"=>"btn btn-danger fa fa-files-o", "confirm"=>__("duplicate?")]);
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>



            
        </div>
    </div>
</div>


