<?php
require_once('connection/db_connection.php');

//for displaying errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if($db){
 
        $id = $_GET['id'];
    
        try {
            $query = "DELETE FROM `cafeteria`.`users` WHERE id=:id";
            $stmt = $db->prepare($query);
            $data = [
                ':id' => $id
            ];
            $query_execute = $stmt->execute($data);
            header("Location:display.php");
        } catch(PDOException $e){
            echo $e->getMessage();
        }
    

}

?>