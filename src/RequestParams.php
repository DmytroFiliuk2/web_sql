<?php

error_reporting(-1);
ini_set('display_errors', 'On');
session_start();


if (isset($_GET['searchParam'])) {
    $_SESSION["searchParam"] = $_GET['searchParam'];
}

if (isset($_POST['paginationParam'])) {
    $_SESSION["paginationParam"] = $_POST['paginationParam'];
}

if (isset($_GET['price_name'])) {

    setcookie('price_name', $_GET['price_name'], time() + 3600, '/');
}


if (isset($_GET['tag'])) {
    setcookie('tags', serialize($_GET['tag']), time() + 3600, '/');
} elseif ($_POST['tag'] = NAN && $_POST['submit'] == 'tag') {
    if (isset($_COOKIE['tags'])) {
        unset($_COOKIE['tags']);
        setcookie('tags', '', time() - 3600, '/');
    }

}
header("Location: ../index.php");