<?php

require_once 'Item.php';
require_once 'DisplayFunctions.php';
require_once 'YoutubeUrlAdapter.php';

class YoutubeItem extends Item {
    private $authorName;
    private $authorLink;
    private $upDate;

    public function __construct($title, $description, $link, $authorName, $authorLink, $pubDate, $upDate, $thumbnail)
    {
        parent::__construct($title, $description, $link, $pubDate, $thumbnail, null);
        $this->authorName = $authorName;
        $this->authorLink = $authorLink;
        $this->upDate = $upDate;
    }

    public function display() {
        displayYoutubeItem($this);
    }

    /**
     * @return mixed
     */
    public function getAuthorName()
    {
        return $this->authorName;
    }

    /**
     * @return mixed
     */
    public function getAuthorLink()
    {
        return $this->authorLink;
    }

    /**
     * @return mixed
     */
    public function getUpDate()
    {
        return $this->upDate;
    }
}
