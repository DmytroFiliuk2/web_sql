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
    $_SESSION["price_name"] = $_GET['price_name'];
    setcookie('price_name', $_GET['price_name'], time() + 3600, '/');
}


if (isset($_GET['tags']) ) {
    $_SESSION["tags"] = $_GET['tags'];
    setcookie('tags',  json_encode($_GET['tags']), time() + 3600, '/');
} elseif ($_GET['tags'] = NAN && $_GET['submit'] == 'tag') {
    if (isset($_COOKIE['tags'])) {
        unset($_COOKIE['tags']);
        unset($_SESSION['tags']);
        setcookie('tags', '', time() - 3600, '/');
    }

}
header("Location: ../index.php");