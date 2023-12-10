<?php
ob_start();
header('Content-type: text/html; charset=UTF-8');
require_once('../../vues/user/Accueil.php');
require_once('../../controlers/controler.php');
class parametres{
    private function parametre_pourcentage(){
        $c=new controler();
        $pourcentage=$c->get_parametre()[0]["pourcentage"];
        if(isset($_POST["appliquer"])){
            $c->change_parametre($_POST["pourcentage"],1);
            header("Location:./Router_parametres.php");
        }
        ?>
        <div class="change_param">
        <h3>Gestion de la page Idées de recettes </h3>
         <button class="log" id="change">Changer le Pourcentage</button>
         <div class="pource">
            <?php
            echo '<h4>Pourcentage Actuel <span>'.$pourcentage.' %<span></h4>';
            ?>
    </div>
        <form method="post" id="form_change">
         <div class="addfirst">
          <input name="pourcentage" class="input_change"  min=0 max=100 type="number" step=0.01 maxlength="5" placeholder="pourcentage en %" required>
          <input type="submit" value="Appliquer" class="log" name="appliquer">
          </div>
    </form>
    </div>
        
        <?php
        
    }
    private function parametre_sueil(){
        $c=new controler();
        $pourcentage=$c->get_parametre()[2]["pourcentage"];
        if(isset($_POST["appliquers"])){
            $c->change_parametre($_POST["pourcentage"],3);
            header("Location:./Router_parametres.php");
        }
        ?>
        <div class="change_param">
        <h3> Le seuil de calories pour que la recette soit healthy</h3>
         <button class="log" id="changes">Changer le Pourcentage</button>
         <div class="pource">
            <?php
            echo '<h4>Pourcentage Actuel <span>'.$pourcentage.' Kcal<span></h4>';
            ?>
    </div>
        <form method="post" id="form_changes">
         <div class="addfirst">
          <input name="pourcentage" class="input_change"  min=0 max=2000 type="number" step=0.1 maxlength="5" placeholder="pourcentage en %" required>
          <input type="submit" value="Appliquer" class="log" name="appliquers">
          </div>
    </form>
    </div>
        
        <?php
        
    }
    private function parametre_pourcentage_healthy(){
        $c=new controler();
        $pourcentage=$c->get_parametre()[1]["pourcentage"];
        if(isset($_POST["appliquerh"])){
            $c->change_parametre($_POST["pourcentage"],2);
            header("Location:./Router_parametres.php");
        }
        ?>
        <div class="change_param">
        <h3>Le Pourcentage des ingredients healthy pour que la recettes soit healthy </h3>
         <button class="log" id="changeh">Changer le Pourcentage </button>
         <div class="pource">
            <?php
            echo '<h4>Pourcentage Actuel pour que la recette soit healthy<span>'.$pourcentage.' %<span></h4>';
            ?>
    </div>
        <form method="post" id="form_changeh">
         <div class="addfirst">
          <input name="pourcentage" class="input_change"  min=0 max=100 type="number" step=0.01 maxlength="5" placeholder="pourcentage en %" required>
          <input type="submit" value="Appliquer" class="log" name="appliquerh">
          </div>
    </form>
    </div>
        
        <?php
        
    }
    private function afficher_recette(){
        $c=new controler();
        if(isset($_POST["enleverr"])){
            $c->delete_diapo($_POST["id"],2);
            header("Location:./Router_parametres.php");
        }
        if(isset($_POST["ajouterr"])){
            $c->add_diapo($_POST["id"],2);
            header("Location:./Router_parametres.php");
        }
        ?>
        
        <table class="tableau" >
        <caption>
            Gestion des Recettes
        </caption>
        <thead >
            <?php
             $c=new Controler();
             $res=$c->get_all_recettes();
             
                ?>
                <tr class="premierRow">
                <th scope="col" class="grey">Titre</th>
                <th scope="col" class="hid"></th>
            </tr>
       
        </thead>
        <tbody class="tbody2">
        <?php
         for ($i = 0; $i <count($res); $i++) {
            $new=$c->get_new_of_diapo($res[$i]["id_recette"],2);
            echo '<tr>
            <td ><a target="_blank" href="../Details_recette/Router_Details_recette.php?id='.$res[$i]["id_recette"].'">'.$res[$i]["titre"].'</a></td>';

            if(count($new)==0){
                echo  '<td class="hid"><form method="post" id="form_mod" class="form_modifier">
                <div class="addfirst">
                 <input name="id" class="firstcolumn" value="'.$res[$i]["id_recette"].'" type="text" maxlength="25" placeholder="ingredient" hidden>
                 <input type="submit" value="Ajouter au diapo" class="val" name="ajouterr">
                 </div>
           </form></td>
            </tr>';
               }
               else{
                 echo  '<td class="hid"><form method="post" id="form_mod" class="form_modifier">
                 <div class="addfirst">
                  <input name="id" class="firstcolumn" value="'.$res[$i]["id_recette"].'" type="text" maxlength="25" placeholder="ingredient" hidden>
                  <input type="submit" value="Enlever de diapo" class="sup" name="enleverr">
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
    private function afficher_news(){
        $c=new controler();
        if(isset($_POST["enlever"])){
            $c->delete_diapo($_POST["id"],1);
            header("Location:./Router_parametres.php");
        }
        if(isset($_POST["ajouter"])){
            $c->add_diapo($_POST["id"],1);
            header("Location:./Router_parametres.php");
        }
        ?>
        <table class="tableau" >
        <caption>
            Gestion des News
        </caption>
        <thead >
            <?php
             $c=new Controler();
             $res=$c->get_news();
             
                ?>
                <tr class="premierRow">
                <th scope="col" class="grey">Titre</th>
                <th scope="col" class="hid"></th>
            </tr>
       
        </thead>
        <tbody class="tbody2">
        <?php
         for ($i = 0; $i <count($res); $i++) {
           if($res[$i]["id_recette"]==NULL){
            $new=$c->get_new_of_diapo($res[$i]["id_news"],1);
            echo '<tr>
            <td ><a target="_blank" href="../Details_news/Router_Details_news.php?id='.$res[$i]["id_news"].'">'.$res[$i]["titre"].'</a></td>';
            if(count($new)==0){
                echo  '<td class="hid"><form method="post" id="form_mod" class="form_modifier">
                <div class="addfirst">
                 <input name="id" class="firstcolumn" value="'.$res[$i]["id_news"].'" type="text" maxlength="25" placeholder="ingredient" hidden>
                 <input type="submit" value="Ajouter au diapo" class="val" name="ajouter">
                 </div>
           </form></td>
            </tr>';
               }
               else{
                 echo  '<td class="hid"><form method="post" id="form_mod" class="form_modifier">
                 <div class="addfirst">
                  <input name="id" class="firstcolumn" value="'.$res[$i]["id_news"].'" type="text" maxlength="25" placeholder="ingredient" hidden>
                  <input type="submit" value="Enlever de diapo" class="sup" name="enlever">
                  </div>
            </form></td>
             </tr>
             ';
               }
     
       }
    }
    ?>
    </tbody>
    </table>
   
    <?php
    }
    
    
    public function afficher_Parametres(){
        ?>
        <!DOCTYPE html>
            <html>
        <?php
        $c=new Accueil();
        $cont=new controler();
        $c->entete_page("Paramètres","./master_parametres.css");
        ?>
        <body>
            <?php
            $this->parametre_pourcentage();
            $this->parametre_pourcentage_healthy();
            $this->parametre_sueil();
            $this->afficher_news();
            $this->afficher_recette();
            ?>
            <script src="../jquery-3.6.1.min.js"></script>
            <script src="./parametres.js"></script>
            </body>
            </html>
            <?php
    }
}