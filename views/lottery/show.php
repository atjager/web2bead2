<div class='container is-max-desktop'>
<div class='box' id='exfrom'>
    <form class="field" name="lotteryForm" method="POST" action=''>
        <label class='label'>
            Give a number between 1 and 45:
        </label>
        
        <input type="text" name="lotteryNumber">

        <br>

        <br>

        <label class='label'>
            Choose:
        </label>   
            <input class="button is-primary" type="submit" name="buttonPost" value="Add the number">
            <input class="button is-primary" type="submit" name="buttonPut" value="Replace last number">
            <input class="button is-primary" type="submit" name="buttonGet" value="Show last number">
            <input class="button is-primary" type="submit" name="buttonDelete" value="Delete last number">
        </div>
    </form>

</div>

<?php 

    if(isset($_POST['lotteryNumber']) && $_POST['lotteryNumber']>0 && $_POST['lotteryNumber']<46){

        if(isset($_POST['buttonPost'])){
            $lotteryNumber = $_POST['lotteryNumber'];
            
        }

        if(isset($_POST['buttonPut'])){
            $lotteryNumber = $_POST['lotteryNumber'];
           
        }
        
    }
    else{
        if(isset($_POST['lotteryNumber'])){
            ?>
                <div class='box'>
                    Please be sure the number is between 1 and 45!
                </div>
            <?php
        }
    }    

    if(isset($_POST['buttonGet'])){
        $lotteryResult = $this->lotteryGet();
        var_dump($lotteryResult);
     }

     if(isset($_POST['buttonDelet'])){
         
     }


     
        $eredmeny = [];
          
                $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                $db = new PDO('mysql:host=localhost;dbname=web2bead2', 'root', '', $pdo_options);
                
                            $sql = "SELECT * FROM huzott WHERE id=(SELECT MAX(id) FROM huzott)";     
                            $sth = $db->query($sql);
                            $eredmeny =  $sth->fetch(PDO::FETCH_ASSOC);
                            print_r( $eredmeny);
