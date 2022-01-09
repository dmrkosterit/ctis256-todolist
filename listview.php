<?php
  include_once "./DBSetup/db.php";
  session_start();
  extract($_POST);
  $id=$_SESSION["id"];
  $usertype=$_SESSION["usertype"];
  if (isset($_SESSION['start']) && (time() - $_SESSION['start'] > (5*60))) {//30 min session
    session_unset(); 
    session_destroy(); 
    header("Location:./Login-Register-Logout/login.php");
  }
  if(isset($action)){
    if(ctype_space($title) == false && $title != null){
      $sql = "insert into list (userid,title) values(?,?)";
      $stmt = $db->prepare($sql);
      $stmt->execute([$id,$title]);
    }
  }
  //If the user is the admin then admin can view every item on the list
  if(isset($id)){
    if($usertype==0){
      $sql = "select * from list";
      $rs=$db->query($sql);
      $lists = $rs->fetchAll(PDO::FETCH_ASSOC);
    }else{
      $sql = "select * from list where userid=?";
      $stmt=$db->prepare($sql);
      $stmt->execute([$id]);
      $lists = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
    }
  }
 
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="./style/listview.css" media="screen" />
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">


<div class="wrapper" id="box">
  <header>Welcome, 
    <?php 
    //Username will be shown in this php code
     if(isset($_SESSION["name"])){
       echo $_SESSION["name"];
     }
    ?>
  </header>
  <div class="inputField">
    <form action="" method="post" autocomplete="off"  style="display: flex">
      <input type="text" style="width: auto" name="title" placeholder="New List">
      <button  class="fa fa-plus" style = "color:aliceblue"  name="action" type='submit'></button>
    </form>
    
    
  </div>

  <!-- create a foreach loop for the lists-->
  
  <ul class="todoList" >
  <?php 
    foreach( $lists as $list) : ?>
   <li>
      <a class='title' href='todoview.php?listId=<?=$list["id"]?>'> <?=$list["title"]?> </a>
      <?php
        if($usertype!=0){
      ?>
          <a class='fa fa-edit' style="font-size:18px;margin-left:15px;color:green;" type='button' href='tododetail.php?toDoId=<?= $list["id"] ?>' ></a>
          <a class='fa fa-trash-o' style="font-size:18px;margin-left:15px;color:red;" type='button' href='tododetail.php?toDoId=<?= $list["id"] ?>'></a>
      <?php
        }
      ?>
    </li>
    <?php endforeach?>
  </ul>

  <form action="Login-Register-Logout/logout.php" method="post">
    <button type="submit" name="logout" class="btn btn-primary btn-lg btn-block" style='background-color:red; width:100px; margin-left:120px;'>Logout</button>
  </form>

 <!-- MODALS FOR CONFIRMATION AND FORMS ETC -->

  <!-- update modal -->
  <div class="modal fade" id="updateListModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
       aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="name">Name: </label>
              <input type="text" autocomplete="off" id="editname" name="name"><br><br>
            </div>
            <input type="hidden" id="id" name="id">
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" id="update-listitem-form"
                      data-bs-dismiss="updateListModal">Close</button>
              <button type="button" class="btn btn-primary">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- delete modal -->
  <div class="modal fade" id="deleteListModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
       aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Delete Item</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h4>Are you sure you want to delete this item?</h4>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" id="delete-listitem-form" >Cancel</button>
          <button type="button" class="btn btn-red">Delete</button>
        </div>
      </div>
    </div>
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
