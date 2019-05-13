<?php
error_reporting(-1);
ini_set('display_errors', 'On');
session_start();


include_once('DbConnect.php');
include("TagsFilter.php");
include("config.php");
#include("Paginator.php");
require_once "functions.php";

$currentPaginationValue = $defaultPaginationValue;

#var_dump($dbh);

$queryMap = [];
$queryMap['searchBY'] = '';

if (isset($_SESSION['searchParam'])) {
    $queryMap['searchBY'] = $_SESSION['searchParam'];


}

if (isset($_SESSION['price_name'])) {
    if ($_SESSION['price_name'] == 'name') {
        $queryMap['order'] = "book.book_name";
    } elseif ($_SESSION['price_name'] == 'price') {
        $queryMap['order'] = "book.price";
    }


}


if (isset($_SESSION['tags'])) {
    $queryMap['tags'] = $_SESSION['tags'];


}

$dbInst = DbConnect::getInstance($OptionsMap);
$dbConnection = $dbInst->getConnection();
$allContent = getBooks($dbConnection, $queryMap);


