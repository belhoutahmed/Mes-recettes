<?php
header('Content-type: text/html; charset=UTF-8');
require_once('../../vues/user/Accueil.php');
require_once('../../controlers/controler.php');
class gestion_recette{
        private function filter(){
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
        private function afficher_recettes(){
            $c=new controler();
           if(isset($_POST["enlever"])){
               $c->supprimer_news($_POST["id"]);
               header("Location:./Router_gestion_news.php");
           }
           if(isset($_POST["ajouter"])){
            $c->add_news($_POST["id"]);
            header("Location:./Router_gestion_news.php");
        }
           ?>
           <table class="tableau" >
           <caption>
               Les Recettes
           </caption>
           <thead >
               <?php
                $c=new Controler();
                if(isset($_POST["appliquer"])){
                    $res=$c->filtre($_POST["select_cat"],$_POST["select_saison"],$_POST["trie"]); 
                }
                else{
                $res=$c->get_all_recettes();
                }
                   ?>
                   <tr class="premierRow">
                   <th scope="col" class="grey">Titre</th>
                   <th scope="col" class="grey">difficulté</th>
                   <th scope="col" class="grey">Temps de préparation</th>
                   <th scope="col" class="grey">Temps de cuisson</th>
                   <th scope="col" class="grey">Temps de repos</th>
                   <th scope="col" class="grey">Notation</th>
                   <th scope="col" class="grey">Nombre de calories</th>
                   <th scope="col" class="grey">Validé</th>
                   
                   
                   <th scope="col" class="hid"></th>
               </tr>
          
           </thead>
           <tbody class="tbody2">
           <?php
           $cont=new controler();
              if(isset($_POST["sup_recette"])){
                $cont->supprimer_recette($_POST["supprimer_recette"]);
                header("Location:./Router_gestion_recette.php");
            }

            if(isset($_POST["val_recette"])){
               $cont->valider_recette($_POST["valider_recette"],1);
               header("Location:./Router_gestion_recette.php");
            }
            if(isset($_POST["blo_recette"])){
                $cont->valider_recette($_POST["bloquer_recette"],0);
                header("Location:./Router_gestion_recette.php");
             }
            for ($i = 0; $i <count($res); $i++) {
                $calories=$c->get_calories_recette($res[$i]["id_recette"]);
            $notation=$c->get_notation($res[$i]["id_recette"]);
            if($res[$i]["validate"]==1){
                $valider="OUI";
            }
            else{
                $valider="NON";
            }
                echo '<tr>
               <td ><a target="_blank" href="../Details_recette/Router_Details_recette.php?id='.$res[$i]["id_recette"].'">'.$res[$i]["titre"].'</a></td>';
               echo '<td >'.$res[$i]["diffuculte"].'</td>';
               echo '<td >'.$res[$i]["temps_preparation"].' min</td>';
               echo '<td >'.$res[$i]["temps_cuisant"].' min</td>';
               echo '<td >'.$res[$i]["temps_repos"].' min</td>';
               if(count($notation)==0) echo '<td > Pas encore</td>';
               else  echo '<td >'.round($notation[0]["noter"], 1).' /10</td>';
               echo '<td >'.$calories.' Kcal</td>';
               echo '<td >'.$valider.'</td>';
               echo '<td class="hid"><form method="post" id="form_sup">
               <div class="addfirst">
                <input name="supprimer_recette" class="firstcolumn" value="'.$res[$i]["id_recette"].'" type="text" maxlength="25" placeholder="ingredient" hidden>
                <input type="submit" value="Supprimer" class="sup" name="sup_recette">
                </div>
          </form></td>';
          if($res[$i]["validate"]==False){
            echo  '<td class="hid"><form method="post" id="form_mod" class="form_modifier">
            <div class="addfirst">
             <input name="valider_recette" class="firstcolumn" value="'.$res[$i]["id_recette"].'" type="text" maxlength="25" placeholder="ingredient" hidden>
             <input type="submit" value="Valider" class="val" name="val_recette">
             </div>
       </form></td>
        </tr>';
           }
           else{
             echo  '<td class="hid"><form method="post" id="form_mod" class="form_modifier">
             <div class="addfirst">
              <input name="bloquer_recette" class="firstcolumn" value="'.$res[$i]["id_recette"].'" type="text" maxlength="25" placeholder="ingredient" hidden>
              <input type="submit" value="Bloquer" class="blo" name="blo_recette">
              </div>
        </form></td>
         </tr>
         ';
           }
                  }
        
          
       
       ?>
       </tbody>
       </table>
      
           <?php
       }

    public function afficher_gestion_recette(){
        
        ?>
        <!DOCTYPE html>
            <html>
        <?php
        $c=new Accueil();
        $cont=new controler();
        $c->entete_page("Gestion des recettes","./master_gestion_recette.css");
        ?>
        <body>
            <?php
           $this->filter();
           $this->afficher_recettes();
            ?>
            
            </body>
            </html>
            <?php
    }
}