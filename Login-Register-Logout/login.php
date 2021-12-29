<?php
include_once "../DBSetup/db.php";
session_start();
$resultMessage="";
extract($_POST);
if(isset($action)){
  $rs=$db->prepare("SELECT * FROM users WHERE username=? and passwd=?");
  $rs->execute([$username,$password]);
  $user=$rs->fetch();
  if(is_array($user)){
    $_SESSION["id"]=$user["id"];
    $_SESSION["name"]=$user["username"];
  }
  else{
    $resultMessage="Invalid Username or Password!";
  }
}
if(isset($_SESSION["id"])){
  var_dump($_SESSION["name"]);
  header("Location:../listview.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../style/loginRegister.css" media="screen">
  <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
<div class="wrapper" id="box">
  <header>Login</header>
  <div class="inputField">
    <form action="" method="POST" autocomplete="off">
      <table>
        <tr>
          <td>
            <label for="username">Username</label>
              <input type="text" name="username" placeholder="Type your username" value="<?=$username??''?>" required/>
            </td>
        </tr>
        <tr>
            <td>
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Type your password" value="<?=$password??''?>" required>
              
            </td>
        </tr>
        <tr>
          <td>
            <?php
                 if(isset($resultMessage)){
                   echo "<span style='color:red;'>$resultMessage</span>";
                 }
            ?>
          </td>
        </tr>
        <tr>
          <td>
             <button type="submit" name="action" class="btn btn-primary btn-lg btn-block">Login</button>
          </td>
        </tr>
        <tr>
          <td>
            <p>Not a member? <a href="signup.php">Sign up</a></p>
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>
<!-- <script src="script.js"></script> -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script type="text/javascript"></script>

</body>
</html>
