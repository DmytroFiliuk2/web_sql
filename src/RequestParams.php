<?php

error_reporting(-1);
ini_set('display_errors', 'On');

if (isset($_GET['price_name'])) {

    if ($_GET['price_name'] === 'name') {
        setcookie('price_name', $_GET['price_name'], time() + 3600, '/');
    } elseif ($_GET['price_name'] === 'price') {
        setcookie('price_name', $_GET['price_name'], time() + 3600, '/');
    }


}
if (isset($_GET['tags'])) {
    setcookie('tags', json_encode($_GET['tags']), time() + 3600, '/');
} elseif ($_GET['tags'] = NAN ) {
    if (isset($_COOKIE['tags'])) {
        unset($_COOKIE['tags']);
        setcookie('tags', '', time() - 3600, '/');
    }

}

header("Location: ../index.php?{$_SERVER['QUERY_STRING']}");