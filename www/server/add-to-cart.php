<?php
    session_start();
    if (!isset($_SESSION["cart"])){
        $_SESSION["cart"] = [[$_POST["id"], $_POST["amount"]]];
    } else {
        $alreadyExists = false;
        foreach ($_SESSION["cart"] as $key => $product){
            if ($product[0] == $_POST["id"]) {
                $_SESSION["cart"][$key][1] += $_POST["amount"];
                $alreadyExists = true;
                break;
            }
        }
        if (!$alreadyExists) {
            array_push($_SESSION["cart"], [$_POST["id"], $_POST["amount"]]);
        }
    }
