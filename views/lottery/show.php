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
        
    </form>

    <?php 

    if(isset($_POST['lotteryNumber']) && $_POST['lotteryNumber']>0 && $_POST['lotteryNumber']<46){

        if(isset($_POST['buttonPost'])){
            $lotteryResult = $this->lotteryPost($_POST['lotteryNumber']);
            echo $lotteryResult;
            
        }

        if(isset($_POST['buttonPut'])){
            $lotteryResult = $this->lotteryPut($_POST['lotteryNumber']);
            echo $lotteryResult;           
        }
        
    }
    else{
        if(isset($_POST['lotteryNumber'])){
            ?>
                <div class='box' id="errorMessege">
                    Please be sure the number is between 1 and 45!
                </div>
            <?php
        }
    }    

    if(isset($_POST['buttonGet'])){
        ?>
            <script>
                $('#errorMessege').hide();
            </script>
        <?php
        $lotteryResult = $this->lotteryGet();
        echo $lotteryResult;
     }

     if(isset($_POST['buttonDelete'])){
        ?>
        <script>
            $('#errorMessege').hide();
        </script>
        <?php
        $lotteryResult = $this->lotteryDelete();
        echo $lotteryResult;
     }

     
?>
</div>
</div>

