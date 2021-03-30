<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>*******</title>
    <!-- css -->
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="inventory.css">
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
<?php
    // <!-- funcs.phpの読み込み -->
        require_once("funcs.php");

    
    // POSTで取得した値を変数に転換
    session_start();
    $_SESSION['model_num'] = $_POST['model_num'];
    $_SESSION['person_in_charge'] = $_POST['person_in_charge'];
    $_SESSION['productName'] = $_POST['product_name'];
    $_SESSION['order'] = $_POST['order'];
    $_SESSION['category'] = $_POST['category'];
    $_SESSION['thres'] = $_POST['thres'];

    echo $_SESSION['model_num'];
    echo $_SESSION['productName'];
    echo $_SESSION['order'];
?>
<!-- // 表形式で数値を記入 -->
<h1>確認画面</h1>    
<table class="">
    <tr>
        <td>商品番号</td>
        <td><?=$_SESSION['model_num']?></td>
    </tr>
    <tr>
        <td>商品名</td>
        <td><?=$_SESSION['productName']?></td>
    </tr>
    <tr>
        <td>発注数</td>
        <td><?=$_SESSION['order']?></td>
    </tr>
    <tr>
        <td>担当者</td>
        <td><?=$_SESSION['person_in_charge']?></td>
    </tr>
</table>
<button onclick="location.href='03-5. order insert.php'">送信</button>

    
</body>
</html>