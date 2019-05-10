<?php


namespace src;


class TagsFilter
{
    private $data;

    public function __construct( $dataColl)
    {
        $this->data = $dataColl;

    }

    public function getTagsArr()
    {
        $tagsArr = [];
        foreach ($this->data as $book) {
            if (key_exists('tags', $book)) {
                foreach ($book['tags'] as $singleTag) {
                    if (!empty($singleTag)) {
                        $tagsArr [] = $singleTag;
                    }
                }
            }
        }
        return array_unique($tagsArr);
    }

    public function getContent(array $filter)
    {
        $content = [];

        foreach ($this->data as $book) {
            if (!key_exists('tags', $book)) {
                continue;
            }

            if (!array_diff($filter, $book['tags'])) {
                $content [] = $book;
            }

        }


        return $content;
    }

}