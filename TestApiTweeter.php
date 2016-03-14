<?php

require 'TwitterAPI/autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;

define ('CONSUMER_KEY', 'eQjPleZGAoAY3NxyAgp2mQ2l7');
define ('CONSUMER_SECRET','PCH4ID95fUJsrZ4Fb3YhjhfxS8FwTqVl0YxDoHjqPLGyXefq6G');

function getConnectionWithAccessToken($oauth_token, $oauth_token_secret) {
    $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);
    return $connection;
}

$connection = getConnectionWithAccessToken('4525072168-osi88mnVff8598VNKQguyqUghNlEnZGvQlvBxQg', 'YvTrIEWW0YVEvLfEIVEc7mWzf87OghzZlgw9LyCNab858');
$content = $connection->get("statuses/home_timeline");

if (isset($content->errors)) {
    foreach ($content->errors as $error) {
        echo 'Error ' . $error->code . ': ' . $error->message . '<br/>';
    }
    exit();
}
foreach ($content as $tweet) {
    foreach ($tweet->entities->urls as $link) {
        $tweet->text = str_replace($link->url, '<a href="' . $link->expanded_url . '">' . $link->display_url . '</a>', $tweet->text);
    }
    if (isset($tweet->entities->media)) {
        foreach ($tweet->entities->media as $media) {
            $tweet->text = str_replace($media->url, '<img src="' . $media->media_url_https . '"/>', $tweet->text);
        }
    }

    echo $tweet->text . '<br/>';
}
