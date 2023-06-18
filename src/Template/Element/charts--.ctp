<div id="chart" style="min-height: 350px;width: 100%;"></div>

<script>
    var colors = ["#eba556", "#7c81e5", "#87e089", "#7bb3eb", "#7a6f8d", "#ce4472", "#4c7494", "#b085b6", "#6c4c8c","#eba556", "#7c81e5", "#87e089", "#7bb3eb", "#7a6f8d", "#ce4472", "#4c7494", "#b085b6", "#6c4c8c"]
    var dt = JSON.parse( '<?=json_encode($dt)?>' );
    
    console.log("dt", dt);
    
    /*
    console.log(dt)
    var type = '<?=$type?>';
    var chartDt = [];
    if ( type == "donut" || type == "pie" ) {
        for ( var i in dt.options ) {
            chartDt.push( {

                    values: [ dt.poll_type == 3 ? dt.options[ i ].stat_totalrate : dt.options[ i ].stat_hits ],
                    text: dt.options[ i ].option_text,
                    "background-color": colors[i]
                } )
                //            chartDt.data.push(dt.poll_type == 3 ? dt.options[i].stat_totalrate : (dt.options[i].stat_hits == 0 ? 0.01 : dt.options[i].stat_hits))
                //            
                //            chartDt.names.push(dt.options[i].option_text )

        }
    }
    
        var locale = {
            'rtl' : true,
        }
        zingchart.i18n.ar = locale;
    
    var Config = {
        gui : {
          contextMenu : {
              empty : true
          }
        },
        type: "ring3d",
        "3d-aspect": {
            depth: 10,
            xAngle: 60,
            true3d: false
          },
        plot: {
            borderColor: "#fff",
            borderWidth: 0,
            valueBox: {
                placement: 'out',
                text: '<?=__('result')?>\t\n(%npv%)-(%v'+(dt.poll_type == 3 ? '/5 ★)' : ')'),
                fontFamily: "Jannat",
//                padding: "26",
                color:"#000",
                backgroundColor:"rgba(255,255,255,0.7)"
            },
            tooltip: {
                fontSize: '18',
                fontFamily: "Jannat",
                padding: "5 20",
                text: '%t',
            },
            animation: {
                effect: 2,
                method: 5,
                speed: 900,
                sequence: 1,
                delay: 3000
            }
        },
        noData:{
          text:"Currently there is no data in the chart",
          backgroundColor: "#20b2db",
          fontSize:18,
          textAlpha:.9,
          alpha:.6,
          bold:true
        },
        plotarea: {
            margin: "20"
        },
          legend:{
            "header":{
              "text":"<?=__('poll_items')?>"
            },
            "footer":{
              "text":"<?=__('total_hits')?> "+dt.stat_hits
            },
            "max-items":3,
            "overflow":"page",
          },
        series: chartDt,
    };

    $( function () {
        zingchart.render( {
            id: 'chart',
            data: Config,
            width:"100%",
            height:"100%"
        } );
    } )

*/





/*

    // APEXCHARTS
    var chartDt = {data:[], names:[], vals:[]};
    
    if(type == "donut" || type == "pie"){
        for(var i in dt.options){
            chartDt.data.push(dt.poll_type == 3 ? dt.options[i].stat_totalrate : (dt.options[i].stat_hits == 0 ? 0.01 : dt.options[i].stat_hits))
            
            chartDt.names.push(dt.options[i].option_text )
            
        }
    }
    
    var options = {
          series: chartDt.data,
          chart: {
          type: "donut",
        },
        tooltip: {
            custom: function({ series, seriesIndex, dataPointIndex, w }) {
              return (
                '<div class="arrow_box">' +
                "<span>" +
                w.globals.labels[seriesIndex] +
                ": " +
                series[seriesIndex] +(dt.poll_type == 3 ? '<?=__('stars')?> ★' : '<?=__('hits')?>') +
                "</span>" +
                "</div>"
              );
            }
          },
        plotOptions: {
            pie: {
              donut: {
                labels: {
                  show: true,
                  name: {
                      show: true,
                      formatter: function (val) {
                          return val
                      }
                  },
                  value: {
                      show: true,
                      formatter: function (val) {
                        return (dt.poll_type == 3 ? '<?=__('stars')?> ★' : '<?=__('hits')?> ' )+( (val == 0.01) ? 0 : val )
                      }
                  }
                }
              }
            }
        },
        labels: chartDt.names,
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
    };
    console.log(options)
    //var chart = new ApexCharts(document.querySelector("#chart"), options);
    
    //chart.render();
    
    
    
    
    
    
    
    
    
    
    
    
    // CHARTIST 
    var chartDt = [];
    var chartLbls = [];
    
    if(type == "pie"){
        for(var i in dt.options){
            chartDt.push({
                "value": dt.options[i].stat_hits,
                "meta": dt.options[i].option_text + "-"+
                    (dt.poll_type == 3 ? dt.options[i].stat_totalrate+ '★' : Math.floor(dt.options[i].stat_hits / dt.stat_hits * 100)+ '%') 
            })
            chartLbls.push(dt.options[i].option_text)
        }
    }
    
    var chart = new Chartist.Pie( '.ct-chart', {
        labels: chartLbls,
        series: chartDt
    }, {
        donut: true,
        donutWidth: 60,
        donutSolid: false,
        startAngle: 270,
        showLabel: false,
        plugins: [
            Chartist.plugins.tooltip()
        ]
    });
    chart.on( 'draw', function ( data ) {
        if ( data.type === 'slice' ) {
            var pathLength = data.element._node.getTotalLength();
            data.element.attr( {
                'stroke-dasharray': pathLength + 'px ' + pathLength + 'px'
            } );
            var animationDefinition = {
                'stroke-dashoffset': {
                    id: 'anim' + data.index,
                    dur: 1000,
                    from: -pathLength + 'px',
                    to: '0px',
                    easing: Chartist.Svg.Easing.easeOutQuint,
                    fill: 'freeze'
                }
            };
            if ( data.index !== 0 ) {
                animationDefinition[ 'stroke-dashoffset' ].begin = 'anim' + ( data.index - 1 ) + '.end';
            }
            data.element.attr( {
                'stroke-dashoffset': -pathLength + 'px'
            } );
            data.element.animate( animationDefinition, false );
        }
    } );
    
*/
</script>