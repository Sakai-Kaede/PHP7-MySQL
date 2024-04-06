<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>確認画面</title>
</head>
<body>
  <?php
    print $_POST["name"]."さんからのメッセージ";
    print "<br><br>";
    print "本文：<br>";
    print nl2br($_POST["body"],false);
  ?>
</body>
</html>