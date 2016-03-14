<?php

require_once 'Item.php';
require_once 'DisplayFunctions.php';

class RSSItem extends Item {
    private $content;

    public function __construct($title, $description, $link, $pubDate, $thumbnail = null, $content = '')
    {
        /* Enleve les tags img et br de la description */
        $description = preg_replace('/(<(img|br).*>)+/', '', $description);

        parent::__construct($title, $description, $link, $pubDate, $thumbnail, $content);
        $this->content = $content;
    }

    public function display() {
        displayRSSItem($this);
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }
}
