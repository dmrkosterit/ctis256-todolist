<?php
include_once "./DBSetup/db.php";

extract($_GET);
$sql = "select * from to_do where id=?";
$rs = $db->prepare($sql);
$rs->execute([$toDoId]);
$todo = $rs->fetch(PDO::FETCH_ASSOC);

$sql = "select id from list where id = {$todo["listid"]}";
$rs = $db->query($sql);
$listId = $rs->fetch(PDO::FETCH_ASSOC);
$listId = $listId["id"];

extract($_POST); //$title, $price, $launch, $action, $id
if(isset($update)){
  $sql = "update to_do set title=:iTitle, note=:iNote where id=:iId";
  $stmt = $db->prepare($sql);
  $stmt->execute(["iTitle"=>$title,"iNote"=>$note, "iId"=> $id]);
  header("Location:todoview.php?listId=$listId");
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
        <form action='todoview.php?listId=<?php echo "$listId" ?>' method="post">
          <button type="submit" class="btn btn-default pull-left">
            <a class="fa fa-arrow-left"></a>
          </button>
        </form>
      </div>
      <header>Item Details</header>
    </div>

    <form action="" method="post">
      <div class="form-group">
        <label for="title">Title: </label><br>
        <input type="text" value= "<?=$todo["title"]?>"autocomplete="off" id="title" name="title"></input>
      </div>

      <div class="form-group">
        <label for="note">Note:</label><br>
        <textarea style="height: 80px" type="text" autocomplete="off" id="note" name="note" placeholder="<?=$todo["note"]?>"><?=$todo["note"]?></textarea>
      </div>

      <input type="hidden" name="id" value="<?=$todo["id"]?>">

      <div class="footer">
        <button type="submit" name="update">Update</button>
      </div>
    </form>
  </div>
</body>