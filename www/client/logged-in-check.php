<?php
    include '../server/functions.php';

    if(isset($_COOKIE["session_id"]) && !empty($_COOKIE["session_id"])) {
        header ("Location: order-details.php");
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
            display: grid;
            grid-template-areas:
            'a'
            'b';
            min-height: 80vh;
        }
        main div {
            padding: 80px 22%;
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
            padding: 3px 40px;
            background-color: #999999;
            text-decoration: none;
            color: black;
            cursor: pointer;
        }
        .register {
            grid-area: a;
            align-self: end;
            border-bottom: 1px solid black;
            padding: 80px 8%;
        }
        .login {
            grid-area: b;
            align-self: start;
        }
        form>input {
            text-align: center;
            margin: 3px 0;
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
        <div class="register">
            <span>Register new account</span>
            <a href="register.php?from=1">Register</a>
        </div>
        <div class="login">
            <span>Log in existing account</span>
            <form name="loginForm" method="post" action="../server/log-in-user.php">
                <input name="email" type="email" placeholder="Enter e-mail" required><br>
                <input name="password" type="password" placeholder="Enter password" required><br>
                <input name="from" type="hidden" value="1">
                <a onclick="loginForm.submit()">Log in</a>
            </form>
        </div>
    </main>
    <footer>
        <span>Partners in Grime   2020 - 2021</span>
    </footer>
</div>
</body>
</html>