<?php
    include '../server/functions.php';

    $pdo = makePDOConnection();

    if (!isset($_COOKIE['session_id']) || empty($_COOKIE['session_id'])) {
        header ('Location: logged-in-check.php');
    }

    $session_id = $_COOKIE['session_id'];

    $sql = 'SELECT name, address, zip, city, country 
            FROM users 
            INNER JOIN sessions ON  sessions.users_id = users.id
            WHERE sessions.id = '.$session_id;
    $stm = $pdo->query($sql);
    $user = $stm->fetch();
    $user['country'] = getCountry($user['country']);
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
            margin: 40px 20% 0;
            font-family: Roboto, serif;
            min-height: 80vh;
        }

        main div, form {
            padding-bottom: 50px;
            align-self: center;
            justify-self: center;
            text-align: center;
        }

        main span {
            display: block;
            font-size: 1.5em;
            margin-bottom: 10px;
        }

        main a {
            display: inline-block;
            margin-top: 5px;
            padding: 5px 40px;
            background-color: #999999;
            text-decoration: none;
            color: black;
        }

        img {
            margin: 3px;
            border: 1px solid black;
            border-radius: 3px;
            padding: 15px;
            width: 85px;
            height: 85px;
            object-fit: contain;
        }

        .selectedMethod {
            border: 3px solid orange;
        }

        img:hover {
            border: 3px solid blue;
        }
        @media screen and (max-width: 600px) {
            img {
                padding: 12px !important;
                width: 80px !important;
                height: 80px !important;
            }
        }

    </style>
    <script src="../../js/script.js"></script>
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
        <div class="delivery">
            <span>Delivery at this location: </span>
            <?= '
                <p>'.$user["name"].'</p>
                <p>'.$user["address"].'</p>
                <p>'.$user["zip"].' '.$user["city"].' '.$user["country"].'</p>
            ';?>
        </div>
        <div class="deliveredOn">
            <span>Will be delivered on:</span>
            <p><?= date('l F jS Y',time()+86400*2) ?></p>
        </div>
        <div class="payment">
            <span>Choose payment method: </span>
            <div class="paymentOptionList">
                <img class="paymentOption" id="ideal" src="../../img/ideal.png" alt="iDeal" onclick="changePaymentOption(this)">
                <img class="paymentOption" id="creditcard" src="../../img/creditcard.png" alt="Creditcard" onclick="changePaymentOption(this)" style="padding: 15px 2px; width: 111px;">
            </div>
        </div>
        <form class="finalize" method="post" action="../server/finalize-order.php">
            <input type="hidden" id="payment" name="payment" value="">
            <a id="finalizeDisabled" style="display: inline-block; cursor: default"> > Finalize order</a>
            <a id="finalizeEnabled" style="display: none; cursor: pointer; background-color: #54c370" onclick="this.parentElement.submit()"> > Finalize order</a>
        </form>
    </main>
    <footer>
        <span>Partners in Grime   2020 - 2021</span>
    </footer>
</div>
</body>
</html>