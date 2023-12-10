<?php
header('Content-type: text/html; charset=UTF-8');
require_once('../../vues/user/Accueil.php');
require_once('../../controlers/controler.php');
class healthy{
    private function filtre(){
        ?>
        <div id="aff">
<form method="post" id="filtre_form">
<select name="select_cat" id="select_cat">
        <option value="0"  selected hidden>Catégorie</option>
        <option value="1">Entrées</option>
        <option value="2">Plats</option>
        <option value="3">Desserts</option>
        <option value="4">Boissons</option>
          </select>
<select name="select_saison" id="select_saison">
        <option value="0"  selected hidden>Saison</option>
        <option value="1">L’été</option>
        <option value="2">Le printemps</option>
        <option value="3">L’hiver</option>
        <option value="4">L’automne</option>
          </select>
          <select name="trie" id="trie">
          <option value="0"  selected hidden>Trier par</option>
        <option value="1">Temps de préparation</option>
        <option value="2">Temps de cuisson</option>
        <option value="3">Temps total</option>
        <option value="4">Notation</option>
        <option value="5">Nombre de calories</option>
          </select>
<input type="text"  class="log" id="ids" name="id" hidden>
            <input type="submit" value="Appliquer" class="log" name="appliquer">
</form>
</div>
        <?php
    }
    private function recettes(){
        ?>
        <div class="reccont">
        <?php
          $c= new controler();
          if(isset($_POST["appliquer"])){
            if($_POST["select_cat"]==0 and $_POST["select_saison"]==0 and $_POST["trie"]==0 ){
            $res=$c->get_recettes_healthy();
            if(count($res)==0)   echo '<div id="no_res"><h1>Aucun Résultat</h1></div>';
            else{
            for ($i = 0; $i <count($res); $i++) {
                echo '<div class="recettecard">
                <img src="'.$res[$i]["image"].'" alt="burger" id="recette" style="width:100%">
                <div class="container">
                  <h4><b>'.$res[$i]["titre"].'</b></h4>
                  <p class="desc">'.$res[$i]["description"].'</p>
                  <a target="_blank" id="afficherlasuite" href="../Details_recette/Router_Details_recette.php?id='.$res[$i]["id_recette"].'">afficher la suite</a>
                </div>
              </div>';
              }
            }
        }
        else{
          $filtre=$c->filtre($_POST["select_cat"],$_POST["select_saison"],$_POST["trie"]);
          $res=$c->get_recettes_healthy();
          for ($i = 0; $i <count($filtre); $i++){
           
            for ($k = 0; $k <count($res); $k++){
                
                 if((int)$filtre[$i]["id_recette"]==(int)$res[$k]["id_recette"]){
                  
                    echo '<div class="recettecard">
                    <img src="'.$res[$k]["image"].'" alt="burger" id="recette" style="width:100%">
                    <div class="container">
                      <h4><b>'.$res[$k]["titre"].'</b></h4>
                      <p class="desc">'.$res[$k]["description"].'</p>
                      <a target="_blank" id="afficherlasuite" href="../Details_recette/Router_Details_recette.php?id='.$res[$k]["id_recette"].'">afficher la suite</a>
                    </div>
                  </div>';

                 }
            }
          }

        }
    }
    else{
        $res=$c->get_recettes_healthy();
            if(count($res)==0)   echo '<div id="no_res"><h1>Aucun Résultat</h1></div>';
            else{
            for ($i = 0; $i <count($res); $i++) {
                echo '<div class="recettecard">
                <img src="'.$res[$i]["image"].'" alt="burger" id="recette" style="width:100%">
                <div class="container">
                  <h4><b>'.$res[$i]["titre"].'</b></h4>
                  <p class="desc">'.$res[$i]["description"].'</p>
                  <a target="_blank" id="afficherlasuite" href="../Details_recette/Router_Details_recette.php?id='.$res[$i]["id_recette"].'">afficher la suite</a>
                </div>
              </div>';
              }
            }
    }
        ?>
        </div>
        <?php
    }
    public function afficher_healthy(){
        ?>
        <!DOCTYPE html>
            <html>
        <?php
        $c=new Accueil();
        $c->entete_page("Healthy","./master_healthy.css");
        ?>
        <body>
            <?php
            $c->navbar(4);
            $this->filtre();
            $this->recettes();
            $c->footer();
            ?>
            <script src="../jquery-3.6.1.min.js"></script>
            <script src="./idees_recette.js"></script>
            </body>
            </html>
            <?php
    }
}