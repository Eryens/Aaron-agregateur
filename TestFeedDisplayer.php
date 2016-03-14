<?php

require_once 'FeedBuilder.php';
require_once 'FeedDisplayer.php';
require_once 'YoutubeUrlAdapter.php';

$feed1 = buildFeed('http://www.gamekult.com/feeds/actu.html');
$feed2 = buildFeed('http://lorem-rss.herokuapp.com/feed?unit=minute&interval=30');

$displayer = new FeedDisplayer();
$displayer->add($feed1);
//$displayer->add($feed2);
//$displayer->add(buildFeed(getYoutubeChannelFeed('https://www.youtube.com/user/shofu')));

$displayer->displayAll();
