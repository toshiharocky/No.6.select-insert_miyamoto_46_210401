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
    $_SESSION['model_num'] = $_POST['category_num']."-".$_POST['product_num'];
    $_SESSION['category'] = $_POST['category'];
    $_SESSION['productName'] = $_POST['product_name'];
    $_SESSION['total_amount'] = $_POST['total_amount'];
    $_SESSION['shop_amount'] = $_POST['shop_amount'];
    $_SESSION['warehouse_amount'] = $_POST['warehouse_amount'];
    $_SESSION['waiting_amount'] = $_POST['waiting_amount'];
    $_SESSION['threshold'] = $_POST['threshold'];

    $model_num = $_SESSION['model_num'];
    $category = $_SESSION['category'];
    $productName = $_SESSION['productName'];
    $total_amount = $_SESSION['total_amount'];
    $shop_amount = $_SESSION['shop_amount'];
    $warehouse_amount = $_SESSION['warehouse_amount'];
    $waiting_amount = $_SESSION['waiting_amount'];
    $threshold = $_SESSION['threshold'];
    echo $_SESSION['model_num'];
?>
<!-- // 表形式で数値を記入 -->
<h1>確認画面</h1>    
<table class="">
    <tr>
        <td>商品番号</td>
        <td><?=$model_num?></td>
    </tr>
    <tr>
        <td>カテゴリー</td>
        <td><?=$category?></td>
    </tr>
    <tr>
        <td>商品名</td>
        <td><?=$productName?></td>
    </tr>
    <tr>
        <td>在庫総数</td>
        <td><?=$total_amount?></td>
    </tr>
    <tr>
        <td>店舗内在庫</td>
        <td><?=$shop_amount?></td>
    </tr>
    <tr>
        <td>倉庫内在庫</td>
        <td><?=$warehouse_amount?></td>
    </tr>
    <tr>
        <td>納品待ち</td>
        <td><?=$waiting_amount?></td>
    </tr>
    <tr>
        <td>発注しきい値</td>
        <td><?=$threshold?></td>
    </tr>
</table>
<button onclick="location.href='06-3. register insert.php'">送信</button>

    
</body>
</html>