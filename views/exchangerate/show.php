<div class='container is-max-desktop'>
<div class='box' id='exfrom'>
    <form class="field" name=Currency method="POST" action="">
        <label class='label'>
            Choose the currencys you want to exchange:
        </label>
        <select name='firstcurr'>
            <option value="">
                Choose...
            </option>
            <?php
                foreach($currencies as $currencie){
                    echo "<option value='$currencie'> ".$currencie. "</option>";
                }
            ?>
        </select>
        -
        <select  name='secondcurr'>
            <option value="">
                Choose...
            </option>
            <?php
                foreach($currencies as $currencie){
                    echo "<option value='$currencie'> ".$currencie. "</option>";
                }
            ?>
        </select>

        <br>
        <br>

        <label class='label'>
            Choose the date:
        </label>

        <input type="date" id="date" name="date" value="2021-01-01" >

        <br>
        <br>

        <label class='label'>
            If you want to see the whole month check the box:
        </label>
        <input class='checkbox' type='checkbox' id='month' name='month'>
        <br>
        <br>
        <div class= 'buttons'>
            <input class="button is-primary" type="submit" value="Submit" id="exchangesubmit">
        </div>
    </form>

</div>

<?php 

    if(isset($_POST['firstcurr']) && isset($_POST['secondcurr']) && isset($_POST['date']) && $_POST['firstcurr']!='' 
        && $_POST['secondcurr']!='' && ($_POST['date']>=$firstDate && $_POST['date']<=$lastDate)){

        if(isset($_POST['month'])){
            $date = $_POST['date'];
            $firstcurr = $_POST['firstcurr'];
            $secondcurr = $_POST['secondcurr'];

            $datas = $this->exchangeMonth($firstcurr, $secondcurr, $date);
            //print_r($datas);
            ?>

            <table class="table" id="exchange" name="exchange">
                <tr>
                    <th>Currency</th>
                    <th>Date</th>
                    <th>Value</th>
                </tr>
                <?php
                $dates=array();
                $values=array();
                    foreach($datas as $data){
                        foreach($data as $key =>$value)
                            echo "<tr><td>".$_POST['firstcurr']." - ".$_POST['secondcurr']."</td><td>".$key."<td/><td>".$value."</td></tr>";
                        array_push($dates, $key);
                        array_push($values, $value);

                        
                    }
                ?>

            </table>
        <?php
        }
        else{
            $date = $_POST['date'];
            $firstcurr = $_POST['firstcurr'];
            $secondcurr = $_POST['secondcurr'];  

            $data = $this->exchange($firstcurr, $secondcurr, $date);
            if($data === 'empty'){
                echo "<strong class='box'>No rate was recorded on this day!</strong>";
            }
            else{
            echo "<div class='box'>
                    <p>
                        In ".$_POST['date']." <strong>1</strong> ".$_POST['firstcurr']." was ".round($data,9)." ".$_POST['secondcurr']."
                    </p>
                </div>";
            }
        }        
    }else{
        echo "<strong class='box'>Please give correct input!</strong>";
    }

    if(isset($_POST['month'])){
        echo '<!--innent   ^ql a chart div-->
        <div id="chartDiv" class="content" style="padding:0">
        
        <div class="loaddata loadcontent">
                <!--CHART HELYE-->
                <br>
                <?php
                
                ?>
        
               
                <div id="container_all" class=""></div>
        </div>
        
        
        </div>';
    }
?>







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
                        text: 'Exchange rate'
                },
                xAxis: {
                        style: {
                                fontWeight: 'bold',
                                fontSize: '10px'
                        },
                        categories: [<?php  echo '"'.implode('","',$dates).'"'?>]

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
                                data: [<?php echo implode(',',$values)?>],
                                stack: '',
                                type: 'spline'
                        }

                ]
        });
</script>

</div>