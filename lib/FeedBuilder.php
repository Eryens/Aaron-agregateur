<?php

require_once 'RSSFeed.php';
require_once 'YoutubeFeed.php';

function buildFeed($url) {
    $parsedUrl = parse_url($url);
    if (strpos($parsedUrl['host'], HOST_YOUTUBE) !== false) {
        return new YoutubeFeed($url);
    }
    return new RSSFeed($url);
}
