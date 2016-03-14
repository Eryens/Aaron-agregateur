<?php

require_once 'Item.php';


class DAO {

    /*
     * @author: Romain ROUX
     *
     * @date: 17/12/2015
     *
     * @brief: Classe bibliotheque gérant la connexion à une base de donnée, ainsi que toutes les méthodes pour insérer ou récupérer des données dans celle-ci
     *
     * Utilisation d'une methode:
     * DAO:getInstance()->uneMethode();
     *
     * Cette classe comporte les methodes suivantes:
     *
     *
     * getInstance()
     *
     * Au premier appel, construit une instance la classe et etablit une connexion par defaut avec une BD dont les renseignements sont fournis sur un fichier config.ini suivant l'architecture ci-dessous, et si une instance de la classe existe deja, revoie vers cette instance (singleton)
     * Structure de config.ini:
     *
     * adresse de la base
     * nom de la base
     * identifiant
     * mot de passe
     *
     * Exemple d'utilisation:
     * getInstance();
     *
     *
     * createUser ($pseudo, $password, $email)
     *
     * Insert un utilisateur dans la BD avec les identifiants passes en parametre
     * Exemple d'utilisation:
     * DAO:getInstance()->createUser (JohnCena, pfeziozefjlifzenlkaze45fe, $D4rkKikooDu13@hotmail.fr);
     *
     *
     * removeUser ($mail)
     *
     * Verifie l'existence de l'use à partir de son mail passee en parametre, et le supprime si c'est le cas.
     * Exemple d'utilisation:
     * DAO:getInstance()->removeUser ('john@cena.doge');
     *
     *
     * connexion($pseudo, $password, $pageSuccess, $pageFailure = null)
     *
     * Identifie un utilisateur en comparant ses identifiants à ceux de la BD
     * Retourne vrai si les identifiants sont les bons et faux si ils sont mauvais
     * Exemples d'utilisation:
     * DAO:getInstance()->connexion(JohnCena, pfeziozefjlifzenlkaze45fe);
     * DAO:getInstance()->connexion(JohnCena, pfeziozefjlifzenlkaze45fe);
     *
     *
     * createSource ($sourceName, $address, $categoryId)
     *
     * Insert une source dans la BD avec les parametres de la fonction. Si l'ID precis de la category cprrespondant a la source n'est pas connu, on peut le remplacer par un string contenant le nom de la category correspondante.
     * Exemple d'utilisation:
     * DAO:getInstance()->createSource ('Danse Avec Les Stars', 'www.danseaveclesstars.rss', '19');
     *
     *
     * removeSource ($sourceAddress)
     *
     * Verifie l'existence de la source à partir de son addresse passee en parametre, et le supprime si c'est le cas.
     * Exemple d'utilisation:
     * DAO:getInstance()->removeSource ('http://www.youtubefeed.cool');
     *
     *
     * createCategory ($categoryName, $categoryDescription, $param)
     *
     * Insert une category dans la BD dont le nom et la description sont passes en parametre de la fonction. $param permet ensuite d'identifier le type de category cree; on distingue 2 cas:
     * 1) On veut creer une category generale:
     *      Indiquer le nom de la category pere (categoryName): une string ou 0 si elle n'a pas de pere (le pere est 0)
     * 2) On veut creer une category privee:
     *      Indiquer l'ID de l'utilisateur (userID) creant la category privee
     * Exemples d'utilisation:
     * DAO:getInstance()->createCategory ('Dance', 'Pour toutes celles et ceux qui veulent swinger!', 'Sport');
     * DAO:getInstance()->createCategory ('Meteo', 'Quel temps fera-t-il demain?', 0);
     * DAO:getInstance()->createCategory ('Famille', 'blog de tonton et chaine YT du petit frere', 45678);
     *
     *
     * removeCategory ($cateogryID)
     *
     * Verifie l'existence de la category à partir de son ID passee en parametre, et la supprime si c'est le cas.
     * Exemple d'utilisation:
     * DAO:getInstance()->removeCategory (69);
     *
     *
     * createNews ($news, $address)
     *
     * Insert une news dans la BD a partir d'une News passee en parametre, ainsi que de son addresse web.
     * Exemple d'utilisation:
     * DAO:getInstance()->createNews (youtube1, 'http://www.youtubefeed.cool');
     *
     *
     * removeNews ($news)
     *
     * Verifie l'existence de la news à partir d'une News (ou alors l'addresse de la news) passee en parametre, et la supprime si c'est le cas, avec tous les medias qui y sont rattaches.
     * Exemple d'utilisation:
     * DAO:getInstance()->removeNews ('http://www.youtubefeed.cool');
     * DAO:getInstance()->removeNews (maNews1);
     *
     *
     * createMedia ($newsAddress, $mediaAddress, $type)
     *
     * Insert un media dans la BD a partir de son addresse web, son type dans une string, ainsi que de l'adresse de la news à laquelle il est rattaché.
     * Exemple d'utilisation:
     * DAO:getInstance()->createNews (youtube1, 'http://www.youtubefeed.cool');
     *
     *
     * removeMedia ($mediaAddress)
     *
     * Verifie l'existence du media à partir de son addresse passee en parametre, et le supprime si c'est le cas.
     * Exemple d'utilisation:
     * DAO:getInstance()->removeMedia ('http://www.youtubefeed.cool');
     *
     *
     * getSubscription ($userAddress)
     *
     * Renvoie toutes les sources auxquelles l'utilisateur (designe par son adresse mail) s'est abonne, triees en fonction de leur categorie.
     * Exemple d'utilisation:
     * echo (DAO:getInstance()->getSubscription ('kevin@noob.fr'));
     *
     *
     * removeSubscription ($usrId, $sourceId)
     *
     * Verifie l'existence de la subscription à partir de son addresse passee en parametre, et la supprime si c'est le cas.
     * Exemple d'utilisation:
     * DAO:getInstance()->removeSubscription (1, 2);
     *
     *
     * getPublicCategories ($userAddress)
     *
     * Renvoie toutes les categories publiques.
     * Exemple d'utilisation:
     * echo (DAO:getInstance()->getPublicCategories ());
     *
     *
     * getCategoriesFromUser ($mail)
     *
     * Renvoie toutes les categories privees d'un utilisateur a partir de son addresse mail.
     * Exemple d'utilisation:
     * echo (DAO:getInstance()->getCategoriesFromUser ('john@cena.cool'));
     *
     *
     * getUsername ($email)
     *
     * Renvoie le nom d'utilisateur correspondant a l'addresse mail donnee en parametre.
     * Exemple d'utilisation:
     * echo (DAO:getInstance()->getUsername (john@cena.com));
     *
     *
     * getSource ($sourceAddress)
     *
     * Renvoie le nom, a l'indice 0, et l'id, a l'indice 1, de la source dont l'adresse est passee en parametre.
     * Exemple d'utilisation:
     * echo (DAO:getInstance()->getSource ('http://www.youtubefeed.cool'));
     *
     *
     * getAllNewsFromSuscriptedSourcesByUser ($mail)
     *
     * Renvoie toutes les news des sources auxquelles un utilisateur s'est abonne.
     * Exemple d'utilisation:
     * echo (DAO:getInstance()->getAllNewsFromSuscriptedSourcesByUser ('john@cena.com'));
     *
     *
     * getAllNewsOfASource ($sourceAddress)
     *
     * Renvoie toutes les news d'une source dont l'adresse est passee en parametre.
     * Exemple d'utilisation:
     * echo (DAO:getInstance()->getAllNewsFromASource ('http://www.youtubefeed.cool'));
     *
     *
     * getAllMediasOfANews ($newsAddress)
     *
     * Revoie tous les media (en premier indice) avec leur addresse (deuxième indice, valeur 0) et leur type (deuxième indice, valeur 1) de la news dont l'addresse est pasee en parametre.
     * Exemple d'utilisation:
     * echo (DAO:getInstance()->getAllMediaOfANews ('http://www.youtubefeed.cool/pictureofjohncena.doge'));
     *
     *
     * isNewsInDatabase ($news)
     *
     * Renvoie vrai si la news (ou alors l'addresse de la news) passee en parametre existe deja, sinon faux.
     * Exemple d'utilisation:
     * echo (DAO:getInstance()->isNewsInDatabase (News1));
     * echo (DAO:getInstance()->isNewsInDatabase ('http://www.youtubefeed.cool'));
     *
     *
     * isSourceInDatabase ($sourceAddress)
     *
     * Renvoie vrai si l'addresse de la source passee en parametre existe deja, sinon faux.
     * Exemple d'utilisation:
     * echo (DAO:getInstance()->isSourceInDatabase ('http://www.youtubefeed.cool'));
     *
     *
     * isUserInDatabase ($mail)
     *
     * Renvoie vrai si l'addresse mail de l'user passee en parametre existe deja, sinon faux.
     * Exemple d'utilisation:
     * echo (DAO:getInstance()->isUserInDatabase ('john@cena.cool'));
     *
     *
     * isCategoryInDatabase ($categoryId)
     *
     * Renvoie vrai si l'ID de la category passee en parametre existe deja, sinon faux.
     * Exemple d'utilisation:
     * echo (DAO:getInstance()->isCategoryInDatabase (42));
     *
     *
     * isMediaInDatabase ($mediaAddress)
     *
     * Renvoie vrai si l'adresse du media passee en parametre existe deja, sinon faux.
     * Exemple d'utilisation:
     * echo (DAO:getInstance()->isMediaInDatabase ('http://www.youtubefeed.cool/picture1'));
     *
     *
     * isSubscriptionInDatabase ($userID, $sourceID)
     *
     * Renvoie vrai si l'userID et la sourceID de l'abbonement passee en parametre existe deja, sinon faux.
     * Exemple d'utilisation:
     * echo (DAO:getInstance()->isSubscriptionInDatabase (6,9));
     *
     */


    //singleton
    private static $instances = array();
    private static $dbLink;


    //singleton
    final private function __construct () {
        $co = $this->readFromFile ();
        self::$dbLink = self::configBD ($co[0], $co[1], $co[2], $co[3]);
    } //__construct


    //singleton
    final public function __clone()
    {
        trigger_error("Le clonage n'est pas autorisé.", E_USER_ERROR);
    } //__clone


    private function readFromFile () {
        return file('lib/config.ini', FILE_IGNORE_NEW_LINES);
    } //readFromFile


    private function configBD ($dbHost, $dbBD, $dbLogin, $dbPass) {
        $dbLink = mysqli_connect($dbHost, $dbLogin, $dbPass)
        or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
        mysqli_select_db($dbLink, $dbBD)
        or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
        return $dbLink;
    } //configConnexion


    private function protectInjection ($string) {
        return mysqli_real_escape_string(self::$dbLink, $string);
    } //protectInjection


    private function selectSourceIdWithSourceAddress ($address) {
        $preQuery = 'SELECT SOURCEID FROM SOURCE';
        $preQuery .= ' WHERE SOURCEADDRESS = \'' . self::protectInjection ($address) . '\'';
        $dbResult = mysqli_query(self::$dbLink, $preQuery);
        return mysqli_fetch_assoc($dbResult)['SOURCEID'];
    } //selectSourceIdWithSourceAddress


    /*
     *
     * METHODES PUBLIQUES
     *
    */


    public function dbQuery ($query) {
        if(!($dbResult = mysqli_query(self::$dbLink, $query))) {
            echo 'Erreur dans requête<br />';
            // Affiche le type d'erreur.
            echo 'Erreur : ' . mysqli_error(self::$dbLink) . '<br/>';
            // Affiche la requête envoyée.
            echo 'Requête : ' . $query . '<br/>';
        }
        return $dbResult;
    } //DBQuery

    public function dbPreparedQuery ($query, $params)
    {
        $stmt = mysqli_prepare(self::$dbLink, $query);
        if (!$stmt) {
            echo 'Erreur dans la préparation : ' . mysqli_error(self::$dbLink);
            return false;
        }
        $params_ref = array();
        foreach ($params as &$p) {
            $params_ref[] = &$p;
        }

        call_user_func_array(array($stmt, 'bind_param'), $params_ref);
        if ($stmt->execute()) {
            return $stmt->get_result();
        } else {
            return false;
        }
    }

    final public static function getInstance() {
        $c = get_called_class();

        if(!isset(self::$instances[$c])) {
            self::$instances[$c] = new $c;
        }
        return self::$instances[$c];
    } //getInstance


    public function connexion ($address, $password) {

        /*déclaration de la requete */

        $query = 'SELECT PASSWORD FROM USER';
        $query .= ' WHERE MAIL = \'' . self::protectInjection ($address) . '\';';

        /*traitement*/

        $dbResult = mysqli_query(self::$dbLink, $query);
        if ($dbResult) {
            $dbRow = mysqli_fetch_assoc($dbResult);

            return (hash('ripemd160', $password) == $dbRow['PASSWORD']);
        }
        else {
            echo 'Erreur : ' . mysqli_error(self::$dbLink) . '<br/>';
            echo 'Requete : ' . $query;
            return null;
        }

    } //connexion


    public function createUser ($pseudo, $password, $email) {

        /*declaration de la requete*/

        $query = 'INSERT INTO USER (USERNAME, PASSWORD, MAIL)';
        $query .= ' VALUES ( ? , ? , ? )';

        /*traitement*/

        self::dbPreparedQuery($query, array('sss', mysqli_real_escape_string(self::$dbLink, $pseudo), hash('ripemd160', $password),  mysqli_real_escape_string(self::$dbLink, $email)));
    } //createUser


    public function removeUser ($mail) {

        if (self::isMediaInDatabase($mail) == true) {

            /*declaration de la requete*/

            $queryMedia = 'DELETE FROM USER';
            $queryMedia .= ' WHERE MAIL = ? ';

            /*traitement*/

            self::dbPreparedQuery($queryMedia, array('s', $mail));
        }
    } //removeUser


    public function createSource ($sourceName, $address, $categoryID) {

        /*preparation*/

        if ( ! is_int($categoryID)) {
            $query = 'SELECT CATEGORYID FROM SOURCE';
            $query .= ' WHERE CATEGORYNAME = ' . self::protectInjection ($categoryID) . ';';
            $dbResult = mysqli_query(self::$dbLink, $query);
            $categoryID = mysqli_fetch_assoc($dbResult);
        }

        /*declaration de la requete*/

        $query = 'INSERT INTO SOURCE (SOURCENAME, SOURCEADDRESS, CATEGORYID)';
        $query .= ' VALUES ( ? , ? , ? )';

        /*traitement*/

        self::dbPreparedQuery($query, array('ssi', $sourceName, $address, $categoryID));
    } //createSource


        public function removeSource ($sourceAddress) {

        if (self::isSourceInDatabase($sourceAddress) == true) {

            /*preparation*/

            $sourceId = self::selectSourceIdFromSourceAddress($sourceAddress);

            /*declaration de la requete*/

            $queryMedia = 'DELETE FROM MEDIA ';
            $queryMedia .= 'WHERE NEWSLINK LIKE (SELECT LINK ';
            $queryMedia .=                      'FROM NEWS ';
            $queryMedia .=                      'WHERE SOURCEID = ?)';

            $queryNews = 'DELETE FROM NEWS ';
            $queryNews .= 'WHERE SOURCEID = ? ';

            $querySource = 'DELETE FROM SOURCE ';
            $querySource .= 'WHERE SOURCEADDRESS = ? ';

            /*traitement*/

            self::dbPreparedQuery($queryNews, array('i', $sourceId));
            self::dbPreparedQuery($queryMedia, array('i', $sourceId));
            self::dbPreparedQuery($querySource, array('s', $sourceAddress));
        }
    } //removeSource


    public function createNews ($news, $address) {

        /*preparation*/

        $sourceID = self::selectSourceIdWithSourceAddress ($address);

        /*declaration de la requete*/

        $query = 'INSERT INTO NEWS (SOURCEID, DATE, LINK, DESCRIPTION, TITLE, CONTENT)';
        $query .= ' VALUES ( ? , ? , ? , ? , ? , ?)';

        /*traitement*/

        self::dbPreparedQuery($query, array('sdssss', $sourceID, $news->getPubDate(), $news->getLink(), $news->getDescription(), $news->getTitle(), $news->getContent()));
    } //createNews


        public function removeNews ($news) {

        if (self::isNewsInDatabase($news) == true) {

            /*declaration de la requete*/

            $queryMedia = 'DELETE FROM MEDIA ';
            $queryMedia .= 'WHERE NEWSLINK = ? ';

            $queryNews = 'DELETE FROM NEWS ';
            $queryNews .= 'WHERE LINK = ? ';

            /*traitement*/


            if (is_string($news)) {
            self::dbPreparedQuery($queryMedia, array('s', $news));
            self::dbPreparedQuery($queryNews, array('s', $news));
            }
            else {
            self::dbPreparedQuery($queryMedia, array('s', $news->link));
            self::dbPreparedQuery($queryNews, array('s', $news->link));

            }
        }
    } //removeNews


    public function createMedia ($newsAddress, $mediaAddress, $type) {

        /*declaration de la requete*/

        $query = 'INSERT INTO MEDIA (NEWSLINK, MEDIAADDRESS, TYPE)';
        $query .= ' VALUES ( ? , ? , ? )';

        /*traitement*/

        self::dbPreparedQuery($query, array('sss', $newsAddress, $mediaAddress, $type));
    } //createMedia


    public function removeMedia ($mediaAddress) {

        if (self::isMediaInDatabase($mediaAddress) == true) {

            /*declaration de la requete*/

            $queryMedia = 'DELETE FROM MEDIA ';
            $queryMedia .= 'WHERE MEDIAADDRESS = ? ';

            /*traitement*/

            self::dbPreparedQuery($queryMedia, array('s', $mediaAddress));
        }
    } //removeMedia


    public function createCategory ($categoryName, $categoryDescription, $param) {

        /*preparation
          $param va definir PEREID et USERID et dont on resout les possibilites ici*/

        if (is_int($param) && $param != 0) {                                //cas d'une categorie privee
            $userID = $param;
            $pereID = 0;
        }
        else if (is_string($param)) {                                       //cas d'une categorie branche publique
            $query = 'SELECT CATEGORYID FROM CATEGORY';
            $query .= ' WHERE CATEGORYNAME = ' . self::protectInjection ($param) . ';';
            $dbResult = mysqli_query(self::$dbLink, $query);
            $pereID = mysqli_fetch_assoc($dbResult);
            $userID = NULL;
        }
        else /*if ($param == 0)*/ {                                        //cas d'une categorie racine publique
            $userID = NULL;
            $pereID = 0;
        }

        /*declaration de la requete*/

        $query = 'INSERT INTO CATEGORY (CATEGORYNAME, CATEGORYDESCRIPTION, PEREID, USERID)';
        $query .= ' VALUES ( ? , ? , ? , ? )';

        /*traitement*/

        self::dbPreparedQuery($query, array('ssii', $categoryName, $categoryDescription, $pereID, $userID));
    } //createCategory


    public function removeCategory ($categoryID) {

        if (self::isCategoryInDatabase($categoryID) == true) {

            /*declaration de la requete*/

            $queryCat = 'DELETE FROM CATEGORY ';
            $queryCat .= 'WHERE CATEGORYID = ? ';

            /*traitement*/

            self::dbPreparedQuery($queryCat, array('s', $categoryID));
        }
    } //removeCategory


    public function createSubscription ($userID, $sourceID) {

        /*declaration de la requete*/

        $query = 'INSERT INTO SUBSCRIPTION (USERID, SOURCEID)';
        $query .= ' VALUES ( ? ,  ? )';

        /*traitement*/

        self::dbPreparedQuery($query, array('ii', $userID, $sourceID));
    } //createCategory


    public function removeSubscription ($userID, $sourceID) {

        if (self::isSubscriptionInDatabase($userID, $sourceID) == true) {

            /*declaration de la requete*/

            $query = 'DELETE FROM SUBSCRIPTION ';
            $query .= 'WHERE USERID = ? ';
            $query .= 'AND SOURCEID = ? ';


            /*traitement*/

            self::dbPreparedQuery($query, array('ss', $userID, $sourceID));
        }
    }


    public function getSubscriptions ($userAddress) {

        /*declaration de la requete*/

        $query = 'SELECT SOURCE.SOURCENAME, SOURCE.SOURCEADDRESS, SOURCE.CATEGORYID';
        $query .= ' FROM SOURCE, SUBSCRIPTION, USER';
        $query .= ' WHERE SOURCE.SOURCEID = SUBSCRIPTION.SOURCEID';
        $query .= '  AND SUBSCRIPTION.USERID = USER.USERID';
        $query .= '  AND USER.USERID IN (SELECT USERID';
        $query .= '                        FROM USER';
        $query .= '                        WHERE MAIL = ?)';

        /*traitement*/

        $result = self::dbPreparedQuery($query, array('s', $userAddress));
        if ($result == null) {
            return null;
        } else{
        return mysqli_fetch_all($result);
        }
    } //getSubscription


    public function getPublicCategories () {

        /*declaration de la requete*/

        $query = 'SELECT CATEGORY.CATEGORYNAME, CATEGORY.CATEGORYDESCRIPTION ';
        $query .= ' FROM CATEGORY ';
        $query .= ' WHERE PEREID <> 0 ';
        $query .= '   AND USERID IS NULL';

        /*traitement*/

        $result = self::dbQuery ($query);
        if ($result == null) {
            return null;
        } else{
        return mysqli_fetch_assoc($result);
        }
    } //GetPublicCategories

    public function getCategoriesFromUser ($mail) {

        /*declaration de la requete*/

        $query = 'SELECT CATEGORY.CATEGORYNAME, CATEGORY.CATEGORYDESCRIPTION ';
        $query .= ' FROM CATEGORY, USER ';
        $query .= ' WHERE CATEGORY.USERID = USER.USERID ';
        $query .= '   AND USER.MAIL = ?';

        $result = self::dbPreparedQuery($query, array('s', $mail));
        if ($result == null) {
            return null;
        } else{
            return mysqli_fetch_all($result);
        }
    } //getCategoriesFromuser


    public function getUsername ($email) {
        $query = 'SELECT USERNAME ';
        $query .= ' FROM USER ';
        $query .= ' WHERE MAIL = ?';

        $result = self::dbPreparedQuery($query, array('s', $email));
        if ($result == null) {
            return null;
        } else{
            return mysqli_fetch_assoc($result);
        }
    } //getUsername


    public function getAllNewsOfASource ($sourceAddress) {

        /*preparation de la requete*/
        $sourceID = $this->selectSourceIdWithSourceAddress ($sourceAddress);

        /* declaration de la requete*/

        $query = 'SELECT TITLE, DESCRIPTION, DATE, LINK, CONTENT ';
        $query .= 'FROM NEWS ';
        $query .= 'WHERE SOURCEID = ?';

        /*traitement*/
        return mysqli_fetch_all(self::dbPreparedQuery($query, array('i', $sourceID)));
    } //getAllNewsOfASource


    public function getAllMediasOfANews ($newsAddress) {

        /* declaration de la requete*/

        $query = 'SELECT MEDIAADRESS, TYPE ';
        $query .= 'FROM MEDIA ';
        $query .= 'WHERE NEWSLINK = ?';

        /*traitement*/

        $result = self::dbPreparedQuery($query, array('s', $newsAddress));
        if ($result == null) {
            return null;
        } else{
            return mysqli_fetch_all($result);
        }
    } //getAllMediasOfANews


    public function getAllNewsFromSuscriptedSourcesByUser ($mail) {

        /* declaration de la requete*/

        $query = 'SELECT NEWS.TITLE, NEWS.DESCRIPTION, NEWS.DATE, NEWS.LINK, NEWS.CONTENT ';
        $query .= 'FROM NEWS, SOURCE, SUBSCRIPTION, USER ';
        $query .= 'WHERE NEWS.SOURCEID = SOURCE.SOURCEID ';
        $query .= ' AND SOURCE.SOURCEID = SUBSCRIPTION.SOURCEID ';
        $query .= ' AND SUBSCRIPTION.USERID = USER.USERID ';
        $query .= ' AND USER.MAIL = ?';

        /*traitement*/
        $result = self::dbPreparedQuery($query, array('s', $mail));
        if ($result == null) {
            return null;
        } else{
            $newsArray = [];
            foreach ($result as $i) {
                $newsArray[] = new News($i[0], $i[1], $i[2], $i[3], $i[4]);
            }
            return $newsArray;
        }
    } //getAllNewsFromSuscriptedSourcesByUser


    public function isUserInDatabase($mail) {

        /* declaration de la requete*/

        $query = 'SELECT USERID ';
        $query .= 'FROM USER ';
        $query .= 'WHERE MAIL = ?';

        /*traitement*/

        $result = self::dbPreparedQuery($query, array('s', $mail));
        return $result->num_rows > 0;
    } //isSourceInDatabase


    public function isNewsInDatabase($news) {

        /* declaration de la requete*/

        $query = 'SELECT NEWSID ';
        $query .= 'FROM NEWS ';
        $query .= 'WHERE LINK = ?';

        /*traitement*/

        if (is_string($news)) {
            $result = self::dbPreparedQuery($query, array('s', $news));
        }
        else {
            $result = self::dbPreparedQuery($query, array('s', $news->link));
        }
        return $result->num_rows > 0;
    } //isNewsInDatabase


    public function isSourceInDatabase($sourceAddress) {

        /* declaration de la requete*/

        $query = 'SELECT SOURCEID ';
        $query .= 'FROM SOURCE ';
        $query .= 'WHERE SOURCEADDRESS = ?';

        /*traitement*/

        $result = self::dbPreparedQuery($query, array('s', $sourceAddress));
        return $result->num_rows > 0;
    } //isSourceInDatabase


    public function isMediaInDatabase($mediaAddress) {

        /* declaration de la requete*/

        $query = 'SELECT NEWSLINK ';
        $query .= 'FROM MEDIA ';
        $query .= 'WHERE SOURCEADDRESS = ?';

        /*traitement*/

        $result = self::dbPreparedQuery($query, array('s', $mediaAddress));
        return $result->num_rows > 0;
    } //isMediaInDatabase


    public function isCategoryInDatabase($categoryID) {

        /* declaration de la requete*/

        $query = 'SELECT USERID ';
        $query .= 'FROM CATEGORY ';
        $query .= 'WHERE CATEGORYID = ?';

        /*traitement*/

        $result = self::dbPreparedQuery($query, array('s', $categoryID));
        return $result->num_rows > 0;
    } //isCategoryInDatabase


    public function isSubscriptionInDatabase($userID, $sourceID) {

        /* declaration de la requete*/


        $query = 'SELECT USERID ';
        $query .= 'FROM SUBSCRIPTION ';
        $query .= 'WHERE USERID = ? ';
        $query .= 'WHERE SOURCEID = ?';

        /*traitement*/

        $result = self::dbPreparedQuery($query, array('ss', $userID, $sourceID));
        return $result->num_rows > 0;
    } //isSubscriptionInDatabase
}
