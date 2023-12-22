<?php
require "component.php";

session_start();

if(isset($_SESSION["cart"])){
    $array=$_SESSION["cart"];
    
    if(isset($_POST["product_name"])&& isset($_POST["num"])){
        $array_product_name = array_column($array,"product_name");

        if(in_array($_POST["product_name"] , $array_product_name)){
            $index = array_search($_POST["product_name"], $array_product_name);
            $array[$index]["num"] += $_POST["num"]; 
        }else{
            $array[] = [
                "product_name" =>$_POST["product_name"],
                "num" => $_POST["num"]
            ];
        }
    }
    if( isset($_POST["product_name"]) && !isset($_POST["num"])){
        $array_product_name = array_column($array, "product_name") ;
        if(in_array($_POST["product_name"], $array_product_name)){
            $index = array_search($_POST["product_name"], $array_product_name);
            unset($array[$index]);
            $array = array_values($array);

            }
    }




}else{
    $array[] = [
        "product_name" => $_POST["product_name"],
        "num" => $_POST["num"]
    ];
}

    $_SESSION["cart"] = $array;



?>



<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shopping</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <div class="container text-center">

        <div class="container text-center">
            <h1>Hand Made Pottery</h1>
            <?php
            $gokei=0;
            foreach ($array as $key => $value) {
                echo "<div class='row mt-2'>";
                echo "<div class='col-3'>";
                echo "<h3>" . $value['product_name'] . "</3>";
                echo "<h4>数量:" . $value['num'] . "</h4>";

                $array_product_name = array_column($product, "product_name");
                if (in_array($value['product_name'], $array_product_name)) {
                    $index = array_search($value['product_name'], $array_product_name);
                    echo $index;
                    $price = $product[$index]["price"];
                    $img = $product[$index]["img"];
                    echo "<div><img src= ./" . $img . " class='img-fluid' style='width:120px;hight:auto;'></div>";
                    echo "<div>単価：" . $price . "</div>";
                }



                echo "</div>\n";
                echo "<div class='col-3' style='display:inline-flex;align-items: center;'>";
                ?>
                    <form action="cart.php" class="mt-3" method="post">
                        <input type = "hidden" name = "product_name" value="<?=$value['product_name']?>">
                        <button type="submit" class="btn btn-secondary">削除する</button>
                    </form>

                <?php
                echo "</div>";

                $gokei += $value['num']*$price;
            }
            echo "<div class='h3'>合計金額：".number_format($gokei)."円</div>";

            ?>
            <div><a href="shopping.php" class="h3">買い物を続ける</a></div>

        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </div>
</body>

</html>