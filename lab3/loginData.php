<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    $errors = [];
    $formvalues =[];

if(!empty($_POST["sub"])){

$users=  file('users.txt');

if(!empty($_POST["email"]) && !empty($_POST["password"])){
    $email = $_POST["email"];
    $password = $_POST["password"];
}else{
    $errors["password"]="Password or email Invalid data";
    $errors["email"]="Password or email Invalid data";
}

    foreach ($users as $index=>$user){
        $user_info= explode(':', $user);
        if($user_info[2] == $email and $user_info[3] == $password){
            $user_exist = true;
            $name=$user_info[1];
            break;
        }
    }

    session_start();

if($user_exist){
    $_SESSION["name"]= $name;
 header("Location:welcome.php");

}else{$errors["data"]="User NotFound, Login again!";}

$formerrors=json_encode($errors);
if($errors){
   $redirect_url = "Location:login.php?errors={$formerrors}";
    if ($formvalues){
        $oldvalues = json_encode($formvalues);
        $redirect_url .="&old={$oldvalues}" ;
    }

  header($redirect_url);
}
        
    
}
?>