<?php

function getYoutubeChannelFeed($url) {
    $pathElements = explode('/', parse_url($url)['path']);
    if ($pathElements[1] == 'channel') {
        return 'https://www.youtube.com/feeds/videos.xml?channel_id=' . $pathElements[2];
    }
    elseif ($pathElements[1] == 'user') {
        return 'https://www.youtube.com/feeds/videos.xml?user=' . $pathElements[2];
    }
    else {
        return null;
    }
}

function getEmbedUrl($url) {
    /* Returns the part v=... */
    $pathElements = explode('=', parse_url($url)['query']);
    $videoId = $pathElements[1];
    return 'https://www.youtube.com/embed/' . $videoId;
}
