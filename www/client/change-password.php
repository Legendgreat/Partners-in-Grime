<?php
include '../server/functions.php';

if (!isset($_COOKIE['session_id']) || empty($_COOKIE['session_id'])) {
    header('Location: index.php');
}

$errorString = "";

if (isset($_GET['returnCode']) && !isblank($_GET['returnCode'])) {
    switch ($_GET['returnCode']) {
        case 1:
            $errorString = '
                <p class="error">Current password is incorrect.</p>
            ';
            break;
        case 2:
            $errorString = '
                <p class="error">New password is not same as repeated new password.</p>
            ';
            break;
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
            margin: 0 20%;
            font-family: Roboto, serif;
            min-height: 80vh;
        }
        .formContainer {
            margin: 30px 31%;
        }
        form {
            position: relative;
        }
        label {
            display: inline-block;
            padding-bottom: 8px;
            padding-right: 8px;
        }
        input, select {
            margin-top: 5px;
            margin-bottom: 15px;
            text-align: center;
            font-size: 1em;
        }
        input[type=text]{
            height: 22px;
        }
        select{
            padding: 2px;
            width: 203px;
            height: 28px;
        }
        input[type=date] {
            padding-left: 42px;
            width: 156px;
            height: 26px;
        }
        .submitContainer {
            justify-content: center;
        }
        input[type=submit] {
            display: inline-block;
            width: 100%;
            height: 28px;
            border: none;
            border-radius: 3px;
            background-color: #c0ff9b;
        }
        .shortField>input {
            width: 75px;
        }
        .error {
            padding-left: 10px;
            font-style: italic;
            color: red;
        }
        @media screen and (max-width: 600px) {
            main {
                margin: 0;
            }
            .formContainer {
                margin: 30px 4.8%;
            }
            input {
                margin-bottom: 12px;
                font-size: 0.85em;
            }
            input[type=password]{
                height: 22px;
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
        selectedAsideElement(1);
    </script>
    <main>
        <div class="formContainer">
            <?= $errorString ?>
            <form method="post" action="../server/modify-password.php">
                <label class="inputField">
                    Current password * <br>
                    <input type="password" name="current" required>
                </label><br>
                <label class="inputField">
                    New password * <br>
                    <input type="password" name="new" required>
                </label>
                <label class="inputField">
                    Repeat new password * <br>
                    <input type="password" name="repeatNew" required>
                </label><br>
                <div class="submitContainer">
                    <input type="submit" value="Modify">
                </div>
            </form>
        </div>
    </main>
    <footer>
        <span>Partners in Grime   2020 - 2021</span>
    </footer>
</div>
</body>
</html>