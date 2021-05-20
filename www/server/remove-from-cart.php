<?php

session_start();

$productID = $_GET['id'];

foreach ($_SESSION['cart'] as $key => $item) {
    if ($productID == $item[0]) {
        unset($_SESSION['cart'][$key]);
        $_SESSION['cart'] = array_values($_SESSION['cart']);
        break;
    }
}

header('Location: ../client/shopping-cart.php');