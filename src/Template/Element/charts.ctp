<style>
.google-visualization-tooltip { 
    font-family: "Jannat" !important;
    width: 200px;
    overflow: hidden;
    text-overflow: ellipsis;
    padding: 0 !important;
    margin: 0 !important;
    line-height: 20px !important;
}
.google-visualization-tooltip span{
    font-family: "Jannat" !important;
    text-overflow: ellipsis !important;
}
.chart{
    
  display: flex;
  flex-flow: row wrap;
  justify-content: center;
  align-items: center;
  text-align: center;
}
</style>

<script>
    var chartsColors = ["#eba556", "#7c81e5", "#87e089", "#7bb3eb", "#7a6f8d", "#ce4472", "#4c7494", "#b085b6", "#6c4c8c","#eba556", "#7c81e5", "#87e089", "#7bb3eb", "#7a6f8d", "#ce4472", "#4c7494", "#b085b6", "#6c4c8c"];
</script>
<!--
{{chartsObj}}
<div class="chart" ng-repeat="chartObj in chartsObj">
    <div google-chart chart="chartObj" class="chart"></div>
</div>
-->
    <div google-chart chart="chartsObj['<?=$ind?>'*1]" class="chart" id="<?=$ind?>"></div>

