<?php
header('Content-type: text/html; charset=UTF-8');
require_once('../../vues/user/Accueil.php');
require_once('../../controlers/controler.php');
class Details_recette{
      private function information_important($id,$notation,$titre,$description,$image,$temps_repos,$temps_cuissant,$temps_preparation,$difficulte){
        ?>
        <h2>
            <?php
            echo $titre;
            ?>
        </h2>
        <div class="cont_info">
        <p class="desc">
        <?php
            echo $description;
            ?>
      </p>
      <?php
      if(isset($_SESSION["id_user"])){
      $cont= new controler();
      $res=$cont->verifier_preferance($_SESSION['id_user'],$id);
      if(count($res)>0){
        echo '<form method="post" action="">
        <input class="sup" type="submit" value="Retirer des Favoris" name="supprimer">
    </form>';
      }
      else {
        echo '<form method="post" action="">
        <input class="aj" type="submit" value="Ajouter aux Favoris" name="ajouter">
    </form>';
      }
      if(isset($_POST["ajouter"])){
        $cont->add_preferance($_SESSION['id_user'],$id);
        header('Location:./Router_Details_recette.php?id='.$id.'');
      }
      if(isset($_POST["supprimer"])){
        $cont->remove_preferance($_SESSION['id_user'],$id);
        header('Location:./Router_Details_recette.php?id='.$id.'');
      }
     
    }
      ?>
      
   
      </div>
      
     <div class="contt">
      <div class="img">
        <?php
         echo '<img src="'.$image.'" alt="burger" id="recette" >';
         ?>
         <div class="roww">
            <div class="partie">
                <img src="../../assets/images/clock.png" alt="time">
                <h3>
                    <?php
                    echo $temps_cuissant+$temps_preparation+$temps_repos." min";
                    ?>
                </h3>
            </div>
            <div class="partie">
                <img src="../../assets/images/suitcase.png" alt="time">
                <h3>
                    <?php
                    echo $difficulte;
                    ?>
                </h3>
            </div>
            <div class="partie">
                <img src="../../assets/images/rating.png" alt="time">
                <?php
                if($notation[0]["noter"]==NULL) echo '<h3> Pas encore</h3>';
                else echo '<h3>'.round($notation[0]["noter"], 1).' /10</h3>';
                
                ?>
                
            </div>
            
         </div>
      </div> 
      </div>
        <?php
      }
      private function temps($temps_repos,$temps_cuissant,$temps_preparation,$calories){
        ?>
        <div class="info_cont">
         <div class="info_recette">
        <div class="info">
          <h4>Le temps de préparation</h4>
          <p>
            <?php
            echo $temps_preparation+0 ." min";
            ?>
          </p>
        </div>
        <div class="info">
         <h4>Le temps de repos</h4>
         <p><?php
            echo $temps_repos+0 ." min";
            ?></p>
       </div>
       <div class="info">
         <h4>Le temps de cuisson</h4>
         <p><?php
            echo $temps_cuissant+0 ." min";
            ?></p>
       </div>
       <div class="info">
         <h4>Le nombre de calories</h4>
         <p>
            <?php
            echo $calories." calories";
            ?>
         </p>
       </div>
       </div>
       </div>
        <?php
      }
      private function ingredients($ingredients){
        ?>
        <div class="ingredients">
        <h3>Les ingrédients</h3>
        <div class="inglist">
         <ul>
         <?php
            for ($i = 0; $i <count($ingredients); $i++) {
                $contt=new Controler();
               $ingredient=$contt->get_ingredients($ingredients[$i]["id_ingredient"]);
               if($ingredients[$i]["unite"]==NULL){
                echo '<li>'.$ingredient[0]["name"].' : '.$ingredients[$i]["quantite"].' g</li>';
            }
            else{
                if($ingredients[$i]["unite"]=="u"){
                    echo '<li>'.$ingredient[0]["name"].' : '.$ingredients[$i]["quantite"].' unité</li>';
                }
                else{
                        echo '<li>'.$ingredient[0]["name"].' : '.$ingredients[$i]["quantite"].' '.$ingredients[$i]["unite"].'</li>';
                    
                }
            }
            
        }
            ?>
            
                
                 
 
             
         </ul>
        </div>
       </div>
       <?php
      }
      private function etapes($etapes){

        ?>
         <div class="etapes">
        <h3>Les étapes pour la réalisation de cette recette</h3>
        <div class="etlist">
            <ul>
                <?php
            for ($i = 0; $i <count($etapes); $i++) {
                echo '<li>'.$etapes[$i]["description"].'</li>';
            }
            ?>
                
            </ul>
        </div>
       </div>
        <?php
      }
      public function afficher_details_recette($id){
        ?>
        <!DOCTYPE html>
            <html>
        <?php
        $cont=new Controler();
        $recette=$cont->get_recette($id);
        $etapes=$cont->get_etapes($id);
        $calories=$cont->get_calories_recette($id);
        $notation=$cont->get_notation($id);
        $ingredients=$cont->get_ingredients_recette($id);
        $c=new Accueil();
        $c->entete_page($recette[0]["titre"],"./master_Details_recette.css");
        ?>
        <body>
            <?php
            $c->navbar(0);
            $this->information_important($id,$notation,$recette[0]["titre"],$recette[0]["description"],$recette[0]["image"],$recette[0]["temps_repos"],$recette[0]["temps_cuisant"],$recette[0]["temps_preparation"],$recette[0]["diffuculte"]);
            $this->temps($recette[0]["temps_repos"],$recette[0]["temps_cuisant"],$recette[0]["temps_preparation"],$calories);
             $this->ingredients($ingredients);
             $this->etapes($etapes);
            $c->footer();
            ?>
            </body>
            </html>
            <?php
            
    }
}