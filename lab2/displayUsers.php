<?php
echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>';

//for displaying errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    if(is_readable('users.txt')){
        $users= file("users.txt");
        echo "<table class='table table-hover table-dark'>
        <tr> <th>ID</th> <th>First name</th> <th>Last name</th> <th>Address</th> <th>Skills</th> <th>Username </th> <th>Password</th>  <th>Departement</th> <th>Delete</th> <th>Edit</th></tr>";    
        foreach ($users as $user){
            $userdata = trim($user, "\n");
            $userdata = explode(":", $userdata);
            echo "<tr>";
            foreach ($userdata as $d){
              
                echo "<td> {$d} </td>";
            }
            $delete_url="http://localhost/lab2/deleteuser.php?id={$userdata[0]}";
            echo "<td> <a href='"."{$delete_url}". "' class='btn btn-danger'> Delete</a> </td>";
            $edit_url="http://localhost/lab2/edituser.php?id={$userdata[0]}";
            echo "<td> <a href='"."{$edit_url}". "' class='btn btn-primary'> Edit</a> </td>";
 
            echo "</tr>";
        }
    }
?>