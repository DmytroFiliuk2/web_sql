<?php


namespace src;


class Paginator
{
    private $dataCollection;
    private $pagesCount;
    private $currentPage;
    private $itemsPerPage;

    public function __construct($dataCollection, int $itemsPerPage)
    {
        $this->dataCollection = $dataCollection;
        $this->pagesCount = ceil(count($dataCollection) / $itemsPerPage);
        if (!isset($_GET['currentPage'])) {
            $this->currentPage = 0;
            $_GET['currentPage'] = 0;
        } else {

            $this->currentPage = $_GET['currentPage'];

        }
        $this->itemsPerPage = $itemsPerPage;
    }

    public function getPageContent():array
    {
        $currentData = array_slice($this->dataCollection, $this->currentPage * $this->itemsPerPage,
            $this->itemsPerPage);
        return $currentData;
    }

    public function pageIds():array
    {
        $links = [];
        for ($pageId = 0; $pageId < $this->pagesCount; $pageId++) {
            $links [] = $pageId;

        }
        return $links;
    }


}