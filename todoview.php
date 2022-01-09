<?php
include_once "./DBSetup/db.php";
session_start();
$usertype=$_SESSION["usertype"];
extract($_GET);
//var_dump($_GET);
$sql = "select * from list where id=?";
$rs = $db->prepare($sql);
$rs->execute([$listId]);
$list = $rs->fetch(PDO::FETCH_ASSOC);

extract($_POST); 
if (isset($action)) {
  //echo($title);
  if (ctype_space($title) == false  && $title != null) {
    $sql = "insert into to_do (title,done,listid) values(?,FALSE,$listId)";
    $stmt = $db->prepare($sql);
    $stmt->execute([$title]);
  }
}

if(isset($_GET["todoId"])){
  $todoId = $_GET["todoId"];
  $sql = "delete from to_do where id=?";
  $stmt = $db->prepare($sql);
  $stmt->execute([$todoId]);
}

$sql = "select * from to_do where listid=?";
$rs = $db->prepare($sql);
$rs->execute([$listId]);
$todos = $rs->fetchAll(PDO::FETCH_ASSOC);

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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
</head>

<body>
  <div class="wrapper" id="box">
    <div class="header" style="display: flex">
      <div class="box-footer clearfix no-border" style="display: flex">
        <form action="listview.php" method="post">
          <button type="submit" style="background-color:DeepSkyBlue;" class="btn btn-default pull-left">
            <a class="fa fa-arrow-left"></a>
          </button>
        </form>
        <?php echo "<header style='margin-left:15px;'>{$list["title"]}</header>" ?>
      </div>
    </div>

    <div class="inputField">
      <form action="" method="post" autocomplete="off" style="display: flex">
        <input type="text" style="width: auto" name="title" placeholder="New Item">
        <button class="fa fa-plus" style="color:aliceblue" name="action" type='submit'></button>
      </form>
    </div>

    <!-- foreach loop for the todos here-->
    <ul class="todoList" id='listItems'>
    <?php foreach ($todos as $todo) :?>
        <li style="align-content: center; display: flex; flex-direction:row;" >
          <form action="" method="post" action="update" autocomplete="off" style="display: flex">
            <?php
            if($usertype!=0){?>
            <input type="checkbox" style="zoom:1.5;margin-top:8px;" id="done" name="done" 
              <?php
                  if ($todo["done"]) {
                    echo "checked";
                  }
                }
                $sql = "update to_do set done=1 where id=?";
                $rs = $db->prepare($sql);
                $rs->execute([$todo['id']]);
              ?>
            >
          </form>
          <div>
            <h class='title' style="margin-left:10px;" id='listItem' href=''><?= $todo["title"] ?> </h>
            <p id='detail'></p>
          </div>            
            <?php 
            if($usertype!=0){
            ?>
             <a class='fa fa-edit' style="font-size:18px;margin-left:15px;color:green;margin-top:13px;" type='button' href='tododetail.php?toDoId=<?= $todo["id"] ?>' ></a>
             <a class='fa fa-trash-o' id='deleteButton' style="font-size:18px;margin-left:15px;color:red;margin-top:12px;" type='button'  href='?todoId=<?=$todo["id"]?>&listId=<?=$todo["listid"]?>'></a>
            <?php 
            }
           ?>
        </li>
<?php endforeach?>
          </ul>
  </div>

  <!-- <script src="script.js"></script> -->
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script type="text/javascript"></script>
  
</body>

</html>