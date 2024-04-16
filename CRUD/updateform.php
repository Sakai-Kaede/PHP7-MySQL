<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <title>PHPテスト</title>
  </head>
  <body>
    <?php
      require_once("MYDB.php");
      $pdo = db_connect();

      $id = 1;
      $_SESSION['id'] = $id;
      try{
        $sql = "SELECT * FROM member WHERE id = :id";
        $stmh = $pdo->prepare($sql);
        $stmh->bindValue(':id', $id, PDO::PARAM_INT);
        $stmh->execute();
        $count = $stmh->rowCount();
      } catch(PDOException $Exception){
        print "エラー：" .$Exception->getMessage();
      }

      if($count < 1){
        print "更新データがありません<br>";
      } else {
        $row = $stmh->fetch(PDO::FETCH_ASSOC);
      }
    ?>

    <form name="form1" method="post" action="list.php">
      番号：<?=htmlspecialchars($row['id'])?><br>
      氏：<input type="text" name="last_name" value="<?=htmlspecialchars($row['last_name'],ENT_QUOTES)?>"><br>
    </form>
  </body>