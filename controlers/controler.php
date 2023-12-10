<?php
header('Content-type: text/html; charset=UTF-8');
require_once("../../vues/user/Accueil.php");
require_once("../../vues/user/Details_recette.php");
require_once("../../vues/user/Details_news.php");
require_once("../../vues/user/news.php");
require_once("../../vues/user/Nutrition.php");
require_once("../../vues/user/fetes.php");
require_once("../../vues/user/saison.php");
require_once("../../vues/user/categorie.php");
require_once("../../vues/user/idees_recette.php");
require_once("../../vues/user/login.php");
require_once("../../vues/user/profil.php");
require_once("../../vues/user/healthy.php");
require_once("../../vues/admin/gestion_ingredient.php");
require_once("../../vues/admin/gestion_user.php");
require_once("../../vues/admin/gestion_news.php");
require_once("../../vues/admin/gestion_recette.php");
require_once("../../vues/admin/home.php");
require_once("../../vues/admin/parametres.php");
require_once("../../models/model.php");
class Controler{
    public function afficher_site(){
        $c=new Accueil();
    $c->afficher_site();
    } 
    public function afficher_gestion_ingredient(){
        $c=new gestion_ingredient();
    $c->afficher_gestion_ingredient();
    } 
    public function get_recettes($catid){
        $c= new model();
        $res=$c->get_recettes($catid);
        return $res;
    }
    public function get_news(){
        $c= new model();
        $res=$c->get_news();
        return $res;
    }
    public function get_recette($id){
        $c= new model();
        $res=$c->get_recette($id);
        return $res;
    }
    public function get_etapes($id_recette){
        $c= new model();
        $res=$c->get_etapes($id_recette);
        return $res;
    }
    public function filtre_users($sexe,$valider,$trier){
        $c= new model();
        $res=$c->filtre_users($sexe,$valider,$trier);
        return $res;
    }
    
    
        public function add_user($name,$email,$password,$birthdate,$gender){
            $c= new model();
            $res=$c->add_user($name,$email,$password,$birthdate,$gender);
            return $res;
        }
        public function supprimer_user($id_user){
            $c= new model();
            $c->supprimer_user($id_user);
        }
    public function get_ingredients_recette($id_recette){
        $c= new model();
        $res=$c->get_ingredients_recette($id_recette);
        return $res;
    }
    public function get_ingredients($id){
        $c= new model();
        $res=$c->get_ingredients($id);
        return $res;
    }
    public function get_recettes_idees($ids){
        $c= new model();
        $res=$c->get_recettes_idees($ids);
        return $res;
    }
    
    public function get_calories_recette($id){
        $c= new model();
        $res=$c->get_calories_recette($id);
        return $res;
    }
    public function get_all_ingredients($recherche){
        $c= new model();
        $res=$c->get_all_ingredients($recherche);
        return $res;
    }
    public function get_info_ingredient($id_ingredient){
        $c= new model();
        $res=$c->get_info_ingredient($id_ingredient);
        return $res;
    }
    public function get_new($id_news){
        $c= new model();
        $res=$c->get_new($id_news);
        return $res;
    }
    public function get_saison_of_ingredient($id_ingredient){
        $c= new model();
        $res=$c->get_saison_of_ingredient($id_ingredient);
        return $res;
    }
    public function verifier_preferance($id_user,$id_recette){
        $c= new model();
        $res=$c->verifier_preferance($id_user,$id_recette);
        return $res;
    }
    public function get_all_users(){
        $c= new model();
        $res=$c->get_all_users();
        return $res;
    }
    public function add_note($id_user,$id_recette,$note){
        $c= new model();
        $c->add_note($id_user,$id_recette,$note);
    }
    public function modifier_note($id_user,$id_recette,$note){
        $c= new model();
        $c->modifier_note($id_user,$id_recette,$note);
    }
    public function get_note($id_user,$id_recette){
        $c= new model();
        $res=$c->get_note($id_user,$id_recette);
        return $res;
    }
    public function valider_user($id,$valider){
        $c= new model();
        $c->valider_user($id,$valider);
    }
    
    public function add_preferance($id_user,$id_recette){
        $c= new model();
        $c->add_preferance($id_user,$id_recette);
    }
    public function remove_preferance($id_user,$id_recette){
        $c= new model();
        $c->remove_preferance($id_user,$id_recette);
    }
    public function valider_recette($id_recette,$val){
        $c= new model();
        $c->valider_recette($id_recette,$val);
    }
    public function supprimer_recette($id_recette){
        $c= new model();
        $c->supprimer_recette($id_recette);
    }
    public function get_prefered_recettes($id_user){
        $c= new model();
        $res=$c->get_prefered_recettes($id_user);
        return $res;
    }
    public function add_diapo($id_news,$type){
        $c= new model();
        $c->add_diapo($id_news,$type);
    }
    public function delete_diapo($id_news,$type){
        $c= new model();
        $c->delete_diapo($id_news,$type);
    }
    public function get_new_of_diapo($id,$type){
        $c= new model();
        $res=$c->get_new_of_diapo($id,$type);
        return $res;
    }
    public function get_parametre(){
        $c= new model();
        $res=$c->get_parametre();
        return $res;
    }
    public function change_parametre($value,$index){
        $c= new model();
        $c->change_parametre($value,$index);
    }
    public function get_notation($id_recette){
        $c= new model();
        $res=$c->get_notation($id_recette);
        return $res;
    }
    
    public function get_all_recettes(){
        $c= new model();
        $res=$c->get_all_recettes();
        return $res;
    }
    public function get_diaporama(){
        $c= new model();
        $res=$c->get_diaporama();
        return $res;
    }
    public function get_categorie($id_categorie){
        $c= new model();
        $res=$c->get_categorie($id_categorie);
        return $res;
    }
    public function get_saison_of_recette($id_recette){
        $c= new model();
        $res=$c->get_saison_of_recette($id_recette);
        return $res;
    }
    public function get_recettes_of_saisons($id_saison){
        $c= new model();
        $res=$c->get_recettes_of_saisons($id_saison);
        return $res;
    }
    public function get_user($email,$pass){
        $c= new model();
        $res=$c->get_user($email,$pass);
        return $res;
    }
    public function get_user_info($id){
        $c= new model();
        $res=$c->get_user_info($id);
        return $res;
    }
    public function get_recettes_of_fete($id_fetes){
        $c= new model();
        $res=$c->get_recettes_of_fete($id_fetes);
        return $res;
    }
    public function filtre($categorie,$saison,$trier){
        $c= new model();
        $res=$c->filtre($categorie,$saison,$trier);
        return $res;
    }
    public function get_recettes_news(){
        $c= new model();
        $res=$c->get_recettes_news();
        return $res;
    }
    public function get_recettes_healthy(){
        $c= new model();
        $res=$c->get_recettes_healthy();
        return $res;
    }
    public function get_admin($email,$password){
        $c= new model();
        $res=$c->get_admin($email,$password);
        return $res;
    }
    public function delete_ingredient($id_ingredient){
        $c= new model();
        $c->delete_ingredient($id_ingredient);
    }
    public function add_news($id_recette){
        $c= new model();
        $c->add_news($id_recette);
    }
    public function supprimer_news($id_news){
        $c= new model();
        $c->supprimer_news($id_news);
    }
    public function  ajouter_ingredient($name,$calories,$glucide,$lipides,$minereaux,$vitamines,$saison,$healthy,$proportion){
        $c= new model();
        $c->ajouter_ingredient($name,$calories,$glucide,$lipides,$minereaux,$vitamines,$saison,$healthy,$proportion);
    }
    public function  modifier_ingredient($id,$name,$calories,$glucide,$lipides,$minereaux,$vitamines,$saison,$healthy,$proportion){
        $c= new model();
        $c->modifier_ingredient($id,$name,$calories,$glucide,$lipides,$minereaux,$vitamines,$saison,$healthy,$proportion);
    }
    
   
    
    
    public function afficher_details_news($id_news){
        $c=new Details_news();
        $c->afficher_details_news($id_news);
    }
    public function afficher_profil($id){
        $c=new profil();
        $c->afficher_profil($id);
    }
    public function afficher_details_recette($id){
        $c=new Details_recette();
        $c->afficher_details_recette($id);
    }
    public function afficher_news(){
        $c=new news();
        $c->afficher_news();
    }
    public function afficher_Nutrition(){
        $c=new Nutrition();
        $c->afficher_Nutrition();
    }
    public function afficher_healthy(){
        $c=new healthy();
        $c->afficher_healthy();
    }
    public function afficher_saison(){
        $c=new saison();
        $c->afficher_saison();
    }
    public function afficher_fetes(){
        $c=new fetes();
        $c->afficher_fetes();
    }
    public function afficher_idees_recette(){
        $c=new idees_recette();
        $c->afficher_idees_recette();
    }
    public function afficher_categorie($id_categorie){
        $c=new categorie();
        $c->afficher_categorie($id_categorie);
    }
    public function afficher_login(){
        $c=new login();
        $c->afficher_login();
    }
    public function afficher_home(){
        $c=new home();
        $c->afficher_home();
    }
    public function afficher_gestion_user(){
        $c=new gestion_user();
        $c->afficher_gestion_user();
    }
    public function afficher_gestion_news(){
        $c=new gestion_news();
        $c->afficher_gestion_news();
    }
    public function afficher_gestion_recette(){
        $c=new gestion_recette();
        $c->afficher_gestion_recette();
    }
    public function afficher_parametres(){
        $c=new parametres();
        $c->afficher_parametres();
    }
}
