<?php
header('Content-type: application/json');
header('Content-type: text/html; charset=UTF-8');
require_once('../../controlers/controler.php');
$cont=new Controler();
$all=$cont->get_all_recettes();
$data=array();
array_push($data,$all);
array_push($data,$cont->get_recettes_of_fete(1));
array_push($data,$cont->get_recettes_of_fete(2));
array_push($data,$cont->get_recettes_of_fete(3));
array_push($data,$cont->get_recettes_of_fete(4));
array_push($data,$cont->get_recettes_of_fete(5));
print_r( json_encode($data));
?>