<?php

if($_GET){
 
$user_id = $_GET['id'];

$users=  file('users.txt');

foreach ($users as $index=>$user){
    $user_info= explode(':', $user);
    if ($user_info[0]==$user_id){
        unset($users[$index]);
        break;
      }
    }

    $filehandler = fopen("users.txt", 'w');
    foreach ($users as $user){
        fwrite($filehandler, $user);
    }
    
    fclose($filehandler);
    
    readfile('users.txt');
}
   header("Location:http://localhost/lab2/displayUsers.php");

?>
