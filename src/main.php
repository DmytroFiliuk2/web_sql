<?php
error_reporting(-1);
ini_set('display_errors', 'On');
session_start();


include_once('dbConnect.php');

include("TagsFilter.php");
include("config.php");
#include("Paginator.php");
require_once "functions.php";

#$booksQuery = $dbh->query('SELECT * FROM books.book');


use src\Paginator;


$queryMap['searchBY'] = '';
$currentPaginationValue = $defaultPaginationValue;


$queryMap = [];

if (isset($_SESSION['searchParam'])) {
    $queryMap['searchBY'] = $_SESSION['searchParam'];


}

if (isset($_SESSION['price_name'])) {
    $queryMap['order'] = $_SESSION['price_name'];


}


if (isset($_SESSION['tags'])) {
    $queryMap['tags'] = $_SESSION['tags'];


}
var_dump($queryMap);

$allContent = getBooks($dbh, $queryMap);
var_dump($allContent);
var_dump($allContent->fetchAll());

#$paginator = new Paginator($books, $currentPaginationValue);
#$currentPageContent = $paginator->getPageContent();

