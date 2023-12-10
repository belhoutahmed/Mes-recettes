<?php
header('Content-type: text/html; charset=UTF-8');
require_once('../../vues/user/Accueil.php');
require_once('../../controlers/controler.php');
class profil{
    private function afficher_info_user($id){
        $c= new controler();
        $res=$c->get_user_info($id);
        if($res[0]["sexe"]=='M') $sexe="Masculin";
        else $sexe="Féminin";
        $nom=explode(' ',$res[0]["name"])[0];
        $prenom=explode(' ',$res[0]["name"])[1];
        $pswd="";
        for ($i = 0; $i <strlen($res[0]["hash_pwd"]); $i++) {
           $pswd=$pswd."*";
        }
        
       echo '<H2>PROFIL</H2>';
       if(isset($_SESSION["id_user"])){
       echo '<form method="post" action="">
       <input class="log" type="submit" value="Logout" name="logout">
   </form>';
       }
       echo '<div class="info">
           <div class="line_info">
               <div>
               <h5>Nom</h5>
             </div>
             <div>
                <p>'.$nom.'</p>
   </div>
             </div>
               <div class="line_info">
                   <div>
               <h5>Prénom</h5>
             </div>
             <div>
                <p>'.$prenom.'</p>
   </div>
            </div>
               <div class="line_info">
                   <div>
               <h5>Email</h5>
   </div>
   <div>
                <p>'.$res[0]["email"].'</p>
   </div>
              </div>
              <div class="line_info">
                   <div>
               <h5>Date de Naissance</h5>
   </div>
   <div>
                <p>'.$res[0]["date_naissance"].'</p>
   </div>
              </div>
              <div class="line_info">
                   <div>
               <h5>Sexe</h5>
   </div>
   <div>
                <p>'.$sexe.'</p>
   </div>
              </div>
              <div class="line_info">
                   <div>
               <h5>Password</h5>
   </div>
   <div>
                <p>'.$pswd.'</p>
   </div>
              </div>

   </div>';
   if(isset($_POST["logout"])){
    session_destroy();
    header("Location:../login/Router_login.php");
   }
    }
    private function afficher_favorites($id){
        ?>
        <H2>Recettes Préférées</H2>
        <div class="reccont">
            <?php
        $c= new controler();
        $res=$c->get_prefered_recettes($id);
        for ($i = 0; $i <count($res); $i++) {
            echo '<div class="recettecard">
            <img src="'.$res[$i]["image"].'" alt="burger" id="recette" style="width:100%">
            <div class="container">
              <h4><b>'.$res[$i]["titre"].'</b></h4>
              <p class="desc">'.$res[$i]["description"].'</p>
              <a id="afficherlasuite" href="../Details_recette/Router_Details_recette.php?id='.$res[$i]["id_recette"].'">afficher la suite</a>
            </div>
          </div>';
          }
        ?>
    </div>
        <?php
    }
    public function afficher_profil($id){
        ?>
        <!DOCTYPE html>
            <html>
        <?php
        $c=new Accueil();
        $c->entete_page("Profil","./master_profil.css");
        ?>
        <body>
            <?php
            $this->afficher_info_user($id);
            $this->afficher_favorites($id);
            ?>
            </body>
            </html>
            <?php
    }
}