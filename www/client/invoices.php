<?php
include '../server/functions.php';

$pdo = makePDOConnection();

$sql = '
    SELECT invoices.id, invoices.created_date
    FROM invoices
    INNER JOIN sessions
    ON invoices.users_id = sessions.users_id
    WHERE sessions.id = ?;
';
$stm = $pdo->prepare($sql);
$stm->execute([$_COOKIE['session_id']]);
$invoices = $stm->fetchAll();

$sql = '
    SELECT users.name, users.address, users.zip, users.city, users.country, users.phonenr
    FROM users
    INNER JOIN sessions
    ON users.id = sessions.users_id
    WHERE sessions.id = ?;
';
$stm = $pdo->prepare($sql);
$stm->execute([$_COOKIE['session_id']]);
$userInformation = $stm->fetch();

$sql = '
    SELECT ordered_products.invoice_id, ordered_products.product_id, ordered_products.amount, ordered_products.price, products.name, products.description, products.images
    FROM ordered_products
    INNER JOIN products
    ON ordered_products.product_id = products.id
    INNER JOIN invoices
    ON ordered_products.invoice_id = invoices.id
    INNER JOIN sessions
    ON invoices.users_id = sessions.users_id
    WHERE sessions.id = ?;
';
$stm = $pdo->prepare($sql);
$stm->execute([$_COOKIE['session_id']]);
$orderedItems = $stm->fetchAll();

$invoiceList = '<p>No invoices found.</p>';
$shippingCost = 2;
$taxPercentage = 2;

if (count($invoices) != 0) {
    $invoiceList = '';
    $invoiceCount = 0;
    foreach ($invoices as $i) {
        $totalPrice = 0;
        $invoiceList .= '
            <div class="dropdown" id="i'.$invoiceCount.'">
                <div class="dropdownHeader" onclick="dropdownToggle('.$invoiceCount.')">
                    <p>Invoice #'.$i['id'].'<i>Placed on: '.$i['created_date'].'</i><span class="arrow up"></span></p>
                </div>
                <div class="dropdownContent disabled">
                    <div class="userInformation">
                        <p>'.$userInformation['name'].'</p>
                        <p>'.$userInformation['address'].'</p>
                        <p>'.$userInformation['city'].' '.$userInformation['zip'].'</p>
                        <p>'.$userInformation['phonenr'].'</p>
                    </div>
                    <div class="productHeader">
                        <span>Product</span>
                        <span>Description</span>
                        <span>Price</span>
                    </div>
        ';
        foreach ($orderedItems as $item) {
            if ($item['invoice_id'] == $i['id']) {
                $img = $imgArray = explode(";", $item["images"])[0];
                $totalPrice += $item['price'];
                if (fmod($item['price'], 1) == 0) {
                    $item['price'] = $item['price'] . ',-';
                }

                $item['price'] = str_replace('.', ',', strval($item['price']));
                $invoiceList .= '
                    <div class="productList">
                        <div class="listingItem" onclick="">
                            <div class="productArea">
                                <img src="../../img/product-img/'.  $img .'.png" alt="X">
                                <span class="name">' . $item['name'] . '</span>
                            </div>
                            <div class="descriptionArea">
                                <p style="margin: 5px;">' . $item['description'] . '</p>
                            </div>
                            <div class="priceArea"><span class="price">£'.$item['price'].'</span></div>
                        </div>
                    </div>
                ';
            }
        }

        $totalPrice += $shippingCost;

        if (fmod($totalPrice, 1) == 0) {
            $totalPrice = $totalPrice . ',-';
        }

        $totalPrice = str_replace('.', ',', strval($totalPrice));

        $invoiceList .= '
                    <div class="totalPriceContainer">
                        <span class="shippingText">Shipping: </span>
                        <span class="shipping">£'.$shippingCost.',-</span><br>
                        <span class="taxText">Tax: </span>
                        <span class="tax">'.$taxPercentage.'%</span><br>
                        <span class="totalPriceText">Total: </span>
                        <span class="totalPrice">£'.$totalPrice.'</span>
                    </div>
                </div>
            </div>
        ';
        $invoiceCount++;
    }
}
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
            margin-left: 25%;
            margin-right: 25%;
        }
        .invoiceList {
            margin-bottom: 20px;
        }
        .dropdown {
            border-bottom: solid black 1px;
            position: relative;
        }
        .dropdownHeader {
            font-size: 2rem;
            font-family: Roboto Light, serif;
            margin-left: 5px;
        }
        .dropdownHeader>p {
            margin: 0;
            padding: 12px 0;
        }
        .dropdownHeader>p>i {
            position: absolute;
            right: 80px;
        }
        .arrow {
            border: solid black;
            border-width: 0 3px 3px 0;
            display: inline-block;
            padding: 3px;
            width: 8px;
            height: 8px;
            position: absolute;
            right: 20px;
            margin: 0;
        }
        .up {
            top: 27px;
            transform: rotate(-135deg);
            -webkit-transform: rotate(-135deg);
        }
        .down {
            top: 18px;
            transform: rotate(45deg);
            -webkit-transform: rotate(45deg);
        }
        .enabled {
            display: block;
        }
        .disabled {
            display: none;
        }
        .dropdownContent {
            position: relative;
            min-height: 150px;
        }
        .userInformation {
            position: absolute;
            left: 15px;
            bottom: 10px;
            text-align: center;
        }
        .userInformation>p {
            margin: 5px;
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
        .productArea {
            position: relative;
            margin-bottom: 0;
        }
        .productArea>img {
            object-fit: contain;
            height: 80px;
            width: 80px;
            border: 1px solid black;
            background-color: white;
            border-radius: 5px;
            margin-left: 5px;
        }
        .name {
            position: absolute;
            top: 7px;
            left: 95px;
        }
        .price {
            grid-area: a;
            font-size: 2rem;
            justify-self: center;
            align-self: center;
        }
        .totalPriceContainer {
            position: relative;
            height: 120px;
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
                font-size: 1.5rem;
            }
            .name {
                top: 0;
                left: 70px;
                font-size: 0.9rem;
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
        }
    </style>
    <script src="../../js/script.js"></script>
</head>
<body>
<div id="page-container">
    <?= displayNav() ?>
    <script>
        selectedNavElement(6);
    </script>
    <header>
        <a href="javascript:void(0)" class="openAsideButton" onclick="openAside()"> > </a>
        <div class="headerText">Partners in Grime</div>
        <a href="javascript:void(0)" class="openSidebarButton" onclick="openNav()"> < </a>
    </header>
    <?= displayAside() ?>
    <script>
        selectedAsideElement(2);
    </script>
    <main>
        <div class="productTicker"></div>
        <div class="invoiceList">
            <?= $invoiceList ?>
        </div>
    </main>
    <footer>
        <span>Partners in Grime   2020 - 2021</span>
    </footer>
</div>
</body>
</html>