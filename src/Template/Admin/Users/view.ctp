<?php
$fields = ['id', 'user_fullname', 'email', 'password', 'user_role', 'user_token', 'stat_lastlogin', 'stat_created', 'stat_logins', 'stat_ip', 'rec_state'];
?>

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?=__('view_user')?></h3>
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
                                        <td><?= $this->Do->DtSetter($user->$field, $field) ?></td>
                                    </tr>
                                <?php endforeach?>
                                </table>
                            </div>
                            
<!--
                            <h4><?=__('competitors')?></h4>
                            <ul class="related">
                                <?php 
                                    foreach($user->competitors as $competitor){
                                ?>
                                    <li> 
                                        <h5><?=$competitor->competitor_name?></h5>
                                        <ul>
                                            <li>
                                                <b><?=__('competitor_gender')?>: </b>
                                                <?=$this->Do->get('gender')[$competitor->competitor_gender]?>
                                            </li>    
                                            <li>
                                                <b><?=__('competitor_score')?>: </b>
                                                <?=$competitor->competitor_score?>%
                                            </li>    
                                            <li>
                                                <b><?=__('time')?>: </b>
                                                <?=__('start').' '.$this->Do->DtSetter($competitor->stat_created, "stat_created").' - '.__('end').' '.$this->Do->DtSetter($competitor->stat_updated, "stat_updated")?>
                                            </li>
                                            <li>
                                                <b><?=__('competitor_info')?>: </b>
                                                <?=$competitor->competitor_info?>
                                            </li> 
                                            <li>
                                                <b><?=__('stat_ip')?>: </b>
                                                <?=$competitor->stat_ip?>
                                            </li>    
                                        </ul>
                                    </li>
                                <?php }?>
                            </ul>
-->
                        </div>
                    </div>
                </div>
            </div>



            
        </div>
    </div>
</div>


