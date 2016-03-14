<?php

require_once 'DAO.php';
require_once 'utils.inc.php';

$dao = DAO::getInstance();
session_start();

if (isset($_POST['connect'])) {
    if ($connexionReussie = $dao->Connexion($_POST['email'], $_POST['password'])) {
        setConnectedSession($_POST['email'], $dao->GetUsername($_POST['email'])['USERNAME']);
        header('refresh:2; url=index.php');
    }
}

include 'views/connexion.php';
