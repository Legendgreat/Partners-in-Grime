<?php

session_start();

unset($_SESSION['cart']);

header('Location: ../client/shopping-cart.php');