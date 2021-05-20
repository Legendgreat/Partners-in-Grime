<?php
    include 'functions.php';

    $return = logOutUser();

    if ($return) {
        header('Location: ../client/return.php?returnCode=2');
    } else {
        header('Location: ../client/index.php');
    }