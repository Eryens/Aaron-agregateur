<?php
    require_once 'FeedBuilder.php';
    require_once 'FeedDisplayer.php';
    require_once 'lib/DAO.php';
    include_once 'YoutubeUrlAdapter.php';
    session_start();

    if (! $_SESSION['logged'])
        header('Location: connexion.php');

    include 'views/logged_in.php';

    $dao = DAO::getInstance();
    $subscriptions = $dao->getSubscriptions($_SESSION['email']);
    $displayer = new FeedDisplayer();

    echo '<form action="index.php" method="get">';
    foreach ($subscriptions as $sub) {
        echo '<button type="submit" name="action" value="'. $sub[1] .'">'. $sub[0] .'</button><br/>';
    }
    echo '</form>';

    if (isset($_GET['action'])) {
        $action = $_GET['action'];

        $feed = buildFeed($action);
        $feed->updateDatabase();
        $displayer->add($feed);
    }

    include 'views/my-rss.php';
