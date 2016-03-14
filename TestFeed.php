<?php
require 'RSSFeed.php';

$feed = new RSSFeed('https://twitrss.me/twitter_user_to_rss/?user=kevadamsss');

echo $feed->isFeedUpToDate() ? 'true' : 'false';

foreach ($feed->getItems() as $news) {
    echo '<h1>'. $news->getTitle() .'</h1><br/>' . "\n\t" .
        '<a href="'. $news->getLink() .'">'. $news->getLink() .'</a><br/>' . "\n\t" .
        '<p>'. $news->getDescription() .'</p><br/>' . "\n\t" .
        '<p>'. $news->getPubdate() .'</p><br/>';
}