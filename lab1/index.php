<?php
//for displaying errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(!empty($_POST["sub"])){
    if($_POST["gender"] == "male"){
    echo "Thanks Mr ".$_POST["fname"]." ".$_POST["lname"];
    }
    elseif($_POST["gender"] == "female"){
        echo "Thanks Miss ".$_POST["fname"]." ".$_POST["lname"];
    }
    
echo "<br>Please review your information: <br>";
if(!empty($_POST["fname"]))
{ echo "<br>Name :".$_POST["fname"];}

if(!empty($_POST["address"]))
{ echo "<br>Address".$_POST["address"];}

 if(!empty($_POST['skills'])) {    
    echo "<br>skills : <br>";
    foreach($_POST['skills'] as $value){
        echo $value.'<br/>';
    }
}
if(!empty($_POST["username"]))
{echo "<br>username: ".$_POST["username"];}

if(!empty($_POST["password"]))
{echo "<br>password: ".$_POST["password"];}

if(!empty($_POST["dep"]))
{echo "<br>departement: ".$_POST["dep"];}

if($_POST["code"] != "Ysj34\$M" || empty($_POST["code"])){
//header("Location: http://localhost/lab1");
//echo '<script>alert("Enter valid code!")</script>';
}

}

elseif(!empty($_POST["reset"])){
    header("Location: http://localhost/lab1");
}


?>