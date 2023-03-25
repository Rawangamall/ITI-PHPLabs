<?php
    // validate data
    $errors = [];
    $formvalues=[];
    $skillValue ="";


if($_POST){ 
echo "<br>Please review your information: <br>";

    $users=  file('users.txt');

        foreach ($users as $index=>$user){
        $user_info= explode(':', $user);
        if ($user_info[0]==$_POST['id']){
             unset($users[$index]);

        if(!empty($_POST["fname"]))
        {  $fname = $_POST["fname"];
        $id= $_POST['id'];
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

        }
        }

        $formerrors=json_encode($errors);

        if($errors){
        var_dump($formerrors);
        $redirect_url = "Location:http://localhost/lab2/edituser.php?id={$user_info[0]}&errors={$formerrors}";
        if ($formvalues){
        $oldvalues = json_encode($formvalues);
        $redirect_url .="&old={$oldvalues}" ;
        }

        header($redirect_url);

        }
        if(!$errors) {
        try{

        //delete old values
        $filehandler = fopen("users.txt", 'w');
        foreach ($users as $user){
        fwrite($filehandler, $user);}
        fclose($filehandler);
        readfile('users.txt');

    //new row with same ID
    @$user_info  ="{$id}:{$fname}:{$lname}:{$address}:{$skillValue}:{$username}:{$password}:{$dep}";

    $open = file_get_contents("users.txt");
    $open .= $user_info."\n";
    file_put_contents("users.txt",$open);
    
    header("Location:http://localhost/lab2/displayUsers.php");

    }catch (Exception $e){
        var_dump($e);}
       
    }
}

?>