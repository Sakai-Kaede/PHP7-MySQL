<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <title>PHPテスト</title>
  </head>
  <body>
    <hr>
    会員名簿一覧
    <hr>
    [<a href="form.html">新規作成<a>]
      <br>
      <form name="form1" method="post" action="list.php">
        名前：<input type="text" name="search_key"><input type="submit" value="検索する">
      </form>
      <?php
        require_once(MYDB.php);
        $pdo = db_connect();
        // 削除処理
        if(isset($_GET['action']) && $_GET['action'] == 'delete' && $_GET['id'] > 0){
          try{
            $pdo->beginTransaction();
            $id = $_GET['id'];
            $sql = "DELETE FROM member WHERE id = :id";
            $stmh = $pdo->prepare($sql);
            $stmh->bindValue(':id',$id,PDO_PARAM_INT);
            $stmh->execute();
            $pdo->commit();
            print "データを" .$stmh->rowCount() ."件、削除しました<br>";
          } catch(PDOException $Exception){
            $pdo->rollBack();
            print "エラー：" .$Exception->getMessage();
          }
        }
        // 挿入処理
        if(isset($_GET['action']) && $_GET['action'] == 'insert'){
          try{
            $pdo->beginTransaction();
            $sql = "INSERT INTO member (last_name, first_name) VALUES (:last_name, :first_name)";
            $stmh = $pdo->prepare($sql);
            $stmh->bindValue(':last_name', $_POST['last_name'], PDO::PARAM_STR);
            $stmh->bindValue(':first_name', $_POST['first_name'], PDO::PARAM_STR);
            $stmh->execute();
            $pdo->commit();
            print "データを" .$stmh->rowCount() ."件、挿入しました<br>";
          } catch(PDOException $Exception){
            $pdo->rollBack();
            print "エラー：" .$Exception->getMessage();
          }
        }

        // 更新処理
        if(isset($_POST['action']) && $_POST['action'] == 'update'){
          // セッション変数によりidを受け取る
          $id = $_SESSION['id'];

          try{
            $pdo->beginTransaction();
            $sql = "UPDATE member SET last_name = :last_name, first_name = :first_name WHERE id = :id";
            $stmh = $pdo->prepare($sql);
            $stmh->bindValue(':last_name',$_POST['last_name'], PDO::PARAM_STR);
            $stmh->bindValue(':first_name',$_POST['first_name'],PDO::PARAM_STR);
            $stmh->bindValue(':id',$id,PDO::PARAM_INT);
            $stmh->execute();
            $pdo->commit();
            print "データを" .$stmh->rowCount() ."件、更新しました<br>";
          } catch(PDOException $Exception){
            $pdo->rollBack();
            print "エラー：" .$Exception->getMessage();
          }

          // 使用したセッション変数を削除する
          unset($_SESSION['id']);
        }
      ?>
  </body>
</html>