<?php
echo '
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>';

require_once('connection/db_connection.php');

//for displaying errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($db) {
    @$id = $_GET['id'];
    $query = 'SELECT * FROM `cafeteria`.`users` WHERE id=:id;';
    $data = [':id' => $id];
    $stmt = $db->prepare($query);
    $result = $stmt->execute($data);
    if ($result) {
        $user = $stmt->fetchObject();
    }
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
    
    if($_POST["exit"]){
        $exit = $_POST["exit"];
        }else{$errors["exit"] = "NO.exit is Required";}
    
    // if($_FILES["image"]){
    //     $file_name = $_FILES['image']['name'];
    //     $file_tmp =$_FILES['image']['tmp_name'];
    //     $file_type=$_FILES['image']['type'];
    
    // $extension = explode('.',basename($file_name));
    // $allowed_extenstions=["png", 'jpg', 'jpeg'];
    
    // if(in_array(end($extension), $allowed_extenstions)){
    //     $res=move_uploaded_file($file_tmp,"images/{$file_name}");
    
    //     $imagespath = "images/{$file_name}";
    // }else{$errors["image"] = "Upload image is Invalid extenstion";}
    // }else{$errors["image"] = "Upload image is Required";}
      
    $formerrors=json_encode($errors);

if($errors){
    $redirect_url = "Location:edit.php?errors={$formerrors}";
    if ($formvalues){
      $oldvalues = json_encode($formvalues);
      $redirect_url .="&old={$oldvalues}" ;
    }

    header($redirect_url);
}
if(!$errors){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $exit = $_POST['exit'];
    $room = $_POST['room'];
    // $image = $_POST['image'];

    try{
    $query = "UPDATE `cafeteria`.`users`
    SET `name` =:name , `email`=:email, `password`=:password,`exit`=:exit, `room`=:room
    WHERE `id`=:id; ";
    $stmt = $db->prepare($query);

$data = [
    ':name' => $name,
    ':email' => $email,
    ':password' => $password,
    ':exit' => $exit,
    ':room' => $room,
    // ':image' => $image,
    ':id' => $id
];
$query_execute = $stmt->execute($data);
   header("Location:display.php");
  } catch (PDOException $e) {
    echo $e->getMessage();
}
}
}
}
?>
<head>
        <meta charset="UTF-8">
        <title>Edit form </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap.css" rel="stylesheet" />
        <link href="css/font-awesome.css" rel="stylesheet" />
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
                .container{
                  margin-top: 5%;
                  width: 1500px;
                  margin-left: auto;   
                  text-align: center;

                  }
           
        
        </style>
      </head>
    <body>
      <div class="container">
        <form action="edit.php" method="post" enctype="multipart/form-data" style="margin: auto;">
          <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>
          <div class="form-row">
            <input type="hidden" name="id" value="<?=$user->id?>" />
                </div>
          <div class="form-row">
              <div class="form-group col-lg-6">
              <div class="input-group mt-2">
                <span class="input-group-prepend input-group-text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                    </svg>
                </span>
                <input type="text" class="form-control" name="name" placeholder="Name" value="<?=$user->name?>">
                <div class="text-danger"> <?php  if(isset($errors['name']))  echo $errors['name']; ?></div>
              </div>
                </div>
              <div class="form-group col-lg-6">
              <div class="input-group mt-2">
                <span class="input-group-prepend input-group-text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-at" viewBox="0 0 16 16">
                    <path d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2H2Zm3.708 6.208L1 11.105V5.383l4.708 2.825ZM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2-7-4.2Z"/>
                    <path d="M14.247 14.269c1.01 0 1.587-.857 1.587-2.025v-.21C15.834 10.43 14.64 9 12.52 9h-.035C10.42 9 9 10.36 9 12.432v.214C9 14.82 10.438 16 12.358 16h.044c.594 0 1.018-.074 1.237-.175v-.73c-.245.11-.673.18-1.18.18h-.044c-1.334 0-2.571-.788-2.571-2.655v-.157c0-1.657 1.058-2.724 2.64-2.724h.04c1.535 0 2.484 1.05 2.484 2.326v.118c0 .975-.324 1.39-.639 1.39-.232 0-.41-.148-.41-.42v-2.19h-.906v.569h-.03c-.084-.298-.368-.63-.954-.63-.778 0-1.259.555-1.259 1.4v.528c0 .892.49 1.434 1.26 1.434.471 0 .896-.227 1.014-.643h.043c.118.42.617.648 1.12.648Zm-2.453-1.588v-.227c0-.546.227-.791.573-.791.297 0 .572.192.572.708v.367c0 .573-.253.744-.564.744-.354 0-.581-.215-.581-.8Z"/>
                    </svg>
                </span>
                <input type="email" class="form-control" name="email" placeholder="email" value="<?=$user->email?>">
                <div class="text-danger"> <?php  if(isset($errors['email']))  echo $errors['email']; ?></div>
              </div>
                </div>
              </div>

              <div class="form-row">
              <div class="form-group col-lg-6">
              <div class="input-group mt-2">
            <span class="input-group-prepend input-group-text">
               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-lock" viewBox="0 0 16 16">
                <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h5v-1a1.9 1.9 0 0 1 .01-.2 4.49 4.49 0 0 1 1.534-3.693C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Zm7 0a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1v-2Zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1Z"/>
                </svg>
            </span>
           <input type="password" class="form-control" name="password" placeholder="password" value="<?=$user->password?>" required/>
                <div class="text-danger"> <?php  if(isset($errors["password"]))  echo $errors["password"]; ?></div>
              </div> 
                </div>
                <div class="form-group col-lg-6">
                <div class="input-group mt-2">
            <span class="input-group-prepend input-group-text">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-lock" viewBox="0 0 16 16">
                <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h5v-1a1.9 1.9 0 0 1 .01-.2 4.49 4.49 0 0 1 1.534-3.693C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Zm7 0a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1v-2Zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1Z"/>
                </svg>
            </span>
           <input type="password" class="form-control" name="confirm" placeholder="confirm password" required/>
              </div>
                <div class="text-danger"> <?php  if(isset($errors['confirm']))  echo $errors['confirm']; ?></div>
                </div>
               </div>
                <div class="form-row">                
                  <div class="form-group col-lg-6" style="margin-top:8px;">
                    <select class="form-control" name="room">
                      <option value="">Select No.ROOM</option>
                      <option value="Application 1">Application 1</option>
                      <option value="Application 2">Application 2</option>
                      <option value="cloud">Cloud</option>
                    </select>
                  </div>
                  <div class="form-group col-lg-6">
              <div class="input-group mt-2">
                <span class="input-group-prepend input-group-text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                    </svg>
                </span>
                <input type="number" class="form-control" name="exit" placeholder="Exit" value="<?=$user->exit?>">
                <div class="text-danger"> <?php  if(isset($errors['exit']))  echo $errors['exit']; ?></div>
              </div>
                </div>
                </div>
                <!-- <div class="form-row">     
                  <div class="form-group col-lg-12">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="customFile" name="image" >
                      <label class="custom-file-label" for="customFile">Choose image</label>
                      <div class="text-danger"></div>
                    </div>
                  </div>
                </div> -->
                <br>
              <div >
            <button type="submit" name="sub" value="submit" class="btn btn-info">Save</button>
              </div>
          </form>
        </div>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

