<?php

error_reporting(-1);
ini_set('display_errors', 'On');

function getBindingArr($paramsMap)
{
    $arr = [];
    if (isset($paramsMap['tags'])) {
        foreach ($paramsMap['tags'] as $index => $tag) {
            $arr[":tag{$index}"] = $tag;
        }

    }
    if (isset($paramsMap['searchBY'])) {
        $arr[':searchBY'] = "%{$paramsMap['searchBY']}%";

    }
    return $arr;

}

function getQuery($paramsMap)
{

    $searchFFilter = '';
    $orderFFilter = "";
    $tagsFilterArr = [];
    $tagsFilter = "";


    if (isset($paramsMap['tags'])) {

        foreach ($paramsMap['tags'] as $index => $tag) {
            $tagsFilterArr [] = " tag.tag_name = :tag{$index} ";
        }
        $tagsFilter = implode("OR", $tagsFilterArr);

    }
    if (isset($paramsMap['searchBY'])) {
        $searchFFilter = " WHERE  book.book_name like :searchBY and ";
    }
    if (isset($paramsMap['order'])) {
        $orderFFilter = "ORDER BY  {$paramsMap['order']}" . "\n";
    }

    if (isset($paramsMap['tags'])) {
        if (isset($paramsMap['tags']) && count($paramsMap['tags']) > 1) {
            $tagsFilter = '(' . $tagsFilter . ')';

        }
        $pattern = "
        SELECT book.book_name, 
               book.price,
               book.ISBN, 
               book.url, 
               book.poster,
               GROUP_CONCAT(tag.tag_name) AS tags
        FROM book
            LEFT JOIN book_tag
                ON book.book_id = book_tag.book_id
            LEFT JOIN tag
                ON book_tag.tag_id = tag.tag_id
                {$searchFFilter}   {$tagsFilter}
        GROUP BY book.book_name , book.price,book.ISBN , book.url , book.poster
       {$orderFFilter}" . 'LIMIT :offset,:items';

        return $pattern;
    } else {

        if (isset($paramsMap['searchBY'])) {
            $searchFFilter = str_replace('and', '', $searchFFilter);
        }

        $pattern = "
         SELECT book.book_name, 
                book.price,book.ISBN, 
                book.url, 
                book.poster,
               GROUP_CONCAT(tag.tag_name) AS tags
        FROM book
            LEFT JOIN book_tag
                ON book.book_id = book_tag.book_id
            LEFT JOIN tag
                ON book_tag.tag_id = tag.tag_id
                {$searchFFilter}   {$tagsFilter}
        GROUP BY book.book_name , book.price,book.ISBN , book.url , book.poster
       {$orderFFilter}".'LIMIT :offset,:items';

        return $pattern;
    }

}

function isInRequest($name)
{
    if (isset($_GET[$name]) && $_GET[$name] != "NAN") {
        return true;
    }
    return false;
}

function getBooks($dbCon, $query, $arr, $offset, $items)
{

    $result = $dbCon->prepare($query);

    if ($arr !== 0) {
        foreach ($arr as $key => $value) {
            $result->bindValue($key, $value, PDO::PARAM_STR);
        }
    }
    $result->bindValue(':offset', $offset, PDO::PARAM_INT);
    $result->bindValue(':items', $items, PDO::PARAM_INT);
    $result->execute();

    return $result;

}


function getLen($dbCon, $query, $arr, $offset, $items)
{
    $query = str_replace('SELECT', 'SELECT SQL_CALC_FOUND_ROWS', $query);
    $query = str_replace(':offset', $offset, $query);
    $query = str_replace(':items', $items, $query);

    $kayMap = array_keys($arr);
    $valueMap = array_values($arr);

    foreach ($valueMap as $index => $value) {
        $valueMap[$index] = '"' . $value . '"';
    }
    $query = str_replace($kayMap, $valueMap, $query);
    $dbCon->query($query);
    $counter = $dbCon->query('SELECT FOUND_ROWS()');
    $rowCount = (int)$counter->fetchColumn();

    return $rowCount;

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

        if (strpos($_COOKIE["tags"], $value) != false) {
            return "checked = 'checked'";
        }
    }
}


function getTagsArr(PDO $dbConn)
{
    $tagsQuery = $dbConn->query('SELECT tag.tag_name FROM tag');
    $tagsArr = $tagsQuery->fetchAll(PDO::FETCH_ASSOC);

    return $tagsArr;
}