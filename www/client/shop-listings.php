<?php
include "../server/functions.php";

$pdo = makePDOConnection();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Partners in Grime</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="../../css/style.css">
    <style>
        main {
            margin: 0 20%;
            font-family: Roboto, serif;
        }
        .productHeader {
            display: grid;
            grid-template-columns: 2fr 3fr 1fr;
            padding: 5px 5px;
            font-weight: bold;
            background-color: gray;
        }
        .listingItem {
            display: grid;
            min-height: 80px;
            padding: 10px 5px;
            grid-template-columns: 2fr 3fr 1fr;
            border-bottom: 1px solid black;
        }
        a {
            text-decoration: none;
            color: black;
        }
        .productArea {
            display: grid;
            position: relative;
            grid-template-areas:
            'a b b'
            'a b b'
            'a c c';
        }
        .productArea>img {
            object-fit: contain;
            height: 80px;
            width: 80px;
            border: 1px solid black;
            border-radius: 5px;
            margin-left: 5px;
        }
        .name {
            grid-area: b;
            margin-top: 5px;
            margin-left: -30px;
        }
        .stock {
            grid-area: c;
            align-self: end;
            justify-self: end;
            padding-right: 5px;
        }

        .priceArea {
            display: grid;
            grid-template-areas:
            'a'
            'b';
        }

        .price {
            grid-area: a;
            font-size: 2rem;
            justify-self: center;
            align-self: center;
        }

        .priceArea>.cart {
            grid-area: b
            display: grid;
            grid-template-columns: 1fr 1fr;
            justify-self: center;
            justify-items: center;
        }

        .priceArea>.cart>input {
            width: 35px;
            align-self: center;
        }
        @media screen and (max-width: 600px) {
            main {
                margin: 5px 8px;
            }
            .dropdownHeader {
                font-size: 1.3rem;
                text-align: center;
            }
            .dropdownHeader > p > i {
                position: inherit;
                display: block;
            }
            .listingItem {
                min-height: 60px;
                padding: 10px 5px;
                grid-template-columns: 2fr 3fr 1fr;
                border-bottom: 1px solid black;
            }
            .productArea > img {
                height: 55px;
                width: 55px;
            }
            .price {
                font-size: 1.4rem;
            }
            .name {
                position: absolute;
                top: 0;
                left: 25px;
                font-size: 0.9rem;
            }
            .stock {
                font-size: 0.9rem;
                padding-top: 2px;
                margin-bottom: -2px;
            }
            .shippingText {
                right: 125px;
            }
            .shipping {
                right: 25px;
                font-size: 1.2rem;
            }
            .taxText {
                right: 125px;
                font-size: 1.05rem;
            }
            .tax {
                right: 25px;
                font-size: 1.1rem;
            }
            .totalPriceText {
                right: 125px;
                top: 77px;
                font-size: 1.3rem;
            }
            .totalPrice {
                right: 25px;
                top: 75px;
                font-size: 1.5rem;
            }
            .productArea {
                grid-template-areas:
                'a b b'
                'a b b'
                'c c c';
            }
            .priceArea > .cart > input {
                width: 20px;
            }
            input[type='image'] {
                width: 26px !important;
                margin: 0 0 -5px !important;
            }

        }
    </style>
    <script src="../../js/jquery-3.5.1.js"></script>
    <script src="../../js/script.js"></script>
</head>
<body>
    <div id="page-container">
        <?= displayNav() ?>
        <script>
            selectedNavElement(1);
        </script>
        <header>
            <div class="headerText">Partners in Grime</div>
            <a href="javascript:void(0)" class="openSidebarButton" onclick="openNav()"> < </a>
        </header>
        <main>
            <div class="sortingOptions"></div>
            <div class="productHeader">
                <span>Product</span>
                <span>Description</span>
                <span>Price</span>
            </div>
            <div class="productList">
                <?php
                $category = $_GET["category"];
                $stm = $pdo->query("SELECT *, products_has_categories.categories_id FROM products INNER JOIN products_has_categories ON products.id=products_has_categories.products_id WHERE products_has_categories.categories_id =".$category);
                $i = 0;
                while($row = $stm->fetch())
                {
                    //$testValue = fmod($row["price"], 1);
                    $imgArray = explode(";", $row["images"]);
                    $price = $row["price"];

                    if ($row["stock"] > 0) {
                        $stockString = "<span class='stock' style='color: green;'>◉ In stock</span>";
                        $stockString2 = "
                            <span class='price'>£" . $price ."</span>
                            <div class='cart'>
                                <input type='number' name='amount' value='1' min='1'>
                                <input type='hidden' name='product' value='". $row['id'] ."'>
                                <input type='image' src='../../img/cart.png' alt='Submit' style='margin-bottom: -5px; margin-left: 8px;' onclick='addToCart(".$i.")'>
                            </div>";
                    } else {
                        $stockString = "<span class='stock' style='color: red;'>◉ Not in stock</span>";
                        $stockString2 = "";
                    }

                    if (fmod($price, 1) == 0) {
                        $price = $price . ",-";
                    }

                    $price = str_replace(".", ",", strval($price));

                    //echo $testValue;
                    echo "
                         <div class='listingItem' onclick=''>
                            <a href='product-page.php?id=".$row['id']."'>
                                <div class='productArea'>
                                    <img src='../../img/product-img/". $imgArray[0] .".png' style='grid-area: a;' alt='X'>
                                    <span class='name'>" . $row['name'] . "</span>
                                    " . $stockString . "
                                </div>
                            </a>
                            <a href='product-page.php?id=".$row['id']."'>
                                <div class='descriptionArea'>
                                    <p style='margin: 5px;'>" . $row['description'] . "</p>
                                </div>
                            </a>
                            <div class='priceArea'>".$stockString2."</div>
                         </div>
                    ";
                    ++$i;
                }
                ?>
            </div>
        </main>
        <footer>
            <span>Partners in Grime   2020 - 2021</span>
        </footer>
    </div>
</body>
</html>