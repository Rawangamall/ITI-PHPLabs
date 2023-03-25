<?php
echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>';

//for displaying errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    // validate data
    $errors = [];
   $skillValue ="";

if(!empty($_POST["sub"])){
    if($_POST["gender"] == "male"){
    echo "Thanks Mr ".$_POST["fname"]." ".$_POST["lname"];
    }
    elseif($_POST["gender"] == "female"){
        echo "Thanks Miss ".$_POST["fname"]." ".$_POST["lname"];
    }
    
echo "<br>Please review your information: <br>";
if(!empty($_POST["fname"]))
{  $fname = $_POST["fname"];
    $date = date_create();
    $id= date_timestamp_get($date);
}else{$errors["fname"]='FirstName required';}

if(!empty($_POST["lname"]))
{ $lname = $_POST["lname"];
}else{$errors["lname"]='LastName required';}

if(!empty($_POST["address"]))
{ $address = $_POST["address"];}


 if(!empty($_POST['skills'])) {    
    foreach($_POST['skills'] as $value){
        $skillValue .= " ".$value ;       
    }
}
if(!empty($_POST["username"]))
{$username = $_POST["username"];
}else{$errors["username"]='Username required';}


if(!empty($_POST["password"]))
{$password = $_POST["password"];
}else{$errors["password"]='Password required';}


if(!empty($_POST["dep"]))
{$dep = $_POST["dep"];}


$formerrors=json_encode($errors);

if($errors){
    var_dump($formerrors);
    $redirect_url = "Location:http://localhost/lab2/form.php?errors={$formerrors}";
    if ($formvalues){
        $oldvalues = json_encode($formvalues);
      $redirect_url .="&old={$oldvalues}" ;
    }

    header($redirect_url);

}

if(!$errors) {

@$user_info  ="{$id}:{$fname}:{$lname}:{$address}:{$skillValue}:{$username}:{$password}:{$dep}";
# save the data to file
   try{
    $filehandler= fopen("users.txt", 'a');
    fwrite($filehandler, $user_info.PHP_EOL);
    fclose($filehandler);

    # read file content 
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

}
catch (Exception $e){
    var_dump($e);
}



}
}

elseif(!empty($_POST["reset"])){
    header("Location: http://localhost/lab2/form.php");
}


?>