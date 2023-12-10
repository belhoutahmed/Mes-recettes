<?php
header('Content-type: text/html; charset=UTF-8');
require_once('../../controlers/controler.php');
$c= new Controler();
if(!empty($_SESSION)){
    $c->afficher_profil($_GET['id']);
}
?>