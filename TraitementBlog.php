<?php
require_once 'DAO.php';
require_once 'utils.inc.php';
session_start();


/*fonction pour ajouter une publication au blog personnel d'un utilisateur*/
function addPublication ($title, $content, $newsAddress) {
$feed = new News ($title, substr ($content, 0, 20). '...', $link, date( 'c', time()), $content);
$address = 'local' . $_SESSION['email'];  //les sources d'utilisateurs du site sont appellees "localjohncena@hotmail.cool", local etant constant

$dao = DAO::getInstance();
if ($dao->getSource($address) == null) {
    $dao->createSource ($_SESSION['name'], $address, $dao->getUser()[1]);
}
$dao->createNews($feed, $address);
}

/* fonction pour supprimer une publication du blog personnel d'un utilisateur*/
function removePublication ($newsAddress) {
    DAO::getInstance()->removeNews($newsAddress);
}