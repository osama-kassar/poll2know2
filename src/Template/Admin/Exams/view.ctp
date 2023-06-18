<?php
$fields = ['id', 'slug', 'language_id', 'user_id', 'category_id', 'exam_title', 'exam_desc', 'exam_period', 'seo_keywords', 'seo_desc', 'seo_image', 'stat_created', 'stat_publish_at', 'stat_views', 'stat_shares', 'stat_rate', 'rec_state'];
?>

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?=__('view_exam')?></h3>
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
                                        <td><?= $this->Do->DtSetter($exam->$field, $field) ?></td>
                                    </tr>
                                <?php endforeach?>
                                </table>
                            </div>
                            
                            <hr>
                            <h4><?=__('results_according_to_score')?></h4>
                            <ul class="related">
                                <?php foreach($exam->results as $reulst){?>
                                <li>
                                    <h5>
                                        <b><?=__('result_name')?></b>
                                        <?=$reulst->result_name?>
                                    </h5>
                                    <div>
                                        <b><?=__('exam_id')?></b>
                                        <?=$reulst->exam_id?>
                                    </div>
                                    <div>
                                        <b><?=__('result_min')?>/<?=__('result_max')?></b>
                                        [<?=$reulst->result_min?> / <?=$reulst->result_max?>]
                                    </div>
                                    <div>
                                        <b><?=__('result_text')?></b>
                                        <?=$reulst->result_text ?>
                                    </div>
                                    <div>
                                        <b><?=__('seo_image')?></b>
                                        <?=$this->Do->DtSetter( $reulst->result_photos , "result_photos" )?>
                                    </div>
                                    <div>
                                        <b><?=__('stat_created')?></b>
                                        <?=$this->Do->DtSetter( $reulst->stat_created, "stat_created" )?>
                                    </div>
                                    <div>
                                        <b><?=__('rec_state')?></b>
                                        <?=$this->Do->DtSetter( $reulst->rec_state, "rec_state" )?>
                                    </div>
                                </li>
                                <?php }?>
                            </ul>
                            <hr>                            
                            
                            <h4><?=__('polls')?></h4>
                            <ul class="related">
                                <?php foreach($exam->polls as $poll){?>
                                <li>
                                    <h5><?=$poll->poll_title?></h5>
                                    <small class="greyText"><?=$poll->poll_text?></small>
                                    <ul>
                                    <?php foreach($poll->options as $option){
                                        $cnf = json_decode($option->option_configs);
                                        $resInd = array_search($option->option_value, array_column($exam->results, "id"));
                                        ?>
                                        <li> 
                                            <?= $cnf->isCorrect == 1 ? '&#10004;' :  ''?> 
                                            &nbsp;<?=$option->option_text?>&nbsp;
                                            <small class="badge badge-<?=$colors[$resInd]?>">
                                                [ <?=$resInd===false ? '' : $exam->results[$resInd]->result_name?> ]
                                            </small> 
                                        </li>
                                    <?php }?>
                                    </ul>
                                </li>
                                <?php }?>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="col-md-12 col-sm-12 text-cetner">
                        <?php 
                        foreach($this->Do->get('langs') as $k=>$lng){
                            if($exam->language_id != $k){
                                echo $this->Form->postLink(' '.__('duplicate').' '.__($lng), 
                                    ["action"=>"duplicate", $exam->id, "l"=>$lng], 
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


