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

?>
    <!-- 登録情報の記入 -->
    <form action="06-2. register confirm.php" method="post">
    <div class="register">
            <fieldset>
                <legend>商品登録<br>
                    <label>カテゴリー：
                        <select name="category" id="category">
                            <option value="default" selected>カテゴリーを選択</option>
                            <option value="supplements">001_supplements</option>
                            <option value="clothes">002_clothes</option>
                            <option value="equipment">003_equipment</option>
                            <option value="books">004_books</option>
                        </select>
                    </label><br>
                    <label>商品番号：<br>
                        <div class="productName" style="display:flex;">
                            <input type="text"name="category_num" id="category_num" style="width:50px; height:21px; border:solid 1px black;"></input>
                            <p style="padding:0 15px; height=21px; line-height:21px">-</p> 
                            <input type="text" name="product_num" id="product_num" placeholder="6桁の数字を記入してください" style="width:200px">
                        </div>
                    </label><br>
                    <label>商品名：
                        <input type="test" name="product_name">
                    </label><br>
                    <label>発注閾値：
                        <input type="text" name="threshold" id="threshold">
                    </label><br>
                </legend>
                <input type="submit" value="送信" id="submit">
            </fieldset>
        </div>
    </form>

<script>
    // <!-- カテゴリーを選択すると、カテゴリー番号が自動で入力される -->
    function category_num(a){
        // $("#category_num").empty();
        let b = ("000" + a).slice( -3 );
        $("#category_num").empty();
        $("#category_num").append(b);
        $('[name="category_num"]').val([b]);
    }

    $("#category").change(function (){
        let val =$(this).val();
        switch (val){
            case "supplements":
                category_num(001);
                // console.log(category_num.val())
                break;
            case "clothes":
                category_num(002);
                // console.log(category_num.val())                
                break;
            case "equipment":
                category_num(003);
                // console.log(category_num.val())                
                break;
            case "books":
                category_num(004);
                // console.log(category_num.val())                
                break;
        }
    })


    $("#submit").on("click", function(){
    // <!-- 登録ボタン押下時にカテゴリーが未選択の場合、「カテゴリーを選択してください」とアラートを出す -->
        if($("#category").val()=="default"){
            alert("カテゴリーを選択してください");
            return false;
        }
    // <!-- 登録ボタン押下時にどれか1つでも記入されていない場合は「全ての項目を記入してください」とアラートを出す -->
        else if($("#product_num").val()=="" || $("#product_name").val()=="" || $("#threshold").val()==""){
            alert("全ての項目を記入してください");
            return false;
        }
    // <!-- 登録ボタン押下時に商品番号と発注閾値に数字が入力されていない場合は、「商品番号と発注閾値には数字を入力してください」とアラートを出す -->
        else if(isNaN($("#product_num").val()) || isNaN($("#threshold").val())){
            console.log($("#product_num").val());
            console.log($("#threshold").val());
            alert("商品番号と発注閾値には数字を入力してください");
            return false;
        }
    // 商品番号が6桁でない場合は「商品番号は6桁の数字を記入してください」とアラートを出す
        else if($("#product_num").val().toString().length!=6){
            console.log($("#product_num").val().toString().length);
            alert("商品番号は6桁の数字を記入してください");
            return false;
        }
    })





</script>

</body>
</html>