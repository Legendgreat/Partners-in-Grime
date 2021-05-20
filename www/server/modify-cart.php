<?php

session_start();

$idArray = explode(',', $_GET['id']);
$amountArray = explode(',', $_GET['amount']);

for ($i = 0; $i < sizeof($idArray); $i++){
    $_SESSION["cart"][$i][0] = $idArray[$i];
    $_SESSION["cart"][$i][1] = $amountArray[$i];
}