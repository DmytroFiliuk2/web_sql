<?php

include_once('dbConnect.php');

function getQuery($searchFFilter = '', $orderFFilter = '', $tagsFilter = '')
{

    $pattern = "
        SELECT  book.book_name, book.price,book.ISBN, book.url, book.poster ,
               GROUP_CONCAT(tag.tag_name) AS tags
        FROM book
            LEFT JOIN book_tag
                ON book.book_id = book_tag.book_id
            LEFT JOIN tag
                ON book_tag.tag_id = tag.tag_id
                {$searchFFilter}   {$tagsFilter}
        GROUP BY book.book_name , book.price,book.ISBN , book.url , book.poster
       {$orderFFilter}
        ";

    return $pattern;
}

function getBooks(PDO $dbCon, $paramsMap)
{
    $searchFFilter = '';
    $orderFFilter = "";
    $tagsFilterArr = [];
    $tagsFilter = "";
    $result = NAN;
    $arr = [];

    if (isset($paramsMap['tags'])) {

        foreach ($paramsMap['tags'] as $index => $tag) {
            $tagsFilterArr [] = " tag.tag_name = :tag{$index} ";
            $arr[":tag{$index}"] = $tag;
        }
        $tagsFilter = implode("OR", $tagsFilterArr);

    }
    if (isset($paramsMap['searchBY'])) {
        $arr[':searchBY'] = "%{$paramsMap['searchBY']}%";
        $searchFFilter = " WHERE  book.book_name like :searchBY and ";
    }
    if (isset($paramsMap['order'])) {
        $arr[':order'] = $paramsMap['order'];
        $orderFFilter = "ORDER BY :order";
    }

    if (isset($paramsMap['tags'])) {
        if (isset($paramsMap['tags']) && count($paramsMap['tags']) > 1) {
            $tagsFilter = '(' . $tagsFilter . ')';

        }
        $query = getQuery($searchFFilter, $orderFFilter, $tagsFilter);
        var_dump($query);


        $result = $dbCon->prepare($query);
        foreach ($arr as $key => $value) {
            $result->bindValue($key, $value, PDO::PARAM_STR);
        }
        $result->execute();
        var_dump($arr);
        return $result;

    } else {

        if (isset($paramsMap['searchBY'])) {
            $searchFFilter = str_replace('and', '', $searchFFilter);
        }

        $query = getQuery($searchFFilter, $orderFFilter, $tagsFilter);
        var_dump($query);
        $result = $dbCon->prepare($query);
        foreach ($arr as $key => $value) {
            $result->bindValue($key, $value);
        }
        $result->execute();
        var_dump($arr);
        return $result;

    }
}


function checkOrderCookies($value)
{
    if (isset($_COOKIE["price_name"])) {
        if ($_COOKIE["price_name"] === $value) {
            return "checked = 'checked'";
        }
    }
}


function checkTagCookies($value)
{

    if (isset($_COOKIE["tags"])) {

        if (strpos($_COOKIE["tags"], $value)!=false) {
            return "checked = 'checked'";
        }
    }
}


function getTagsArr(PDO $dbConn)
{
    $tagsQuery = $dbConn->query('SELECT tag.tag_name FROM books.tag');
    $tagsArr = $tagsQuery->fetchAll();

    return $tagsArr;
}

//function searchByName($partOfName, array $books): array
//{
//    if ($partOfName === '') {
//        return $books;
//    }
//    $namesList = [];
//    foreach ($books as $singleBook) {
//        if (stristr($singleBook['name'], $partOfName) !== false) {
//            $namesList[] = $singleBook;
//        }
//    }
//
//
//    return $namesList;
//
//}

#$paramsMap = ['order' => 'book.name', 'searchBY' => 'sql','tags' => ['php', 'sql']];
//$paramsMap = ['searchBY' => '', 'tags' => ['php', 'mysql']];
//$fuf = getBooks($dbh, $paramsMap);
//$c = $fuf->fetchAll();
//foreach ($c as $d) {
//    print_r($d);
//
//}
//["book_id"]=>
//    string(1) "1"
//["book_name"]=>
//    string(58) "Learning PHP, MySQL & JavaScript: With jQuery, CSS & HTML5"
//["last_update"]=>
//    string(19) "2006-02-15 04:46:27"
//["ISBN"]=>
//    string(10) "1491978910"
//["poster"]=>
//    string(88) "https://images-na.ssl-images-amazon.com/images/I/51aUTzDIxxL._SX379_BO1,204,203,200_.jpg"
//["url"]=>
//    string(77) "https://www.amazon.com/Learning-PHP-MySQL-JavaScript-Javascript/dp/1491978910"
//["price"]=>
//    string(5) "31.15"
//["book_tag_id"]=>
//    string(1) "3"
//["tag_id"]=>
//    string(1) "3"
//["tag_name"]=>