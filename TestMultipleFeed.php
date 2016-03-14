<?php
    require_once 'FeedBuilder.php';
    require_once 'FeedDisplayer.php';
    include_once 'YoutubeUrlAdapter.php';
    session_start();
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Multiple</title>
</head>
<body>
    <?php include 'views/logged_in.php'; ?>
    <form action="TestMultipleFeed.php" method="post">
        <button type="submit" name="all">Tous</button><br/>
        <button type="submit" name="action" value="http://www.lefigaro.fr/rss/figaro_actualite-france.xml">Figaro</button><br/>
        <button type="submit" name="action" value="http://www.gamekult.com/feeds/actu.html">Gamekult</button><br/>
        <button type="submit" name="action" value="http://lorem-rss.herokuapp.com/feed?unit=second&interval=10">Test</button><br/>
        <button type="submit" name="action" value="https://www.youtube.com/feeds/videos.xml?channel_id=UCBwLhCbJYvKtARvYRhkM6Nw">Yoshi</button><br/>
        <input type="text" name="url"/><br/>
        <button type="submit" name="customUrl">GO</button>
    </form>
    <?php

    $allFeeds = array('http://www.lefigaro.fr/rss/figaro_actualite-france.xml', 'http://www.gamekult.com/feeds/actu.html', 'http://lorem-rss.herokuapp.com/feed?unit=minute&interval=10');

    if (isset($_POST['action'])) {
        $feed = buildFeed($_POST['action']);

        $feed->display();
    }
    elseif (isset($_POST['customUrl'])) {
        $feed = buildFeed($_POST['url']);

        $feed->display();
    }
    elseif (isset($_POST['all'])) {
        $displayer = new FeedDisplayer();
        foreach ($allFeeds as $feedUrl) {
            $feed = buildFeed($feedUrl);
            $displayer->add($feed);
        }

        $displayer->displayAll();
    }
    else {
        echo 'nope';
    }
    ?>
</body>
</html>
