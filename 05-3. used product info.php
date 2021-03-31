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
// 変数の受け取り
    $model_num =$_POST['model_num'];
// 商品名が表示されると、登録されている「商品番号」「在庫総数」「店舗内在庫」「倉庫内在庫」「納品待ち」「発注しきい値」が表示される
    //1.  DB接続します
    try {
        //Password:MAMP='root',XAMPP=''
        $pdo = new PDO('mysql:dbname=inventory_management;charset=utf8;host=localhost','root','root');
    } catch (PDOException $e) {
        exit('DBConnectError'.$e->getMessage());
    }

    //2．データ表示①（$table）
    //２-1．データ取得SQL作成
    $stmt = $pdo->prepare("SELECT * FROM total_db WHERE model_num = '$model_num'");
    $status = $stmt->execute();

    //2-2．データ表示
    $table = "";
    if ($status == false) {
        //execute（SQL実行時にエラーがある場合）
        $error = $stmt->errorInfo();
        exit('ErrorQuery:' . print_r($error, true));
    }else{
        //Selectデータの数だけ自動でループしてくれる
        //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
        while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
            $table .= 
            "<tr>
            <td>$result[model_num]</td>
            <td>$result[product_name]</td>
            </tr>";
        }

    }

    //3．データ表示②（$info）
    //3-1．データ取得SQL作成
    $stmt = $pdo->prepare("SELECT * FROM total_db WHERE model_num = '$model_num'");
    $status = $stmt->execute();

    //3-2．データ表示②（$info）
    $info = "";
    if ($status == false) {
        //execute（SQL実行時にエラーがある場合）
        $error = $stmt->errorInfo();
        exit('ErrorQuery:' . print_r($error, true));
    }else{
        //Selectデータの数だけ自動でループしてくれる
        //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
        while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
            $info .= 
            "
            <table>
                <tr>
                    <td>在庫総数</td>
                    <td>$result[total_amount]</td>
                </tr>
                <tr>
                    <td>店舗内在庫</td>
                    <td>$result[shop_amount]</td>
                </tr>
                <tr>
                    <td>倉庫内在庫</td>
                    <td>$result[warehouse_amount]</td>
                </tr>
            </table>
            ";

            $sent .= "<input type='hidden' name='total_amount' id='total_amount' value='$result[total_amount]'>
            <input type='hidden' name='shop_amount' id='shop_amount' value='$result[shop_amount]'>
            <input type='hidden' name='warehouse_amount' id='warehouse_amount' value='$result[warehouse_amount]'>
            <input type='hidden' name='waiting_amount' id='waiting_amount' value='$result[waiting_amount]'>
            <input type='hidden' name='threshold' id='threshold' value='$result[threshold]'>
            <input type='hidden' name='category' id='category' value='$result[category]'>
            <input type='hidden' name='model_num' id='model_num' value='$result[model_num]'>
            <input type='hidden' name='product_name' id='product_name' value='$result[product_name]'>";
        }

    }

?>

<!-- 登録情報の記入 -->

<div class="register">
        <fieldset>
            <legend>商品情報修正<br>
                <table>
                    <tr>
                        <th>商品ID</th>
                        <th>商品名</th>
                    </tr>
                    <?=$table?>
                </table>
                <?=$info?>
            </legend>
        </fieldset>
</div>

<form action="05-4. used product confirm.php" method="post">
    格納元：
    <select name="place" id="place">
        <option value="selected" selected>使用した商品の格納元を選択</option>
        <option value="店舗">shop</option>
        <option value="倉庫">warehouse</option>
    </select><br>
    個数：<input type="text" name="use_amount" id="use_amount"><br>
    理由：
    <select name="reason" id="reason">
        <option value="selected" selected>使用理由を選択</option>
        <option value="販売">販売</option>
        <option value="紛失">紛失</option>
        <option value="破損">破損</option>
        <option value="その他">その他</option>
    </select><br>
    担当者：<input type="text" name="person_in_charge" id="person_in_charge"><br>
    <?=$sent?>
    <input type="submit" value="送信" id="submit">
</form>



<script>
    
    $("#submit").on("click", function(){
        // console.log(shop);
    // <!-- 登録ボタン押下時にどれか1つでも記入されていない場合は「全ての項目を記入してください」とアラートを出す -->
        if($("#place").val()=="selected" || $("#use_amount").val()=="" || $("#reason").val()=="selected" || $("#person_in_charge").val()==""){
            alert("全ての項目を記入・登録してください");
            return false;
        }
    // <!-- 登録ボタン押下時に使用個数に数字が入力されていない場合は、「使用個数には数字を入力してください」とアラートを出す -->
        else if(isNaN($("#use_amount").val())){
            alert("使用個数には数字を入力してください");
            return false;
        }
    })

</script>

</body>
</html>