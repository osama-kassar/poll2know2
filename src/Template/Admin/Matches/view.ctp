<?php
$fields = ['id', 'exam_id', 'match_score1', 'match_score2', 'stat_created', 'stat_views', 'stat_shares', 'rec_state'];
?>

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?=__('view_competition')?></h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="<?=__('searchfor')?>">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button"><?=__('go')?></button>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-9 col-sm-9  ">

                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="x_panel">
                            
                            <div class="view_page">
                                <table class="table table-striped table-hover">

                                <?php foreach($fields as $field):?>
                                    <tr>
                                        <th><?= __($field) ?></th>
                                        <td><?= $this->Do->DtSetter($match->$field, $field) ?></td>
                                    </tr>
                                <?php endforeach?>
                                </table>
                            </div>
                            
                            <h4><?=__('competitors')?></h4>
                            <ul class="related">
                                <?php 
                                    foreach([$match->score1, $match->score2] as $score){
                                ?>
                                    <li> 
                                        <h5><?=$score->user_name?></h5>
                                        <ul>
                                            <li>
                                                <b><?=__('email')?>: </b>
                                                <?=$score->user_email?>
                                            </li>   
                                            <li>
                                                <b><?=__('user_ip')?>: </b>
                                                <?=$this->Do->DtSetter($score->user_ip, "user_ip")?>
                                            </li> 
                                            <li>
                                                <b><?=__('stat_created')?>: </b>
                                                <?=$this->Do->DtSetter($score->stat_created, "stat_created")?>
                                            </li>   
                                        </ul>
                                    </li>
                                <?php }?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-sm-3">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?=__('filters')?> <small><?=__('categories')?></small></h2>


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


