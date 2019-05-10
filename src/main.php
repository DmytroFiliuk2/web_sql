<?php
error_reporting(-1);
ini_set('display_errors', 'On');

session_start();
include_once('dbConnect.php');

include("TagsFilter.php");
include("config.php");
include("Paginator.php");
require_once "functions.php";

$books = $dbh->query('SELECT * from book');
//foreach($books as $b)
//{
//    print_r($b);
//
//}

//var_dump($books);
//die();



#use function searchByName;
use src\Paginator;
use src\TagsFilter;


$currentSearchValue = '';
$currentPaginationValue = $defaultPaginationValue;


if (isset($_SESSION["paginationParam"]) && $_SESSION["paginationParam"] != '') {

    $currentPaginationValue = ($_SESSION["paginationParam"]);
}


$tegFilter = new  TagsFilter($books);

if (isset($_SESSION['searchParam']) && $_SESSION['searchParam'] != '') {
    $currentSearchValue = $_SESSION['searchParam'];
    $books = searchByName($currentSearchValue, $books);

}


if (isset($_COOKIE["price_name"])) {
    $priceNameArray = [];
    foreach ($books as $key => $row) {
        $priceNameArray[$key] = $row[$_COOKIE["price_name"]];
    }
    array_multisort($priceNameArray, SORT_ASC, $books);
}


if (isset($_COOKIE["tags"])) {

    $books = $tegFilter->getContent(unserialize($_COOKIE["tags"]));

}


$paginator = new Paginator($books, $currentPaginationValue);
$currentPageContent = $paginator->getPageContent();

