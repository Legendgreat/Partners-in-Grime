<?php
    include '../server/functions.php';
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

        img {
            margin: 3px;
            border: 1px solid black;
            border-radius: 3px;
            padding: 15px;
            width: 85px;
            height: 85px;
            object-fit: contain;
        }

        img:hover {
            border: 3px solid blue;
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
            <span>Your order has been placed!</span>
            <p>Thank you for shopping with us.</p>
            <p><a>Click here</a> to see your invoice.</p>
        </div>
    </main>
    <footer>
        <span>Partners in Grime   2020 - 2021</span>
    </footer>
</div>
</body>
</html>