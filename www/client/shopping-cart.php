<?php
include '../server/functions.php';

session_start();

$pdo = makePDOConnection();

$shippingCost = 2;
$taxPercentage = 2;
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

        .productArea > img {
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

        .priceArea > .cartForm {
            grid-area: b
            display: grid;
            grid-template-columns: 1fr 1fr;
            justify-self: center;
            justify-items: center;
        }

        .priceArea > .cartForm > input {
            width: 35px;
            align-self: center;
        }

        .removeFromCart {
            border: 1px solid black;
            border-radius: 3px;
            padding: 2px 4px;
        }
        .removeFromCart:hover {
            cursor: pointer;
        }
        .totalPriceContainer {
            position: relative;
            height: 120px;
            border-bottom: 1px solid black;
        }
        .shippingText {
            position: absolute;
            right: 185px;
            top: 20px;
            font-size: 1.1rem;
        }
        .shipping {
            position: absolute;
            right: 55px;
            top: 20px;
            font-size: 1.2rem;
        }
        .taxText {
            position: absolute;
            right: 185px;
            top: 50px;
            font-size: 1.05rem;
        }
        .tax {
            position: absolute;
            right: 55px;
            top: 50px;
            font-size: 1.1rem;
        }
        .totalPriceText {
            position: absolute;
            right: 185px;
            top: 75px;
            font-size: 1.5rem;
        }
        .totalPrice {
            position: absolute;
            right: 55px;
            top: 72px;
            font-size: 1.8rem;
        }
        .cartOptions {
            position: relative;
        }
        .cartOptions > a {
            cursor: pointer;
        }

        .emptyCart {
            top: 10px;
            right: 15px;
            position: absolute;
            background-color: #999999;
            border-radius: 3px;
            padding: 4px 6px;
        }

        .modifyCart {
            top: 10px;
            right: 115px;
            position: absolute;
            background-color: #999999;
            border-radius: 3px;
            padding: 4px 6px;
        }

        .checkOut {
            top: 10px;
            right: 115px;
            position: absolute;
            border-radius: 3px;
            padding: 4px 6px;
            background-color: #ababfd;
        }

        .cartIsEmpty {
            margin-top: 15px;
            font-size: 1.5em;
        }
        @media screen and (max-width: 600px) {
            main {
                margin: 5px 10px;
            }
            .dropdownHeader {
                font-size: 1.3rem;
                text-align: center;
            }
            .dropdownHeader>p>i {
                position: inherit;
                display: block;
            }
            .listingItem {
                min-height: 60px;
                padding: 10px 5px;
                grid-template-columns: 2fr 3fr 1fr;
                border-bottom: 1px solid black;
            }
            .productArea>img {
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
            .priceArea > .cartForm > input {
                width: 25px;
            }
        }
    </style>
    <script src="../../js/script.js"></script>
    <script src="../../js/jquery-3.5.1.js"></script>
</head>
<body>
<div id="page-container">
    <?= displayNav() ?>
    <script>
        selectedNavElement(3);
    </script>
    <header>
        <div class="headerText">Partners in Grime</div>
        <a href="javascript:void(0)" class="openSidebarButton" onclick="openNav()"> < </a>
    </header>
    <main>
        <?php
        $cartItems = '';
        $totalPrice = 0.0;
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                $cartItems .= $item[0] . ', ';
            }
            $cartItems = substr($cartItems, 0, -2);
            $stm = $pdo->query('SELECT * FROM products WHERE id IN (' . $cartItems . ')');
            $i = 0;

            echo '
                <div class="productHeader">
                    <span>Product</span>
                    <span>Description</span>
                    <span>Price</span>
                </div>
            ';

            while ($row = $stm->fetch()) {
                //$testValue = $_SESSION["cart"][0];
                $imgArray = explode(';', $row['images']);
                $price = $row['price'];
                $totalPrice += $row['price'];

                if (fmod($price, 1) == 0) {
                    $price = $price . ',-';
                }

                $price = str_replace('.', ',', strval($price));

                $stockString = "<span class='stock' style='color: green;'>◉ In stock</span>";
                $stockString2 = '
                    <span class="price">£' . $price . '</span>
                    <div class="cartForm">
                        <input type="number" name="amount" onclick="modifyCart()" value="' . $_SESSION['cart'][$i][1] . '" min="1">
                        <input type="hidden" name="product" value="' . $row['id'] . '">
                        <a onclick="removeFromCart(' . $i . ')" class="removeFromCart">X</a>
                    </div>
                ';

                //print_r($testValue);
                echo '
                    <div class="listingItem" onclick="">
                        <a href="product-page.php?id='.$row['id'].'">
                            <div class="productArea">
                                <img src="../../img/product-img/'.$imgArray[0].'.png" style="grid-area: a;" alt="X">
                                <span class="name">' . $row['name'] . '</span>
                                '.$stockString.'
                            </div>
                        </a>
                        <a href="product-page.php?id=' . $row['id'] . '">
                            <div class="descriptionArea">
                                <p style="margin: 5px;">' . $row['description'] . '</p>
                            </div>
                        </a>
                        <div class="priceArea">' . $stockString2 . '</div>
                    </div>
                ';
                ++$i;
            }

            $totalPrice += $shippingCost;

            if (fmod($totalPrice, 1) == 0) {
                $totalPrice = $totalPrice . ',-';
            }

            $totalPrice = str_replace('.', ',', strval($totalPrice));

            echo '
                    <div class="totalPriceContainer">
                        <span class="shippingText">Shipping: </span>
                        <span class="shipping">£'.$shippingCost.',-</span><br>
                        <span class="taxText">Tax: </span>
                        <span class="tax">'.$taxPercentage.'%</span><br>
                        <span class="totalPriceText">Total: </span>
                        <span class="totalPrice">£'.$totalPrice.'</span>
                    </div>
                    <div class="cartOptions">
                        <span class="totalPrice"></span>
                        <a href="../server/empty-cart.php" class="emptyCart">Empty Cart</a>
                        <a href="logged-in-check.php" class="checkOut">Checkout</a>
                    </div>
            ';
        } else {
            echo '
                 <div class="cartIsEmpty">
                    Cart is empty.
                 </div>
                ';
        }

        ?>

    </main>
    <footer>
        <span>Partners in Grime   2020 - 2021</span>
    </footer>
</div>
</body>
</html>