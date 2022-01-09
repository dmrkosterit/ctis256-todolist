<?php
include_once "./DBSetup/db.php";
session_start();
$usertype=$_SESSION["usertype"];

extract($_GET);

$sql = "select * from to_do where listid = $listId";
$rs = $db->query($sql);
$todos = $rs->fetchAll(PDO::FETCH_ASSOC);
var_dump($todos);


foreach ($todos as $todo) : ?>
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
              ?>
            >
          </form>
          <div>
            <a class='title' style="margin-left:10px;" id='listItem' href=''><?= $todo["title"] ?> </a>
            <p id='detail'></p>
          </div>            
            <?php 
            if($usertype!=0){
            ?>
             <a class='fa fa-edit' style="font-size:18px;margin-left:15px;color:green;margin-top:13px;" type='button' href='tododetail.php?toDoId=<?= $todo["id"] ?>' ></a>
             <a class='fa fa-trash-o' id='deleteButton' style="font-size:18px;margin-left:15px;color:red;margin-top:12px;" type='button'  onclick='deleteListItem(<?= $todo["id"] ?>)'></a>
            <?php 
            }
           ?>
        </li>
<?php endforeach ?>
