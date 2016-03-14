<?php

require_once 'constants.inc.php';
require_once 'Feed.php';
require_once 'FeedDisplayer.php';
require_once 'RSSItem.php';
require_once 'lib/DAO.php';

class RSSFeed extends Feed {
    private $url;
    private $dao;
    private $reader;
    private $items = array();

    public function __construct($url) {
        $this->url = $url;

        $this->dao = DAO::getInstance();
        $this->items = $this->dao->getAllNewsOfASource($url);
    }

    public function getItems() {
        return $this->items;
    }

    public function isUpToDate() {
        $this->reader = new SimpleXMLElement($this->url, null, true);
        return $this->reader->channel->item->title == $this->items[0]->getTitle();
    }

    public function itemInDatabase($item) {
        return $this->dao->isNewsInDatabase($item);
    }

    public function updateDatabase() {
        $this->reader = new SimpleXMLElement($this->url, null, true);

        foreach ($this->reader->channel->item as $item) {
            //if ($this->itemInDatabase($item)) break;
            $this->dao->createNews(new RSSItem($item->title, $item->description, $item->link, DateTime::createFromFormat(DateTime::RSS, $item->pubDate), $thumbnail), $this->url);
        }
        $this->items = $this->dao->getAllNewsOfASource($this->url);
    }

    public function display() {
        displayRSS($this);
    }
}
