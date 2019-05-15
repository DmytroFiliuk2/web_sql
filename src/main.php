<?php
error_reporting(-1);
ini_set('display_errors', 'On');

include 'functions.php';
include 'DbConnect.php';
include 'config.php';
include 'Paginator.php';


use src\Paginator;


$queryMap = [];
$queryMap['searchBY'] = '';


if (isInRequest('searchParam')) {
    $queryMap['searchBY'] = $_GET['searchParam'];
}

if (isset($_GET['paginationParam']) &&
    is_numeric($_GET['paginationParam']) &&
    $_GET['paginationParam'] !== '' &&
    $_GET['paginationParam'] != 0
) {

    $currentPaginationValue = $_GET['paginationParam'];

} else {
    $currentPaginationValue = $defaultPaginationValue;
}
if (isset($_GET['price_name'])) {

    if ($_GET['price_name'] === 'name') {
        $queryMap['order'] = "book.book_name";
        setcookie('price_name', $_GET['price_name'], time() + 3600, '/');
    } elseif ($_GET['price_name'] === 'price') {
        $queryMap['order'] = "book.price";
        setcookie('price_name', $_GET['price_name'], time() + 3600, '/');
    }


}

if (isInRequest('tags')) {
    $queryMap['tags'] = $_GET['tags'];
    setcookie('tags', json_encode($_GET['tags']), time() + 3600, '/');
} elseif ($_GET['tags'] = NAN) {
    if (isset($_COOKIE['tags'])) {
        unset($_COOKIE['tags']);
        setcookie('tags', '', time() - 3600, '/');
    }

}


$dbInst = DbConnect::getInstance($OptionsMap);
$dbConnection = $dbInst->getConnection();
$allContent = getBooks($dbConnection, $queryMap);
$allContent = $allContent->fetchAll(PDO::FETCH_ASSOC);
$paginator = new Paginator($allContent, $currentPaginationValue);
if ($paginator->pagesCount < 1) {
    $paginationInvis = 'style="display: none;';
} else {
    $links = $paginator->pageUrls();
}



