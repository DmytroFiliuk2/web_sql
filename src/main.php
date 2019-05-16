<?php
error_reporting(-1);
ini_set('display_errors', 'On');

require_once 'functions.php';
require_once 'DbConnect.php';
include  dirname(dirname(__FILE__))."/config.php";
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
    } elseif ($_GET['price_name'] === 'price') {
        $queryMap['order'] = "book.price";
    }
}
if (isInRequest('tags')) {
    $queryMap['tags'] = $_GET['tags'];
}


$dbInst = DbConnect::getInstance($OptionsMap);
$dbConnection = $dbInst->getConnection();

$paginator = new Paginator($queryMap,$dbConnection,$currentPaginationValue);
if ($paginator->pagesCount <= 1) {
    $paginationInvis = 'style="display: none;';
} else {
    $links = $paginator->pageUrls();
}



