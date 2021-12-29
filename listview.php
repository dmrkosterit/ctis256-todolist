<?php
  include_once "./DBSetup/db.php";
  extract($_POST); //$title, $price, $launch, $action
  if(isset($action)){
    //echo($title);
    $sql = "insert into list (title) values(?)";
    $stmt = $db->prepare($sql);
    $stmt->execute([$title]);
  }

  $sql = "select * from list";
  $rs= $db->query($sql);
  $lists = $rs->fetchAll(PDO::FETCH_ASSOC);
  //var_dump($lists)

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
  <header>Welcome</header>
  <div class="inputField">
    <form action="" method="post" autocomplete="off"  style="display: flex">
      <input type="text" style="width: auto" name="title" placeholder="New List">
      <button  class="fa fa-plus" style = "color:aliceblue"  name="action" type='submit'></button>
    </form>
    
    
  </div>

  <!-- create a foreach loop for the lists-->
  
  <ul class="todoList" >
  <?php foreach( $lists as $list) : ?>
   <li>
      <a class='title' href='todoview.php?listId=<?=$list["id"]?>'> <?=$list["title"]?> </a>
      <i class="fa fa-edit" ></i>
      <i class="fa fa-trash-o"></i>
    </li>
    <?php endforeach?>
  </ul>




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
