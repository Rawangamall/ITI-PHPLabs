<?php
session_start();
if(!isset($_SESSION["name"])){
header("Location:login.php");
}
?>

<html>
<div style="text-align: center;font-style: oblique;">
<h2>
  Welcome <?php echo $_SESSION["name"];?>
</h2> 
</div>
<style>
.btn{
    margin: auto;
    border: none;
    border-radius: 45px;
    box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease 0s;
    cursor: pointer;
    margin: 0;
}
.btn:hover {
    background-color: rgb(207, 3, 3);
    box-shadow: 0px 15px 20px rgba(46, 229, 157, 0.4);
    color: #fff;
    transform: translateY(-7px);
    }
    a{
        text-decoration: none;
    }
</style>
<br>
<p style="font-style: oblique;">
If you wanna logout
</p>
<button class='btn btn-light'>
<a href='logout.php'>Logout</a>
</button>
</html>
