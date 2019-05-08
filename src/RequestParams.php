<?php

error_reporting(-1);
ini_set('display_errors', 'On');
session_start();


if (isset($_POST['searchParam'])) {
    $_SESSION["searchParam"] = $_POST['searchParam'];
}

if (isset($_POST['paginationParam'])) {
    $_SESSION["paginationParam"] = $_POST['paginationParam'];
}

if (isset($_POST['price_name'])) {

    setcookie('price_name', $_POST['price_name'], time() + 3600, '/');
}


if (isset($_POST['tag'])) {
    setcookie('tags', serialize($_POST['tag']), time() + 3600, '/');
} elseif ($_POST['tag'] = NAN && $_POST['submit'] == 'tag') {
    if (isset($_COOKIE['tags'])) {
        unset($_COOKIE['tags']);
        setcookie('tags', '', time() - 3600, '/');
    }

}
header("Location: ../index.php");