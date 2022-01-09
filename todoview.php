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
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
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
    <table class="todoList" id='listItems'>
      
    </table>

   

  </div>

  <!-- <script src="script.js"></script> -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script type="text/javascript"></script>

  <script>      

  $(function(){
    $.get("getToDos.php",
      {"listId" : <?=$list["id"]?>},
      function(data) {
        alert(data);
        //$("#listItems").append(data);
        displayTodos(data);
    });

    function displayTodos(data) { 
      var games = data.games;
      
      for (var i = 0; i < data.numOfTodos; i++) {
        var out = '<tr style="align-content: center; display: flex; flex-direction:row;" ><td>'+ data[i].title+ '</td></tr>';
          
        $("#listItems").append(out);
      }
    }

  });
/*
  $(function($) {
    $.get("getToDos.php", {"listId" : }, function(data) {
      alert(data);
      $("#listItems").append(data);
    });

    $("#listItem").click(function() {
      let todoId = 
      alert(todoId);
      getDetail(todoId);
    });

    function getDetail(todoId){
      $.get("goDetail.php",{"detail": $("#detail").val()}, 
      function(data) {
        alert(data);
        var out = data.detail;
        $("#detail").text(out);
      });
    }

    function deleteListItem(todoId){
      $.get("deleteItem.php",{"todoId":todoId}, function(data) {
        alert(data);
        $("#listItems").append(data);
      });
    }
    
  });*/

  </script>

</body>

</html>