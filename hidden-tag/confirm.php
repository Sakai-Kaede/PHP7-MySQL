<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>hidden-tag</title>
</head>
<body>
  確認画面
  <form name="form" method="post" action="view.php">
    <?php
      print "名前：";
      print $_POST["name"];
      print "<br><br>";
      print "本文：<br>";
      print nl2br($_POST["body"],false);
    ?>
    <br>
    <input type="submit" value="確 認">
    <input type="hidden" name="name" value="<?=$_POST["name"]?>">
    <input type="hidden" name="body" value="<?=$_POST["body"]?>">
    <input type="hidden" name="user_id" value="<?=$_POST["user_id"]?>">
  </form>
</body>
</html>