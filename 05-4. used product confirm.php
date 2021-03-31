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
    $_SESSION['category'] = $_POST['category'];
    $_SESSION['productName'] = $_POST['product_name'];
    $_SESSION['total_amount'] = $_POST['total_amount'];
    $_SESSION['shop_amount'] = $_POST['shop_amount'];
    $_SESSION['warehouse_amount'] = $_POST['warehouse_amount'];
    $_SESSION['waiting_amount'] = $_POST['waiting_amount'];
    $_SESSION['threshold'] = $_POST['threshold'];
    $_SESSION['place'] = $_POST['place'];
    $_SESSION['use_amount'] = $_POST['use_amount'];
    $_SESSION['reason'] = $_POST['reason'];
    $_SESSION['person_in_charge'] = $_POST['person_in_charge'];


    echo $_POST['model_num'];
    echo $_POST['use_amount'];
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
        <td>使用数</td>
        <td><?=$_SESSION['use_amount']?></td>
    </tr>
    <tr>
        <td>対象商品の格納元</td>
        <td><?=$_SESSION['place']?></td>
    </tr>
    <tr>
        <td>使用理由</td>
        <td><?=$_SESSION['reason']?></td>
    </tr>
    <tr>
        <td>担当者</td>
        <td><?=$_SESSION['person_in_charge']?></td>
    </tr>
</table>
<button onclick="location.href='05-5. used product insert.php'">送信</button>

    
</body>
</html>