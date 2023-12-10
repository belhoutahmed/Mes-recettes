<?php
header('Content-type: text/html; charset=UTF-8');
require_once('../../vues/user/Accueil.php');
require_once('../../controlers/controler.php');
class categorie{
    private function filtre_form(){
        ?>
        <form method="post" id="filtre_form">
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
            <input type="submit" value="Appliquer" class="log" name="filtrer">
</form>
        <?php
    }
    private function recettes($id_categorie){
        ?>
        <div class="reccont">
        <?php
        $c=new Controler();
        if(isset($_POST["filtrer"])){
             $res=$c->filtre($id_categorie,$_POST["select_saison"],$_POST["trie"]);
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
        else{
          $res=$c->get_recettes($id_categorie);
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
        ?>
        </div>
        <?php
    }
    public function afficher_categorie($id_categorie){
        ?>
        <!DOCTYPE html>
            <html>
        <?php
        $cont=new Controler();
        $cat=$cont->get_categorie($id_categorie);
        $c=new Accueil();
        $c->entete_page($cat[0]["name"],"./master_categorie.css");
        ?>
        <body>
            <?php
            $c->navbar(0);
            $this->filtre_form();
            $this->recettes($id_categorie);
            $c->footer();
            ?>
            </body>
            </html>
            <?php
    }

}