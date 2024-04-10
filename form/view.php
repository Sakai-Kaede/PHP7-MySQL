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
        // 変数からデータベースに接続する
        $pdo = new PDO($dsn,$db_user,$db_pass);

        // SQL文を安全に設定するためのテンプレート（プリペアドステートメント）
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

        print "接続しました...<br>";
      } catch(PDOException $Exception) {
        die('エラー：'.$Exception->getMessage());
      }

      try {
        // トランザクションを開始
        $pdo->beginTransaction();

        // 外部のデータをプレースホルダを使って置き換える
        $sql = "INSERT INTO member (last_name,first_name) VALUES (:last_name,:first_name)";

        $stmh = $pdo->prepare($sql);

        // プレースホルダと外部の値を結びつけ、データ型を定める
        $stmh->bindValue(':last_name',$_POST['last_name'],PDO::PARAM_STR);
        $stmh->bindValue(':first_name',$_POST['first_name'],PDO::PARAM_STR);

        // 実行する
        $stmh->execute();

        $pdo->commit();
        print "データを".$stmh->rowCount(). "件、挿入しました";
      } catch(PDOException $Exception){

        // 開始したトランザクションを元に戻す
        $pdo->rollBack();

        print "エラー：".$Exception->getMessage();
      }
    ?>
  </body>
</html>