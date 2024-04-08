<html>
  <head><title>PHP TEST</title></head>
  <body>
    <?php

    try{
      $pdo = new PDO('mysql:host=localhost;dbname=sampledb;charset=utf8','sample','password');
      $pdo->setAttribute(PDO::ATTR_ERRMODE,
                        PDO::ERRMODE_EXCEPTION);
      $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      print 'PDOクラスによる接続に成功';
    } catch(PDOException $Exception) {
      die('接続エラー:'. $Exception->getMessage());
    }
    

    // データベースの操作を行う

    $pdo = null;

    ?>
  </body>
</html>


