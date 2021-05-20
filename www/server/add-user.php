<?php
    include 'functions.php';

    echo 'Starting session.<br>';

    session_start();

    $pdo = makePDOConnection();

    $canCreateUser = false;
    $id = mt_rand(10000000, 999999999);
    $hashedPassword = "";
    if (!isset($_POST) || empty($_POST)) {
        header('Location: ../client/index.php');
    }

    if (
        ($_POST['email'] == $_POST['repeatEmail']) &&
        ($_POST['password'] == $_POST['repeatPassword']) &&
        ($_POST['gender'] == "m" || $_POST['gender'] == "f" || $_POST['gender'] == "o")
    ) {
        $canCreateUser = true;
        $password = $_POST['password'];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    }

    $newUser = [$_POST['gender'], $_POST['last'].', '.$_POST['first'], $_POST['email'], $hashedPassword, $_POST['street'].' '.$_POST['houseNr'], $_POST['zip'], $_POST['city'], $_POST['country'], $_POST['birthdate'], $_POST['phoneNr']];
    $companyName = "";
    $date = date('Y-m-d h:i:s');

    if (isset($_POST['company']) && !empty($_POST['company'])) {
        $companyName = $_POST['company'];
    }

    if ($canCreateUser) {
        $sql = 'INSERT INTO users (id, gender, name, email, password, address, zip, city, country, company_name, birth_date, phonenr, created_date) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)';
        $pdo->prepare($sql)->execute([$id, $newUser[0], $newUser[1], $newUser[2], $newUser[3], $newUser[4], $newUser[5], $newUser[6], $newUser[7], $companyName, $newUser[8], $newUser[9], $date]);
        $sql = 'INSERT INTO sessions (id, users_id, created_date) values (?,?,?)';
        $sessions_id = mt_rand(10000000, 999999999);
        $pdo->prepare($sql)->execute([$sessions_id, $id, $date]);
        $_SESSION['session_id'] = $sessions_id;
        header('Location: ../client/return.php?returnCode=0&from='.$_POST['from']);
    }