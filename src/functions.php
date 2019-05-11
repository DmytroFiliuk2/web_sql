<?php

include_once('dbConnect.php');

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
            $tagsFilterArr [] = " tag.name = :tag{$index} ";
            $arr[":tag{$index}"] = $tag;
        }
        $tagsFilter = implode("OR", $tagsFilterArr);

    }
    if (isset($paramsMap['searchBY'])) {
        $arr[':searchBY'] = "%{$paramsMap['searchBY']}%";
        $searchFFilter = " WHERE   book.name like :searchBY AND ";
    }
    if (isset($paramsMap['order'])) {
        $arr[':order'] = $paramsMap['order'];
        $orderFFilter = "order by :order";
    }


    if (isset($paramsMap['tags'])) {
        if (isset($paramsMap['tags']) && count($paramsMap['tags']) > 1) {
            $tagsFilter = '(' . $tagsFilter . ')';

        }
        $sqlPattern1 = "
        SELECT book.name as book_name, tag.name as tag_name FROM book
        INNER JOIN book_tag ON book.book_id=book_tag.book_id 
        INNER JOIN tag ON book_tag.tag_id=tag.tag_id  {$searchFFilter} {$tagsFilter} 
        {$orderFFilter};";

        $q = $dbCon->prepare($sqlPattern1);
        foreach ($arr as $key => $value) {
            $q->bindValue($key, $value, PDO::PARAM_STR);
        }
        $result=$q->execute();
        var_dump($arr);
        return $q;

    } else {

        if (isset($paramsMap['searchBY'])) {
            $searchFFilter = str_replace('AND', '', $searchFFilter);
        }
        $sqlPattern2 = "
     SELECT book.* FROM book {$searchFFilter} 
        {$orderFFilter};";
        $q = $dbCon->prepare($sqlPattern2);
        foreach ($arr as $key => $value) {
            $q->bindValue($key, $value, PDO::PARAM_STR);
        }
        $result = $q->execute();
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
        if (in_array($value, unserialize($_COOKIE["tags"]))) {
            return "checked = 'checked'";
        }
    }
}


function getTagsArr(PDO $dbConn)
{
    $tagsQuery = $dbConn->query('SELECT name FROM books.tag');
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
