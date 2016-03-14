<?php

require_once 'Feed.php';
require_once 'FeedDisplayer.php';
require_once 'YoutubeItem.php';

class YoutubeFeed extends Feed {
    private $url;
    private $reader;
    private $items = array();

    public function __construct($url) {
        $this->url = $url;
        $this->reader = new SimpleXMLElement($url, null, true);

        foreach ($this->reader->entry as $entry) {
            $media = $entry->children('media', true);
            $pubDate = DateTime::createFromFormat(DateTime::W3C, $entry->published);
            $upDate = DateTime::createFromFormat(DateTime::W3C, $entry->updated);

            $this->items[] = new YoutubeItem($entry->title, $media->group->description, $entry->link->attributes()['href'], $entry->author->name
                , $entry->author->uri, $pubDate, $upDate, $media->group->thumbnail);
        }
    }

    public function getItems() {
        return $this->items;
    }

    public function isUpToDate()
    {
        // TODO: Implement isUpToDate() method.
    }

    public function updateDatabase()
    {
        // TODO: Implement updateDatabase() method.
    }

    public function display() {
        displayYoutube($this);
    }
}
