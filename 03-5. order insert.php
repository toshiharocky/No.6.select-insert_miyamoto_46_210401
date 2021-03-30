<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>

<h1>登録が完了しました。</h1>
<a href="03-1. order.php">入力画面へ戻る</a>
<a href="01. top page.html">トップページへ戻る</a>


<?php
// <!-- funcs.phpの読み込み -->
    require_once("funcs.php");

// 前ページからの変数の受け取り
    session_start();
    $category = $_SESSION['category'];
    $model_num = $_SESSION['model_num'];
    $productName = $_SESSION['productName'];
    $order = $_SESSION['order'];
    $person_in_charge = $_SESSION['person_in_charge'];

   
//DB接続
try {
    //ID:'root', Password: 'root'
    $pdo = new PDO('mysql:dbname=inventory_management;charset=utf8;host=localhost','root','root');
  } catch (PDOException $e) {
    exit('DBConnectError:'.$e->getMessage());
  }



  

// ①テーブル「total_db」の「waiting_amount」に追加
// 1. SQL文を用意
$stmt = $pdo->prepare(
    "UPDATE total_db SET
        waiting_amount=waiting_amount + :order
        WHERE model_num='$model_num'"
    );

//  2. バインド変数を用意
$stmt->bindValue(':order', $order, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)

//  3. 実行
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("ErrorMessage:". print_r($error, true));
}



// ②テーブル「order_db」に登録
// 1. SQL文を用意
$stmt_02 = $pdo->prepare("INSERT 
    INTO order_db(id, category, model_num, product_name, indate, order_amount, person_in_charge, status, place)
    VALUE (null, :category, :model_num, :product_name, sysdate(), :order, :person_in_charge, :status, null)"
    );

//  2. バインド変数を用意
$stmt_02->bindValue(':category', $category, PDO::PARAM_STR); //****************);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt_02->bindValue(':model_num', $model_num, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt_02->bindValue(':product_name', $productName, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt_02->bindValue(':order', $order, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt_02->bindValue(':person_in_charge', $person_in_charge, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt_02->bindValue(':status', "waiting", PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

//  3. 実行
$status_02 = $stmt_02->execute();

//４．データ登録処理後
if($status_02==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error_02 = $stmt_02->errorInfo();
  exit("ErrorMessage:". print_r($error_02, true));
}


