
<?php
echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>';

if($_GET){ 
$user_id = $_GET['id'];
$users=  file('users.txt');

@$errors = json_decode($_GET['errors']);
@$errors = (array) $errors;

foreach ($users as $index=>$user){
    $user_info= explode(':', $user);
    if ($user_info[0]==$user_id){
     //   var_dump($user_info);
       
echo "  
<head>
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
      width: 1500px;
      margin-left: auto;   
      }
</style>
</head>     
 <form action='editdata.php' method='post' style='margin: auto;'>
 <input type='hidden' name='id' value='$user_info[0]'>

<div class='form-row'>
  <div class='form-group col-lg-6'>
    <label>First Name</label>
    <input type='text' class='form-control' name='fname' value='$user_info[1]' >
    <div class='text-danger'> <?php  if(isset($errors[fname]))  echo $errors[fname]; ?></div>
  </div>
  <div class='form-group col-lg-6'>
    <label for='inputPassword4'>Last Name</label>
    <input type='text' class='form-control' name='lname'  value='$user_info[2]'>
    <div class='text-danger'> <?php  if(isset($errors[lname]))  echo $errors[lname]; ?></div>

  </div>
  <div class='form-group col-lg-6'>
  <label for='inputAddress'>Address</label>
  <textarea type='text' class='form-control' name='address'  value='$user_info[3]'></textarea>
</div>
<div class='form-group col-lg-6'>
    <label>Country</label>
    <select class='form-control'>
      <option>Mansoura</option>
      <option>Alex</option>
    </select>
  </div>
  <div class='form-check-inline'>
  <input class='form-check-input' type='radio' name='gender'  value='male' checked>
  <label class='form-check-label'>
   Male
  </label>
</div>
<div class='form-check-inline'>
  <input class='form-check-input' type='radio' name='gender' value='female' checked>
  <label class='form-check-label'>
   Female
  </label>
</div>
<br>
<div class='form-group'>
<div class='form-check-inline'>
  <input class='form-check-input' type='checkbox' name='skills[]' value='php'>
  <label class='form-check-label' for='gridCheck' >
   PHP
  </label>
</div>
  <div class='form-check-inline'>
    <input class='form-check-input' name='skills[]' type='checkbox' value='db'>
    <label class='form-check-label' for='gridCheck'>
     MYSQL
    </label>
  </div>
</div>
<div class='form-group'>
  <div class='form-check-inline'>
    <input class='form-check-input' name='skills[]' type='checkbox' value='bootstrap'>
    <label class='form-check-label'>
     Bootstrap
    </label>
  </div>
  <div class='form-check-inline'>
    <input class='form-check-input' name='skills[]' type='checkbox' value='xml' >
    <label class='form-check-label'>
     XML
    </label>
  </div>
</div>
<div class='form-row'>
  <div class='form-group col-lg-6'>
    <label >Username</label>
    <input type='text' class='form-control' name='username' value='$user_info[5]'>
  </div>
  <div class='text-danger'> <?php  if(isset($errors[username]))  echo $errors[username]; ?></div>
  <div class='form-group col-lg-6'>
    <label >Password</label>
    <input type='password' class='form-control' name='password' value='$user_info[6]'>
  </div>
  <div class='text-danger'> <?php  if(isset($errors[password]))  echo $errors[password]; ?></div>
  <div class='form-group col-lg-6'>
      <label >Departement</label>
      <input type='text' class='form-control' name='dep' value='$user_info[7]'>
    </div>
    <div class='form-group col-lg-6'>
      <label style='display: inline' >enter the following code : </label>
             <h2 style='display: inline;; color:red'>Ysj34\$M</h2>
  <input type='text' class='form-control' name='code' placeholder='code'>
    </div>
</div>
<br>
<div >
<button type='submit' name='sub' value='submit' class='btn btn-success' >Submit</button>
<button type='submit' name='reset' value='submit' class='btn btn-danger'>reset</button>
</div>
</form>
  ";
  
        }
      }
  
  }
  
?>           
            