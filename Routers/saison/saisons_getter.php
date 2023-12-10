<?php
header('Content-type: application/json');
header('Content-type: text/html; charset=UTF-8');
require_once('../../controlers/controler.php');
$cont=new Controler();
$all=$cont->get_all_recettes();
$ete=$cont->get_recettes_of_saisons(1);
$printemps=$cont->get_recettes_of_saisons(2);
$hiver=$cont->get_recettes_of_saisons(3);
$automn=$cont->get_recettes_of_saisons(4);
$data=array();
array_push($data,$all);
array_push($data,$ete);
array_push($data,$printemps);
array_push($data,$hiver);
array_push($data,$automn);
print_r( json_encode($data));
?>