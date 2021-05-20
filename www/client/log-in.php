<?php
    include '../server/functions.php';

    if(isset($_COOKIE["session_id"]) && !empty($_COOKIE["session_id"])) {
        header ("Location: index.php");
    }

    $mainContents = 'Something went wrong, could not load contents.';

    if (!isset($_GET['returnCode']) || isblank($_GET['returnCode'])) {
        $mainContents = '
            <div class="login">
                <span>Log in existing account</span>
                <form name="loginForm" method="post" action="../server/log-in-user.php">
                    <input name="email" type="email" placeholder="Enter e-mail" required><br>
                    <input name="password" type="password" placeholder="Enter password" required><br>
                    <input name="from" type="hidden" value="0">
                    <a onclick="loginForm.submit()">Log in</a>
                </form>
            </div>
        ';
    } else {
        switch ($_GET['returnCode']) {
            case 0:
                $mainContents = '
                    <div class="login">
                        <span>Logged in successfully.</span>
                        <p>Redirecting to homepage.</p>
                    </div>
                ';
                break;
            case 1:
                $mainContents = '
                    <p class="error">E-mail or password is invalid.</p>
                    <div class="login">
                        <span>Log in existing account</span>
                        <form name="loginForm" method="post" action="../server/log-in-user.php">
                            <input name="email" type="email" placeholder="Enter e-mail" required><br>
                            <input name="password" type="password" placeholder="Enter password" required><br>
                            <input name="from" type="hidden" value="0">
                            <a onclick="loginForm.submit()">Log in</a>
                        </form>
                    </div>
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
        main div {
            padding: 30px 22%;
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
            padding: 4px 42px;
            background-color: #54c370;
            text-decoration: none;
            color: black;
            cursor: pointer;
        }
        .login {
            align-self: start;
            justify-self: start;
        }
        .error {
            color: red;
            padding-top: 10px;
            text-align: center;
        }
        form>input {
            text-align: center;
            font-size: 1em;
            margin: 3px 0;
            padding: 3px;
        }
        @media screen and (max-width: 600px) {
            main {
                margin: 0;
            }
            main div {
                padding: 30px 0;
            }
            form>input {
                text-align: center;
                font-size: 1.1em;
                margin: 3px 0;
                padding: 3px;
            }
        }
    </style>
    <script src="../../js/script.js"></script>
</head>
<body>
<div id="page-container">
    <?= displayNav() ?>
    <script>
        selectedNavElement(4);
    </script>
    <header>
        <div class="headerText">Partners in Grime</div>
        <a href="javascript:void(0)" class="openSidebarButton" onclick="openNav()"> < </a>
    </header>
    <main>
        <?= $mainContents ?>
    </main>
    <footer>
        <span>Partners in Grime   2020 - 2021</span>
    </footer>
</div>
</body>
</html>