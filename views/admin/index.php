<div>You can delete users here</div><br>

<?php 
echo '<table><tr><th>First name</th><th>Last name</th><th>Username</th></tr>';
foreach(User::all() as $user){
    echo '<tr><td>'
    .$user->first_name.'</td><td>'
    .$user->last_name.'</td><td>'
    .$user->username.'</td><td><a href="?controller=admin&action=deleteUser&username='
    .$user->username.'">Delete</a></td></tr>';
}
echo '</table>';



?>

<style>
table, th, tr {
  border:1px solid black;
  padding:3px;
}
</style>