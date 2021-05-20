<?php
include 'functions.php';

echo 'Starting session.<br>';

session_start();

$pdo = makePDOConnection();

$canModifyUser = false;

if ($_POST['email'] == $_POST['repeatEmail']) {
    $canModifyUser = true;
}

$newUser = [$_POST['gender'], $_POST['last'].', '.$_POST['first'], $_POST['email'], $_POST['address'], $_POST['zip'], $_POST['city'], $_POST['country'], $_POST['birthdate'], $_POST['phoneNr']];
$companyName = "";
$date = date('Y-m-d h:i:s');

if (isset($_POST['company']) && !empty($_POST['company'])) {
    $companyName = $_POST['company'];
}

if ($canModifyUser) {
    $sql = '
        UPDATE users
        INNER JOIN sessions
        ON users.id = sessions.users_id
        SET gender = ?, name = ?, email = ?, address = ?, zip = ?, city = ?, country = ?, company_name = ?, birth_date = ?, phonenr = ?
        WHERE sessions.id = ?;
    ';
    $pdo->prepare($sql)->execute([$newUser[0], $newUser[1], $newUser[2], $newUser[3], $newUser[4], $newUser[5], $newUser[6], $companyName, $newUser[7], $newUser[8], $_COOKIE['session_id']]);
    header('Location: ../client/return.php?returnCode=3');
}