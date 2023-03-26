<?php

//for displaying errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    // validate data
    $errors = [];
    $formvalues =[];

if(!empty($_POST["sub"])){

if($_POST["name"]){
$date = date_create();
$id= date_timestamp_get($date);
$name = $_POST["name"];
}else{$errors["name"] = "Name is Required";}

if($_POST["email"]){

if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
$email = $_POST["email"];
}else{$errors["email"] = "Email is Invalid";}
}else{$errors["email"] = "Email is Required";}

if($_POST["password"]){
    //bonus
$pattern ="/^[a-z_]{8}$/";
if(preg_match($pattern,$_POST["password"])){
$password = $_POST["password"];
}else{$errors["password"] = "Invalid password, should be only 8 lowercase letters & only (_) allowed";}
}else{$errors["password"] = "Password is Required";}

 if($_POST["confirm"]){
$confirm_Pass = $_POST["confirm"];
if($confirm_Pass != $password){$errors["confirm"] = "password isn't matched";}

}else{$errors["confirm"] = "Confirm password is Required";}

if($_POST["room"] != ""){
$room = $_POST["room"];
}else{$errors["room"] = "NO.ROOM is Required";}

if($_FILES["img"]){
    $file_name = $_FILES['img']['name'];
    $file_size =$_FILES['img']['size'];
    $file_tmp =$_FILES['img']['tmp_name'];
    $file_type=$_FILES['img']['type'];

$extension = explode('.',basename($file_name));
$allowed_extenstions=["png", 'jpg', 'jpeg'];

if(in_array(end($extension), $allowed_extenstions)){
    $res=move_uploaded_file($file_tmp,"images/{$file_name}");

    $imagespath = "images/{$file_name}";
}else{$errors["img"] = "Upload image is Invalid extenstion";}
}else{$errors["img"] = "Upload image is Required";}
  
$formerrors=json_encode($errors);

if($errors){
    var_dump($formerrors);
    $redirect_url = "Location:signup.php?errors={$formerrors}";
    if ($formvalues){
        $oldvalues = json_encode($formvalues);
      $redirect_url .="&old={$oldvalues}" ;
    }

    header($redirect_url);
}
if(!$errors){
    @$user_info  ="{$id}:{$name}:{$email}:{$password}:{$room}:{$imagespath}";
    var_dump($user_info);
    try{
     $filehandler= fopen("users.txt", 'a');
     fwrite($filehandler, $user_info.PHP_EOL);
     fclose($filehandler);

     header("Location:login.php");

    }catch(Exception $e){
       var_dump($e);
    }

}
elseif($_POST["reset"]){
    header("Location:signup.php");
}

}

?>