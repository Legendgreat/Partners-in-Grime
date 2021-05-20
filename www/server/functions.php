<?php

function makePDOConnection() {
    $host = "127.0.0.1";
    $db = "partners";
    $user = "root";
    $pass = "QPalzm1029";
    $charset = "utf8mb4";

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
    return $pdo;
}

function displayNav() {
    $loginInfo = '';

    if (!isset($_COOKIE['session_id']) || empty($_COOKIE['session_id'])) {
        $loginInfo = '
            <a href="log-in.php" class="navOption">Log in</a>
            <a href="register.php?from=0" class="navOption" style="border-bottom: none;">Register</a>
        ';
    } else {
        $loginInfo = '
            <a href="my-page.php" class="navOption">My Page</a>
            <a href="../server/log-out.php" class="navOption" style="border-bottom: none;">Log out</a>
        ';
    }
    return '
        <div id="pageShadow" onclick="closeNav(); closeAside();"></div>
        <nav id="nav">
            <a href="javascript:void(0)" class="closeSidebarButton" onclick="closeNav()"> > </a>
            <div class="navOptions">
                <a href="index.php" class="navOption" style="border-top: 2px solid white;">Home</a>
                <a href="shop-landing.php" class="navOption">Store</a>
                <a href="t&t.php" class="navOption">Tips and tricks</a>
            </div>
            <div class="loginOptions">
                <a href="shopping-cart.php" class="navOption">Shopping Cart</a>
                ' .$loginInfo.'
            </div>
        </nav>
    ';
}

function displayAside() {
    return '
        <aside id="aside">
            <a href="javascript:void(0)" class="closeAsideButton" onclick="closeAside()"> < </a>
            <div class="asideOptions">
                <a href="my-page.php" class="asideOption" style="border-top: 2px solid white;">My Page</a>
                <a href="change-password.php" class="asideOption">Change Password</a>
                <a href="invoices.php" class="asideOption">Invoices</a>
            </div>
        </aside>
    ';
}


function getCountry($i) {
    switch ($i) {
        case 'uk':
            return 'United Kingdom';
        case 'nl':
            return 'Netherlands';
    }
    return 'Could not find country from country-code';
}

function isblank($value) {
    return empty($value) && !is_numeric($value);
}

function logOutUser() {
    $pdo = makePDOConnection();

    if (isset($_COOKIE['session_id']) && !empty($_COOKIE['session_id'])) {
        $session_id = $_COOKIE['session_id'];
        $stm = $pdo->prepare('DELETE FROM sessions WHERE id = ?')->execute([$session_id]);
        setcookie('session_id', '', time() - 1, "/");
        return true;
    } else {
        return false;
    }
}