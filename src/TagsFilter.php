<?php


namespace src;


include_once('dbConnect.php');

class TagsFilter
{
    private $dbConn;

    public function __construct($dbConn)
    {
        $this->dbConn = $dbConn;

    }

    public function getTagsArr()
    {
        $tagsQuery =$this->dbConn->query('SELECT name FROM books.tag');
        $tagsArr = $tagsQuery->fetchAll();

        return $tagsArr;
    }



}