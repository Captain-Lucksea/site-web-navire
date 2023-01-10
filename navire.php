<?php
/*
 * On indique que les chemins des fichiers qu'on inclut
 * seront relatifs au répertoire src.
 */
set_include_path("./src");

/* Inclusion des classes utilisées dans ce fichier */
require_once("Router.php");
require_once("view/View.php");
require_once("model/Ship.php");
require_once("model/ShipBuilder.php");
require_once("model/ShipStorage.php");
require_once("model/ShipStorageStub.php");
require_once("model/ShipStorageFile.php");
require_once("model/ShipStorageMySQL.php");
require_once("lib/ObjectFileDB.php");
require_once("control/Controller.php");
require_once('/users/22005759/private/mysql_config.php');

/*
 * Cette page est simplement le point d'arrivée de l'internaute
 * sur notre site. On se contente de créer un routeur
 * et de lancer son main.
 */
//$storage = new ShipStorageFile("/users/22005759/tmp/ship.txt");
$pdo = new PDO("mysql:host=" . MYSQL_HOST . ";port=" . MYSQL_PORT . ";dbname=" . MYSQL_DB . ";charset=utf8", MYSQL_USER, MYSQL_PASSWORD);
$storage = new ShipStorageMySQL($pdo);
$router = new Router();
$router->main($storage);
?>
