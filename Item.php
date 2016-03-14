<?php

abstract class Item {
    private $title;
    private $description;
    private $link;
    private $pubDate;
    private $content;
    private $thumbnail;

    public function __construct($title, $description, $link, $pubDate, $thumbnail, $content)
    {
        $this->title = $title;
        $this->description = $description;
        $this->link = $link;
        $this->pubDate = $pubDate;
        $this->content = $content;
        $this->thumbnail = $thumbnail;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @return mixed
     */
    public function getPubDate()
    {
        return $this->pubDate;
    }

    /**
     * @return mixed
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    public static function compare($item1, $item2) {
        if ($item1->getPubDate() == $item2->getPubDate()) {
            return 0;
        }
        return ($item1->getPubDate() < $item2->getPubDate()) ? 1 : -1;
    }
}
