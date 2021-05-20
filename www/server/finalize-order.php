<?php

include 'functions.php';

session_start();

$pdo = makePDOConnection();

$date = date('Y-m-d h:i:s');
$invoice_id = mt_rand(10000000, 999999999);
$user_id = $pdo->query('SELECT users_id FROM sessions WHERE id = '.$_COOKIE['session_id'])->fetch()['users_id'];

$pdo->query('INSERT INTO invoices (id, users_id, created_date) VALUES ('.$invoice_id.', '.$user_id.', \''.$date.'\')');

$stm = $pdo->prepare('INSERT INTO ordered_products (invoice_id, product_id, amount, price) VALUES ('.$invoice_id.', ?, ?, ?)');

foreach ($_SESSION['cart'] as $item) {
    $price = $pdo->query('SELECT price FROM products WHERE id = '.$item[0])->fetch()['price'];
    $stm->execute([$item[0], $item[1], $price]);
}

unset($_SESSION['cart']);

header('Location: ../client/order-placed.php?id='.$invoice_id);