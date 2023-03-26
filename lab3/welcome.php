<?php

session_start();
echo"Welcome ". $_SESSION["name"];

echo "
<br>
If you wanna logout,
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
    background-color: #2EE59D;
    box-shadow: 0px 15px 20px rgba(46, 229, 157, 0.4);
    color: #fff;
    transform: translateY(-7px);
    }
    a{
        text-decoration: none;
    }
</style>
<button class='btn btn-info'>
<a href='logout.php'>Logout</a>
</button>
"
?>