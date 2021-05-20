<?php
    include '../server/functions.php';

    session_start();

    if (!isset($_GET['returnCode']) || isblank($_GET['returnCode'])) {
        header ('Location: index.php');
    }

    $returnString = "";
    $fromString = 'return.php?returnCode=404';

    $day = 86400;
    $duration = 3;

    if (isset ($_GET['from'])) {
        switch (intval($_GET['from'])) {
            case 0:
                $fromString = 'index.php';
                break;
            case 1:
                $fromString = 'order-details.php';
                break;
            default:
                $fromString = 'return.php?returnCode=404';
                break;
        }
    }

    switch (intval($_GET['returnCode'])) {
        case 0:
            $returnString = '
                <div class="returnString">
                    <p>Your account has been created successfully.</p>
                </div>
                <div class="returnString">
                    <p>You will be redirected shortly.</p><p><a href="'.$fromString.'">Click here</a> if this page does not automatically redirect you.</p>
                </div>
            ';
            setcookie("session_id", $_SESSION["session_id"], time()+($day*$duration), '/');
            header ('Refresh: 5; URL='.$fromString);
            break;
        case 1:
            $returnString = '
                <div class="returnString">
                    <p>You have been logged in.</p>
                </div>
                <div class="returnString">
                    <p>You will be redirected shortly.</p><p><a href="'.$fromString.'">Click here</a> if this page does not automatically redirect you.</p>
                </div>
            ';
            setcookie("session_id", $_SESSION["session_id"], time()+($day*$duration), '/');
            header ('Refresh: 5; URL='.$fromString);
            break;
        case 2:
            $returnString = '
                <div class="returnString">
                    <p>You have been logged out.</p>
                </div>
                <div class="returnString">
                    <p>You will be redirected shortly.</p><p><a href="'.$fromString.'">Click here</a> if this page does not automatically redirect you.</p>
                </div>
            ';
            header ('Refresh: 5; URL=index.php');
            break;
        case 3:
            $returnString = '
                <div class="returnString">
                    <p>Your user information has been successfully adjusted.</p>
                </div>
                <div class="returnString">
                    <p>You will be redirected shortly.</p><p><a href="my-page.php">Click here</a> if this page does not automatically redirect you.</p>
                </div>
            ';
            header ('Refresh: 5; URL=my-page.php');
            break;
        case 4:
            $returnString = '
                <div class="returnString">
                    <p>Your password has been changed.</p>
                    <p>Please re-login.</p>
                </div>
                <div class="returnString">
                    <p>You will be redirected shortly.</p><p><a href="log-in.php">Click here</a> if this page does not automatically redirect you.</p>
                </div>
            ';
            header ('Refresh: 5; URL=log-in.php');
            break;
        case 5:
            $returnString = '
                <div class="returnString">
                    <p>You are not authorized to request this invoice.</p>
                </div>
                <div class="returnString">
                    <p>You will be redirected shortly.</p><p><a href="index.php">Click here</a> if this page does not automatically redirect you.</p>
                </div>
            ';
            header ('Refresh: 5; URL=index.php');
            break;
        case 6:
            $returnString = '
                <div class="returnString">
                    <p>You are not logged in.</p>
                    <p>Please log in to request this invoice.</p>
                </div>
                <div class="returnString">
                    <p>You will be redirected shortly.</p><p><a href="log-in.php">Click here</a> if this page does not automatically redirect you.</p>
                </div>
            ';
            header ('Refresh: 5; URL=log-in.php');
            break;
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
            margin: 25px 20%;
            font-family: Roboto, serif;
        }
        .returnContainer {
            text-align: center;
        }
        @media screen and (max-width: 600px) {
            main {
                font-size: 1.1em;
            }
        }
    </style>
    <script src="../../js/script.js"></script>
    <script src="../../js/jquery-3.5.1.js"></script>
</head>
<body>
<div id="page-container">
    <?= displayNav() ?>
    <header>
        <div class="headerText">Partners in Grime</div>
        <a href="javascript:void(0)" class="openSidebarButton" onclick="openNav()"> < </a>
    </header>
    <main>
        <div class="returnContainer">
            <?= $returnString ?>
        </div>
    </main>
    <footer>
        <span>Partners in Grime   2020 - 2021</span>
    </footer>
</div>
</body>
</html>