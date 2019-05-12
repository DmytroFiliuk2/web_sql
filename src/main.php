<?php
error_reporting(-1);
ini_set('display_errors', 'On');
session_start();


include_once('dbConnect.php');
include("TagsFilter.php");
include("config.php");
#include("Paginator.php");
require_once "functions.php";

//
//$sql = 'SELECT * FROM books.book';
//$booksQuery = $dbh->prepare($sql);
//
//$booksQuery->bindValue(':name', ' book.* ');
//$booksQuery->execute();
//
//
//while ($value = $booksQuery->fetch(PDO::FETCH_ASSOC)) {
//    var_dump($value);
//}die();

$currentPaginationValue = $defaultPaginationValue;


$queryMap = [];
$queryMap['searchBY'] = '';

if (isset($_SESSION['searchParam'])) {
    $queryMap['searchBY'] = $_SESSION['searchParam'];


}

if (isset($_SESSION['price_name'])) {
    if ($_SESSION['price_name'] == 'name') {
        $queryMap['order'] = "book.book_name";
    }elseif($_SESSION['price_name'] == 'price'){
        $queryMap['order'] = "book.price";
    }



}


if (isset($_SESSION['tags'])) {
    $queryMap['tags'] = $_SESSION['tags'];


}
var_dump($queryMap);

$allContent = getBooks($dbh, $queryMap);
//$allContsdsdsdent = $allContent;
//var_dump($allContsdsdsdent);
//#var_dump($_COOKIE["tags"]);
//var_dump($allContsdsdsdent->fetchAll(PDO::FETCH_ASSOC));

#$paginator = new Paginator($books, $currentPaginationValue);
#$currentPageContent = $paginator->getPageContent();

