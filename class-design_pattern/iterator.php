<?php
  // 関連ファイルを読み込む
  require_once 'memberclass.php';
  require_once 'membersclass.php';

  // ダミーの会員データを読み込む
  $member1 = new Member(1, "姓1", "名1", "email1.example.com", "password1");
  $member2 = new Member(2, "姓2", "名2", "email2.example.com", "password2");
  $member3 = new Member(3, "姓3", "名3", "email3.example.com", "password3");
  $member4 = new Member(4, "姓4", "名4", "email4.example.com", "password4");
  $member5 = new Member(5, "姓5", "名5", "email5.example.com", "password5");

  // Membersクラスに会員データを追加
  $members = new Members;
  $members->add($members1);
  $members->add($members2);
  $members->add($members3);
  $members->add($members4);
  $members->add($members5);
  
  // getIteratorによりイテレータを取得
  $iterator = $members->getIterator();

  // ループ処理
  foreach($iterator as $member){
    print $member->getId() ." ";
    print $member->getLastName() ." ";
    print $member->getFirstName() ." ";
    print $member->getEmail() ." ";
    print $member->getPassword() ."<br>";
  }