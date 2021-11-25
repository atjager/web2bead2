<div class='container is-max-desktop'>
<div class='box'>

    <?php 
        var_dump($getres = $this -> getReqres());
    ?>

    <form class="field" name="lotteryForm" method="POST" action=''>              
        <br>
        
        <label class='label'>
            You can try the Reqres Api!
        </label>
        <br>
   
            <input class="button is-primary" type="submit" name="buttonPost" value="Add the number">
            <input class="button is-primary" type="submit" name="buttonPut" value="Replace last number">
            <input class="button is-primary" type="submit" name="buttonGet" value="Get the data!">
            <input class="button is-primary" type="submit" name="buttonDelete" value="Delete last number">
        </div>
    </form>

    <?php 

        if(isset($_POST['buttonGet'])){
            $dataResult = $this -> getReqres();
            $arrayResult = $dataResult['data'];
            print_r($arrayResult);
        }
        
    ?>

</div>