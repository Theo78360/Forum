<?php
session_start();

define('WEBROOT',dirname(__FILE__));
define('ROOT',dirname(WEBROOT));
define('CORE',ROOT.'/core');
define('BASE_URL',dirname(dirname($_SERVER['SCRIPT_NAME'])));

require CORE."/functions.php";

$bdd = connectBDD();

if(isset($_GET['p']))
{   
    if(file_exists($_GET['p'].".php"))//Verifie si la page demandée existe
        $page = $_GET['p'];
    else//redirection vers page 404
        $page = "404";
}
else{
    $page = "home";
}


ob_start();// arrete l'affichage
    require $page.".php";// recuperation de la page
$content = ob_get_clean();

require "template.php";

?>