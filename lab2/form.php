<?php

    if($_GET){
        $errors = json_decode($_GET['errors']);
        $errors = (array) $errors;
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login form </title>
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
                  width: 1500px;
                  margin-left: auto;   
                  }
        </style>
      </head>
    <body>
      <div class="container">
        <form action="formData.php" method="post" style="margin: auto;">
            <div class="form-row">
              <div class="form-group col-lg-6">
                <label for="inputEmail4">First Name</label>
                <input type="text" class="form-control" name="fname" placeholder="First Name">
                <div class="text-danger"> <?php  if(isset($errors['fname']))  echo $errors['fname']; ?></div>
              </div>
              <div class="form-group col-lg-6">
                <label for="inputPassword4">Last Name</label>
                <input type="text" class="form-control" name="lname" placeholder="Last Name">
                <div class="text-danger"> <?php  if(isset($errors['lname']))  echo $errors['lname']; ?></div>
              </div>
            </div>
            <div class="form-group col-lg-6">
              <label for="inputAddress">Address</label>
              <textarea type="text" class="form-control" name="address" placeholder="1234 Main St"></textarea>
            </div>
            <div class="form-group col-lg-6">
                <label for="exampleFormControlSelect1">Country</label>
                <select class="form-control">
                  <option>Mansoura</option>
                  <option>Alex</option>
                </select>
              </div>
            <div class="form-check-inline">
                <input class="form-check-input" type="radio" name="gender"  value="male" checked>
                <label class="form-check-label" for="exampleRadios1">
                 Male
                </label>
              </div>
              <div class="form-check-inline">
                <input class="form-check-input" type="radio" name="gender" value="female" checked>
                <label class="form-check-label" for="exampleRadios1">
                 Female
                </label>
              </div>
              <br>
            <div class="form-group">
              <div class="form-check-inline">
                <input class="form-check-input" type="checkbox" name="skills[]" value="php">
                <label class="form-check-label" for="gridCheck" >
                 PHP
                </label>
              </div>
                <div class="form-check-inline">
                  <input class="form-check-input" name="skills[]" type="checkbox" value="db">
                  <label class="form-check-label" for="gridCheck">
                   MYSQL
                  </label>
                </div>
              </div>
              <div class="form-group">
                <div class="form-check-inline">
                  <input class="form-check-input" name="skills[]" type="checkbox" value="bootstrap">
                  <label class="form-check-label" for="gridCheck">
                   Bootstrap
                  </label>
                </div>
                <div class=" form-check-inline">
                  <input class="form-check-input" name="skills[]" type="checkbox" value="xml" >
                  <label class="form-check-label" for="gridCheck">
                   XML
                  </label>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-lg-6">
                  <label >Username</label>
                  <input type="text" class="form-control" name="username" placeholder="userame">
                </div>
                <div class="text-danger"> <?php  if(isset($errors['username']))  echo $errors['username']; ?></div>
                <div class="form-group col-lg-6">
                  <label >Password</label>
                  <input type="password" class="form-control" name="password" placeholder="password">
                </div>
                <div class="text-danger"> <?php  if(isset($errors['password']))  echo $errors['password']; ?></div>
                <div class="form-group col-lg-6">
                    <label >Departement</label>
                    <input type="text" class="form-control" name="dep" placeholder="Departement">
                  </div>
                  <div class="form-group col-lg-6">
                    <label style="display: inline" >enter the following code : </label>
                           <h2 style="display: inline;; color:red">Ysj34$M</h2>
                <input type="text" class="form-control" name="code" placeholder="code">
                  </div>
              </div>
<br>
              <div >
            <button type="submit" name="sub" value="submit" class="btn btn-success" >Submit</button>
            <button type="submit" name="reset" value="submit" class="btn btn-danger">reset</button>
              </div>
          </form>
        </div>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>