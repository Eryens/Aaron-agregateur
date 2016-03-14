<?php
require_once 'DAO.php';
require_once 'utils.inc.php';

$dao = DAO::getInstance();

if (isset($_POST['register'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($dao->CreateUser($username, $password, $email)) {
        setConnectedSession($email, $username);

        header('refresh:3; url=TestMultipleFeed.php');
        echo 'Inscription reussie, redirection dans 3 sec...';
    }
    else {
        echo 'tg';
    }
}

include 'views/signin.php';