<!DOCTYPE html>
<html lang="ja">
  <head>
    <title>PHPテスト</title>
  </head>
  <body>
    <?php
      $db_user = "sample";
      $db_pass = "password";
      $db_host = "localhost";
      $db_name = "sampledb";
      $db_type = "mysql";

      $dsn = "$db_type:host=$db_host;dbname=$db_name;charset=utf8";

      try {
        $pdo = new PDO($dsn,$db_user,$db_pass);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
        print "接続しました...<br>";
      } catch(PDOException $Exception) {
        die('エラー：'.$Exception->getMessage());
      }

      try {
        $pdo->beginTransaction();
        $sql = "INSERT INTO member (last_name,first_name) VALUES (:last_name,:first_name)";
        $stmh = $pdo->prepare($sql);
        $stmh->bindValue(':last_name',$_POST['last_name'],PDO::PARAM_STR);
        $stmh->bindValue(':first_name',$_POST['first_name'],PDO::PARAM_STR);
        $stmh->execute();
        $pdo->commit();
        print "データを".$stmh->rowCount(). "件、挿入しました";
      } catch(PDOException $Exception){
        $pdo->rollBack();
        print "エラー：".$Exception->getMessage();
      }
    ?>
  </body>
</html>