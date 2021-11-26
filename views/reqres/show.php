<div class='container is-max-desktop'>
<div class='box'>
    <form class="field" name="lotteryForm" method="POST" action=''>              
        <br>
        
        <label class='label'>
            You can try the Reqres Api here! Click the buttons to try the methods. 
        </label>
        <br>
   
            <input class="button is-primary" type="submit" name="buttonPost" value="Creat new user [POST]">
            <input class="button is-primary" type="submit" name="buttonPut" value="Update user [PUT]">
            <input class="button is-primary" type="submit" name="buttonGet" value="Get the data! [GET]">
            <input class="button is-primary" type="submit" name="buttonDelete" value="Delete data [DELETE]">
    </form>

    <?php 

        if(isset($_POST['buttonGet'])){
            $dataResult = $this -> getReqres();
            $arrayResult = $dataResult['data'];
            
                ?> 
                    <table class='table'>
                        <tr>
                            <th>Id</th>
                            <th>Email</th>
                            <th>First name</th>
                            <th>Last name</th>
                        </tr>
                <?php
            foreach($arrayResult as $data){
                    echo(" <tr>
                            <td> ".$data['id']." </td> 
                            <td> ".$data['email'])."  </td>
                            <td> ".$data['first_name']." </td>
                            <td> ".$data['last_name']." </td>
                        </tr>";   
            }
                ?>
                    </table>       
                <?php 
        }
        
        if(isset($_POST['buttonPost'])){
            $dataResult = $this -> postReqres();
            echo "<p> You succesfully creat a new user! </p>"
            ?> 
                    <table class='table'>
                        <tr>
                            <th>Name</th>
                            <th>Job</th>
                            <th>id</th>
                            <th>Creat Date</th>
                        </tr>
                <?php
                    echo   "<tr>
                            <td> ".$dataResult['name']." </td> 
                            <td> ".$dataResult['job']."  </td>
                            <td> ".$dataResult['id']." </td>
                            <td> ".$dataResult['createdAt']." </td></tr>";   
                ?>
                    </table>
                <?php
        }

        if(isset($_POST['buttonPut'])){
            $dataResult = $this -> putReqres();
            echo "<p> You succesfully update the user! </p>"
            ?> 
                    <table class='table'>
                        <tr>
                            <th>Name</th>
                            <th>Job</th>
                            <th>Update Date</th>
                        </tr>
                <?php
                    echo   "<tr>
                            <td> ".$dataResult['name']." </td> 
                            <td> ".$dataResult['job']."  </td>
                            <td> ".$dataResult['updatedAt']." </td></tr>";   
                ?>
                    </table>
                <?php
        }

        if(isset($_POST['buttonDelete'])){
            $dataResult = $this -> deleteReqres();
            echo "<p> You succesfully delete the user! </p>";
            echo "Responde: ".$dataResult;
        }
    ?>
</div>
</div>