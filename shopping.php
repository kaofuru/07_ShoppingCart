<?php
require "component.php";

session_start();

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
        <h1>Hand Made Pottery</h1>
        <strong class="h6 text-danger"><a href="cart.php" class="text-danger">買い物カゴ</a>には、
            <?php
                if( isset($_SESSION["cart"]) && count($_SESSION["cart"])>0){
                    echo count($_SESSION["cart"]);
                    echo "商品カゴが入っています。";
                }else{
                    echo "空です。";
                }


            ?>
    
    
    
        </strong>

        <div class="row">
            <?php
            for ($i = 0; $i < 4; $i++) {
            ?>
                <div class="col-md-3">
                    <?php
                    echo "<img src='" . $product[$i]["img"] . "' class= 'img-fluid rounded'>";
                    echo "<h3>" . $product[$i]["product_name"] . "</h3>";
                    echo "<span class ='text-danger'>" . number_format($product[$i]["price"]) . "円</span>";
                    ?>

                    <form action="cart.php" class="mt-3" method="post">
                        <input type="hidden" name="product_name" value="<?= $product[$i]["product_name"] ?>">
                        <select name="num">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>

                        </select>
                        <button type="submit" class="btn btn-primary">カゴに入れる</button>
                    </form>
                </div>
            <?php
            }
            ?>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </div>
</body>

</html>