<?php

require_once 'YoutubeFeed.php';
require_once 'YoutubeUrlAdapter.php';

$reader = new SimpleXMLElement('https://www.youtube.com/feeds/videos.xml?channel_id=UCBwLhCbJYvKtARvYRhkM6Nw', null, true);

foreach ($reader->entry as $entry) {
    /*$media = $entry->children('media', true);
    echo $media->group->description;*/
    //echo $entry->link->attributes()['href'];
}

$feed = new YoutubeFeed('https://www.youtube.com/feeds/videos.xml?channel_id=UCBwLhCbJYvKtARvYRhkM6Nw');

foreach ($feed->getItems() as $item) {
    echo '<h1>' . $item->getTitle() . '</h1><br/>' . "\n";
/*    $thumbnail = $item->getThumbnail();
    echo '<img src="' . $thumbnail->attributes()['url'] . '" height="'. $thumbnail->attributes()['height'] .'" width="'. $thumbnail->attributes()['width'] .'"/>';*/
    echo '<iframe width="560" height="315" src="'. getEmbedUrl($item->getLink()) .'" frameborder="0" allowfullscreen></iframe><br/>' . "\n";
}
