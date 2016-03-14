<?php

require_once 'DAO.php';
require_once 'FeedBuilder.php';
require_once 'FeedDisplayer.php';
session_start();

$dao = DAO::getInstance();

if ($_GET['logged']) {
    echo $_GET['email'];
    foreach ($dao->getSubscriptions($_GET['email']) as $sub) {
        var_dump($sub);
    }
}
else {
    echo 'Pas connecté';
}
