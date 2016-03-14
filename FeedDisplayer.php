<?php

class FeedDisplayer {
    private $feeds;
    private $nbFeeds;

    public function __construct() {
        $this->feeds = array();
        $this->nbFeeds = 0;
    }

    public function add($feed) {
        $this->feeds[] = $feed;
        ++$this->nbFeeds;
    }

    public function displayAll() {
        $items = array();
        foreach ($this->feeds as $feed) {
            /* Ajoute les news du feed courant a la fin de l'array items */
            $items = array_merge($items, $feed->getItems());
        }

        /* Si plus de 2 flux ont été ajoutés, il faut trier les news */
        if ($this->nbFeeds >= 2) {
            usort($items, 'Item::compare');
        }

        foreach ($items as $item) {
            $item->display();
        }
    }

}
