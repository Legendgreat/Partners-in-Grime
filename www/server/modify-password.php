<?php
include 'functions.php';

echo 'Starting session.<br>';

session_start();

$pdo = makePDOConnection();

$canModifyPassword = false;

$sql = '
    SELECT password
    FROM users
    INNER JOIN sessions
    ON users.id = sessions.users_id
    WHERE sessions.id = ?;
';
$stm = $pdo->prepare($sql);
$stm->execute([$_COOKIE['session_id']]);
$user = $stm->fetch(PDO::FETCH_ASSOC);

if (password_verify($_POST['current'], $user['password'])) {
    if ($_POST['new'] == $_POST['repeatNew']) {
        $canModifyPassword = true;
    } else {
        header('Location: ../client/change-password.php?returnCode=2');
    }
} else {
    header('Location: ../client/change-password.php?returnCode=1');
}

if ($canModifyPassword) {
    $sql = '
        UPDATE users
        INNER JOIN sessions
        ON users.id = sessions.users_id
        SET password = ?
        WHERE sessions.id = ?;
    ';
    $pdo->prepare($sql)->execute([password_hash($_POST['new'], PASSWORD_DEFAULT), $_COOKIE['session_id']]);
    logOutUser();
    header('Location: ../client/return.php?returnCode=4');
}