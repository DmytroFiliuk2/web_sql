<?php


namespace src;


class Paginator
{
    private $dataCollection;
    private $pagesCount;
    public $currentPage;
    private $itemsPerPage;
    public $nextPage;
    public $previousPage;


    public function __construct($dataCollection, int $itemsPerPage)
    {
        $this->dataCollection = $dataCollection;
        $this->pagesCount = ceil(count($dataCollection) / $itemsPerPage) - 1;
        if (!isset($_GET['currentPage'])) {
            $this->currentPage = 0;
            $_GET['currentPage'] = 0;
        } else {

            $this->currentPage = $_GET['currentPage'];

        }
        $this->itemsPerPage = $itemsPerPage;
        if ($this->currentPage < $this->pagesCount) {
            $this->nextPage = $this->currentPage + 1;
        } else {
            $this->nextPage = $this->pagesCount;
        }
        if ($this->previousPage > 0) {
            $this->previousPage = $this->currentPage - 1;
        } else {
            $this->previousPage = 0;}
    }

    public function getPageContent()
    {
        $currentData = array_slice($this->dataCollection, $this->currentPage * $this->itemsPerPage,
            $this->itemsPerPage);
        return $currentData;
    }

    public function pageUrls(): array
    {

        $pageIds = [];
        $pageUrls = [];
        for ($id = 0; $id <= $this->pagesCount; $id++) {
            $pageUrls[] = "?currentPage={$id}";
        }

        for ($pageId = 0; $pageId < $this->pagesCount; $pageId++) {
            $links [] = $pageId;

        }
        return $pageUrls;
    }


}