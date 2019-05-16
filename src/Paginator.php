<?php


namespace src;


use PDO;

class Paginator
{

    public $pagesCount;
    public $currentPage;
    private $itemsPerPage;
    public $nextPage;
    public $previousPage;
    private $dbConnection;
    private $queryMap;

    public function __construct($queryMap, $dbConnection, $itemsPerPage)
    {
        $booksLen = getLen($dbConnection, getQuery($queryMap), getBindingArr($queryMap), 0, 0);
        $this->pagesCount = ceil($booksLen / $itemsPerPage);
        if (!isset($_GET['currentPage'])) {
            $this->currentPage = 1;
            $_GET['currentPage'] = 1;
        } else {

            $this->currentPage = $_GET['currentPage'];

        }
        $this->itemsPerPage = $itemsPerPage;
        if ($this->currentPage < $this->pagesCount) {
            $this->nextPage = $this->currentPage + 1;
        } else {
            $this->nextPage = $this->pagesCount;
        }
        if ($this->previousPage > 1) {
            $this->previousPage = $this->currentPage - 1;
        } else {
            $this->previousPage = 1;
        }
        $this->queryMap = $queryMap;
        $this->dbConnection = $dbConnection;
    }

    public function getPageContent()
    {
        $currentData = getBooks($this->dbConnection,
            getQuery($this->queryMap),
            getBindingArr($this->queryMap),
            ($this->currentPage * $this->itemsPerPage) - $this->itemsPerPage,
            $this->itemsPerPage
        );
        return $currentData->fetchAll(PDO::FETCH_ASSOC);
    }

    public function pageUrls(): array
    {

        $pageUrls = [];
        for ($id = 1; $id <= $this->pagesCount; $id++) {
            $_GET['currentPage'] = $id;
            $dud = http_build_query($_GET);
            $pageUrls[$id] = '?' . $dud;
        }

        return $pageUrls;
    }


}