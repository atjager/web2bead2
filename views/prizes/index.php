<?php 

$prizeArray = array();
$dateArray = array();
foreach($prizes as $prize){
    $prizeArray[] = $prize->value;
    $dateArray[] = date("d/m/Y", strtotime($prize->year."W".$prize->week."7"));
}


//echo join(',',$prizeArray);


?>
 <div id="chartDiv" class="content" style="padding:0">
        
        <div class="loaddata loadcontent">
                <!--CHART HELYE-->
                <br>
                <?php
                
                ?>
        
               
                <div id="container_all" class=""></div>
        </div>
        
        
        </div>

<script type="text/javascript">
        $(document).ready(function() {

                $('.ldng').fadeOut(500);

        });
</script>


<script type="text/javascript">
        Highcharts.chart('container_all', {

                //colors: ['#6AC8C8','#43CBAF', '#3DC7D1', '#4897C6','#4897C6','#5A9DB4'],


                theme: Highcharts.theme,
                chart: {
                        zoomType: 'x',
                        type: 'column',
                        backgroundColor: {
                                linearGradient: [0, 100, 400, 400],
                                stops: [
                                        [0, 'rgb(20, 20, 20)'],
                                        [1, 'rgb(40, 40, 40)']
                                ]
                        }
                },
                title: {
                        style: {
                                color: 'white'

                        },
                        text: 'Prizes'
                },
                xAxis: {
                        style: {
                                fontWeight: 'bold',
                                fontSize: '10px'
                        },
                        categories: [<?php  echo '"'.implode('","',$dateArray).'"'?>]

                },
                yAxis: {
                        min: 0,
                        title: {
                                text: '',
                                color: '#fff'
                        },
                        stackLabels: {
                                enabled: true,
                                style: {
                                        fontWeight: 'bold',
                                        color: ( //theme
                                                Highcharts.defaultOptions.title.style &&
                                                Highcharts.defaultOptions.title.style.color
                                        ) || 'gray',
                                        color: '#FFFFFF',
                                        textOutline: 'none'
                                }
                        }
                },
                legend: {
                        align: 'right',
x: -30,
                        verticalAlign: 'top',
                        y: 25,
                        floating: true,
                        backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || 'white',
                        borderColor: '#CCC',
                        borderWidth: 1,
                        shadow: false
                },
                tooltip: {
                        headerFormat: '<b>{point.x}</b><br/>',
                        pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
                },
                plotOptions: {
                        column: {
                                stacking: 'normal',
                                dataLabels: {
                                        enabled: true,
                                        shape: 'callout',
                                        style: {
                                                color: '#FFFFFF',
                                                textOutline: 'none'
                                        }
                                }
                        }
                },
                series: [{
                                name: 'Values',
                                color: 'blue',
                                borderColor: 'black',
                                borderWidth: 0,
                                shadow: false,
                                data: [<?php echo implode(',',$prizeArray)?>],
                                stack: '',
                                type: 'spline'
                        }

                ]
        });
</script>