<?php
    include 'functions.php';

    echo 'Starting session.<br>';

    session_start();

    $pdo = makePDOConnection();

    $canCreateSession = false;
    $user_id = '';

    if (!empty($_POST['email']) && !empty($_POST['password'])) {

        $stm = $pdo->prepare('SELECT id, email, password FROM users WHERE email = ?');
        $stm->execute([$_POST['email']]);
        $users = $stm->fetchAll();

        foreach ($users as $user) {
            if (password_verify($_POST['password'], $user['password'])) {
                $canCreateSession = true;
                $user_id = $user['id'];
                break;
            }
        }
    }

    if (isset($_POST['company']) && !empty($_POST['company'])) {
        $companyName = $_POST['company'];
    }

    if ($canCreateSession) {
        echo 'Deleting old sessions';
        $pdo->query('DELETE FROM sessions WHERE users_id = \''.$user_id.'\' AND created_date <= NOW() - INTERVAL 3 DAY');
        $session_id = mt_rand(100000000, 999999999);
        $stm = $pdo->prepare('INSERT INTO sessions (id, users_id, created_date) VALUES (?, ?, ?)');
        $date = date('Y-m-d h:i:s');
        $stm->execute([$session_id, $user_id, $date]);
        $_SESSION['session_id'] = $session_id;
        switch(intval($_POST['from'])) {
            case 0:
                header('Location: ../client/return.php?returnCode=1&from=0');
                break;
            case 1:
                header('Location: ../client/return.php?returnCode=1&from=1');
                break;
        }
    } else {
        switch(intval($_POST['from'])) {
            case 0:
                header('Location: ../client/log-in.php?returnCode=1');
                break;
            case 1:
                header('Location: ../client/logged-in-check.php?returnCode=1');
                break;
        }
    }