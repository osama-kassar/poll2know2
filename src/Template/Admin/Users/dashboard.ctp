
<?php

   $from = !isset($_GET['from']) ? date('Y-m-d' ,strtotime('first day of this month')) : $_GET['from'];
   $to = !isset($_GET['to']) ? date('Y-m-d', strtotime("+1 day")) : $_GET['to'];
   ?>


<div class="right_col" role="main" ng-init="
   getStatistics(false, false, '<?=$from?>', '<?=$to?>');
   getNotifications(); 
">
   <div class="row dashboard_div" >
      <div class="col-12">
         <h1>
            <?=__('general_stat')?>
         </h1>
      </div>
      <div class="col-sm-12 text-center">
         <h2>
            <?=__('date')?> 
            <?=$this->element('datePicker', ['from'=>$from, 'to'=>$to])?>
         </h2>
         <hr>
      </div>
      
      <?php // NUMBERS   ?>
      <div class="tile_count">
         <div class=" col-md-2 col-6  tile_stats_count">
            <span class="count_top"><i class="fa fa-graduation-cap"></i> <?=__('total_exams')?></span>
            <div class="count">{{statistics.numbers.total_active_exams}}/<small class="grayText">{{statistics.numbers.total_inactive_exams}}</small></div>
            <span class="count_bottom"><?=__('active')?>/<?=__('inactive')?></span>
         </div>

         <div class=" col-md-2 col-6  tile_stats_count">
            <span class="count_top"><i class="fa fa-bars"></i> <?=__('exams_type')?></span>
            <div class="count">
              {{statistics.numbers.total_prcntg_exams}}/{{statistics.numbers.total_count_exams}}
            </div>
            <span class="count_bottom"><?=__('total_prcntg_exams')?>/<?=__('total_count_exams')?></span>
         </div>

         <div class=" col-md-2 col-6  tile_stats_count">
            <span class="count_top"><i class="fa fa-smile-o"></i> <?=__('games')?></span>
            <div class="count">
              {{statistics.numbers.total_game_exams}}
            </div>
            <span class="count_bottom"><?=__('total_game_exams')?></span>
         </div>

         <div class=" col-md-2 col-6  tile_stats_count">
            <span class="count_top"><i class="fa fa-question-circle"></i> <?=__('total_polls')?></span>
            <div class="count">{{statistics.numbers.total_active_polls}}/<small class="grayText">{{statistics.numbers.total_inactive_polls}}</small></div>
            <span class="count_bottom"><?=__('active')?>/<?=__('inactive')?></span>
         </div>

         <div class=" col-md-2 col-6  tile_stats_count">
            <span class="count_top"><i class="fa fa-trophy"></i> <?=__('scores')?></span>
            <div class="count">{{statistics.numbers.total_scores}}</div>
            <span class="count_bottom"><?=__('total_scores')?></span>
         </div>

         <div class=" col-md-2 col-6  tile_stats_count">
            <span class="count_top"><i class="fa fa-trophy"></i> <?=__('scores')?></span>
            <div class="count">{{statistics.numbers.total_scores_per_date}}</div>
            <span class="count_bottom"><?=__('total_scores_per_date')?></span>
         </div>

      </div>
   </div>

   <?php // Scores per day ?>
   <div class="row" id="scores_per_dayChart" style="width: 100%;">
      <div class="col-md-12 col-sm-12 ">
         <div class="dashboard_graph">

            <div class="x_title row">
               <div class="col-8">
                  <h3><?=__('scores_per_day_title')?></h3>
               </div>
               <div class="col-4 expand-icon">
                  <a href ng-click="toImage('#scores_per_dayChart')">
                     <i class="fa fa-image"></i>
                  </a>
                  <!-- &nbsp; &nbsp; <a href ng-click="isExpanded.examChart = !isExpanded.examChart">
                     <i class="fa fa-{{isExpanded.examChart ? 'compress' : 'expand'}}"></i>
                  </a> -->
               </div>
            </div>
            <!-- <div class="{{isExpanded.examChart ? 'col-md-6 col-sm-6' : 'col-md-12 col-sm-12'}} "> -->
            <div class="col-md-12 col-sm-12">
               <div ng-if="statistics.scores_per_day.items.length>0"> 
                  <canvas id="scores_per_day_chart" set-chart='bar' dt='scores_per_day' islegend="true" unit="<?=__('exam')?>"></canvas> 
               </div>
            </div>
            <div class="clearfix"></div>
         </div>
      </div>
   </div>

   <?php // EXAMS ?>
   <div class="row" id="examChart" style="width: 100%;">
      <div class="col-md-12 col-sm-12 ">
         <div class="dashboard_graph">

            <div class="x_title row">
               <div class="col-8">
                  <h3><?=__('exams_chart_title')?></h3>
               </div>
               <div class="col-4 expand-icon">
                  <a href ng-click="toImage('#examChart')">
                     <i class="fa fa-image"></i>
                  </a>
                  <!-- &nbsp; &nbsp; <a href ng-click="isExpanded.examChart = !isExpanded.examChart">
                     <i class="fa fa-{{isExpanded.examChart ? 'compress' : 'expand'}}"></i>
                  </a> -->
               </div>
            </div>
            <!-- <div class="{{isExpanded.examChart ? 'col-md-6 col-sm-6' : 'col-md-12 col-sm-12'}} "> -->
            <div class="col-md-12 col-sm-12">
               <div ng-if="statistics.exams.items.length>0"> 
                  <canvas id="exams_chart" set-chart='pie' dt='exams' islegend="true" unit="<?=__('exam')?>"></canvas> 
               </div>
            </div>
            <!-- <div class="{{!isExpanded.examChart ? 'col-md-6 col-sm-6' : 'col-md-12 col-sm-12'}}  bg-white" 
               style="{{ !isExpanded.examChart ? 'max-height: 250px; overflow: auto;' : '' }}"> -->
            <div class="col-md-12 col-sm-12">
               <div class="x_title">
                  <h2><?=__('exams_total_results')?></h2>
                  <div class="clearfix"></div>
               </div>
               <div ng-repeat="exam in statistics.exams.items track by $index">
                  <p class="progress_item_title"><span>{{exam.exam_title}}</span>/ <span>{{addSeperator( exam.total_values )}} <?=__('exam')?></span></p>
                  <div class="progress progress_sm" style="width: 90%;">
                    <div class="progress-bar" set-percentage="{{[statistics.exams.items, exam.total_values, $index]}}"></div>
                  </div>
               </div>
            </div>
            <div class="clearfix"></div>
         </div>
      </div>
   </div>
   
</div>