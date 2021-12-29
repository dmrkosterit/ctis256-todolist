<?php
  include_once "./DBSetup/db.php";
  extract($_GET); 
  //echo($listId);
  $sql = "select * from to_do where listid = $listId";
  $rs= $db->query($sql);
  $todos = $rs->fetchAll(PDO::FETCH_ASSOC);
  //var_dump($todos)
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="./style/todoview.css" media="screen" />
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
</head>

<body>
<div class="wrapper" id = "box">

  <div class="header" style="display: flex">

    <div class="box-footer clearfix no-border">

      <button type="button" class="btn btn-default pull-left">
        <a class="fa fa-arrow-left" href="listview.php"></a>
      </button>

    </div>
    
    <?php 
     $sql = "select * from list where id=?";
     $rs= $db->prepare($sql);
     $rs->execute([$listId]);
     $list = $rs->fetch(PDO::FETCH_ASSOC);
    echo "<header>{$list["title"]}</header>"
    ?>
  </div>

  <div class="inputField">
    <form autocomplete="off" style="display: flex">
      <input type="text" style="width: auto" autocomplete="off" name="title" placeholder="New Item">
    </form>
    <button type="button" class="fa fa-plus" (click)="onAddToDo(addForm); "></button>
  </div>

  <!-- foreach loop for the todos here-->

  
  <ul class="todoList">
  <?php foreach( $todos as $todo) : ?>
    
    <li >
      <input type="checkbox"/>
      <a class="title"> <?=$todo["title"]?> </a>
      <i class="fa fa-edit"></i>
      <i class="fa fa-trash-o"></i>
      <?php endforeach?>
    </li>
  </ul>


  
  <!-- delete modal -->
  <div class="modal fade" id="deleteToDoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <button type="button" class="btn btn-secondary"  id="delete-todoitem-form">Cancel</button>
          <button type="button"  class="btn btn-red">Delete</button>
        </div>
      </div>
    </div>
  </div>

</div>

<!-- <script src="script.js"></script> -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript"></script>

</body>
</html>
