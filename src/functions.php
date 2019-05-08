<?php

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


function searchByName($partOfName, array $books): array
{
    if ($partOfName === '') {
        return $books;
    }
    $namesList = [];
    foreach ($books as $singleBook) {
        if (stristr($singleBook['name'], $partOfName) !== false) {
            $namesList[] = $singleBook;
        }
    }


    return $namesList;

}
