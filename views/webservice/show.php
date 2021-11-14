<div class='container is-max-desktop'>
<div class='box'>
    <p> 
        Ezen az oldalon találhatók a Soap webszolgáltatáshoz szükséges információk. 
    </p>
    <br>
        <p>
        A következő soap link szükséges a használatához:
        <br>
        <strong>http://localhost/web2bead1/models/webservice.php</strong>
    </p>
    <p>
        <br>
       Jelenleg három lekérdezés elérhető, ezek a Soap szolgáltatás meghívása után használhatók.
    
    </p>
    <br>
    <ul class='content'>
        <li>&emsp;getgep()</li>
        <li>&emsp;getszoftver()</li>
        <li>&emsp;gettelepites()</li>
    </ul>

    

    <br>
    <p>
        A három metódus a különböző táblák teljes tartalmát vissza adják. Ezek láthatók lentebb.
    </p>
</div>


<div class='box'>
    <strong>Gépek</strong>

    <table class="table">
        <tr>
            <th>ID</th>
            <th>Place</th>
            <th>Type</th>
            <th>IP</th>
        </tr>
        <?php         
            foreach($gepek as $gep){
                echo "<tr><td>".$gep['id']."</td><td>".$gep['hely']."</td><td>".$gep["tipus"]."</td><td>".$gep["ipcim"]."</td></tr>";
            }
        ?>
    </table>
</div>

<div class='box'>
<strong>Szoftverek</strong>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
        </tr>
        <?php
            
            foreach($szoftverek as $szoftver){
                echo "<tr><td>".$szoftver['id']."</td><td>".$szoftver['nev']."</td><td>".$szoftver["kategoria"]."</td></tr>";
            }
        ?>
    </table>
</div>

<div class='box'>
    <strong>Telepítések</strong>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>MachineID</th>
            <th>SoftwareID</th>
            <th>Version</th>
            <th>Date</th>
        </tr>
        <?php
            
            foreach($telepitesek as $telepit){
                echo "<tr><td>".$telepit['id']."</td><td>".$telepit['gepid']."</td><td>".$telepit["szoftverid"].
                "</td><td>".$telepit["verzio"]."</td><td>".$telepit["datum"]."</td></tr>";
            }
        ?>
    </table>
</div>
</div>