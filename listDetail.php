<?php
include_once "./DBSetup/db.php";
session_start();
if (isset($_SESSION['start']) && (time() - $_SESSION['start'] > (5*60))) {//30 min session
  session_unset(); 
  session_destroy(); 
  header("Location:./Login-Register-Logout/login.php");
}
extract($_GET);
$sql = "select * from to_do where id=?";
$rs = $db->prepare($sql);
$rs->execute([$listId]);
$todo = $rs->fetch(PDO::FETCH_ASSOC);

extract($_POST); 
if(isset($update)){
  $sql = "update list set title=:iTitle where id=:iId";
  $stmt = $db->prepare($sql);
  $stmt->execute(["iTitle"=>$title,"iId"=> $id]);
  header("Location:listview.php?listId=$listId");
  exit;
}

//echo($listId);

//echo ($listId);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="./style/tododetail.css" media="screen" />
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
</head>

<body>
  <div class="wrapper" id="box">
    <div class="header" style="display: flex">
      <div class="box-footer clearfix no-border">
        <form action='todoview.php?listId=<?=$listId?>' method="post">
          <button type="submit" style="background-color:DeepSkyBlue;" class="btn btn-default pull-left">
            <a class="fa fa-arrow-left"></a>
          </button>
        </form>
      </div>
      <header style="margin-left:15px;">List Name</header>
    </div>

    <form action="" method="post">
      <div class="form-group">
        <label for="title">Title: </label><br>
        <input style='margin: 10px 10px 10px 10px;width:90%; background: #f2f2f2;border-radius: 3px;' type="text" value= "<?=$todo["title"]?>"autocomplete="off" id="title" name="title"></input>
      </div>

      <input type="hidden" name="id" value="<?=$listId?>">

      <div class="footer">
        <button type="submit" style="margin: 10px auto 10px auto;" name="update">Update</button>
      </div>
    </form>
  </div>
</body>