<?php
header('Content-type: text/html; charset=UTF-8');
require_once('../../vues/user/Accueil.php');
require_once('../../controlers/controler.php');
class gestion_news{
    private function form_ajouter(){
    
        ?>
        <button class="log" id="aj">Ajouter News</button>
         <form method="post" id="ajou_form">
             <div class="inp_cont">
          <input name="titre" class="inputs_ajou"  type="text" maxlength="25" placeholder="titre" required>
            

          <label for="image">Choisir une image</label>
<input type="file" id="myfile" class="inputs_ajou" name="image">
           </div>
     <div class="inp_cont">
     <textarea rows="9" cols="50" id="par" name="paragraphe" class="inputs_ajou"  form="ajou_form" required>Entrer paragraphe... </textarea> 
    
     </div>
           <div class="sub_cont">
          <button class="annuler" id="annuler2">Annuler</button>
           <input type="submit" value="Ajouter" class="log" name="ajouter">
     </div>
 </form>
         
 
         <?php
         }
    private function afficher_news(){
         $c=new controler();
        if(isset($_POST["Supprimer"])){
            $c->supprimer_news($_POST["id"]);
            header("Location:./Router_gestion_news.php");
        }
        ?>
        <table class="tableau" >
        <caption>
            Les News
        </caption>
        <thead >
            <?php
             $c=new Controler();
             $res=$c->get_news();
                ?>
                <tr class="premierRow">
                <th scope="col" class="grey">Titre</th>
                <th scope="col" class="grey">Description</th>
                <th scope="col" class="hid"></th>
            </tr>
       
        </thead>
        <tbody class="tbody2">
        <?php
         for ($i = 0; $i <count($res); $i++) {
           if($res[$i]["id_recette"]==NULL){
            echo '<tr>
            <td ><a target="_blank" href="../Details_news/Router_Details_news.php?id='.$res[$i]["id_news"].'">'.$res[$i]["titre"].'</a></td>';  
            echo '<td ><p class="desc">'.$res[$i]["paragraphe"].'</p></td>';
            echo  '<td class="hid"><form method="post" id="form_mod" class="form_modifier">
                <div class="addfirst">
                 <input name="id" class="firstcolumn" value="'.$res[$i]["id_news"].'" type="text" maxlength="25" placeholder="ingredient" hidden>
                 <input type="submit" value="Supprimer" class="sup" name="Supprimer">
                 </div>
           </form></td>
            </tr>';
               }
     
       
    }
    ?>
    </tbody>
    </table>
   
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
            $res=$c->get_recettes_news();
               ?>
               <tr class="premierRow">
               <th scope="col" class="grey">Titre</th>
               <th scope="col" class="grey">difficulté</th>
               <th scope="col" class="grey">Temps de préparation</th>
               <th scope="col" class="grey">Temps de cuisson</th>
               <th scope="col" class="grey">Temps de repos</th>
               <th scope="col" class="grey">Notation</th>
               <th scope="col" class="grey">Nombre de calories</th>
               
               
               <th scope="col" class="hid"></th>
           </tr>
      
       </thead>
       <tbody class="tbody2">
       <?php
        for ($i = 0; $i <count($res); $i++) {
            $calories=$c->get_calories_recette($res[$i]["id_recette"]);
        $notation=$c->get_notation($res[$i]["id_recette"]);
            echo '<tr>
           <td ><a target="_blank" href="../Details_recette/Router_Details_recette.php?id='.$res[$i]["id_recette"].'">'.$res[$i]["titre"].'</a></td>';
           echo '<td >'.$res[$i]["diffuculte"].'</td>';
           echo '<td >'.$res[$i]["temps_preparation"].' min</td>';
           echo '<td >'.$res[$i]["temps_cuisant"].' min</td>';
           echo '<td >'.$res[$i]["temps_repos"].' min</td>';
           if($notation[0]["noter"]==NULL) echo '<td > Pas encore</td>';
           else  echo '<td >'.round($notation[0]["noter"], 1).' /10</td>';
           echo '<td >'.$calories.' Kcal</td>';
        
           if($res[$i]["id_news"]!=NULL){ 
           echo  '<td class="hid"><form method="post" id="form_mod" class="form_modifier">
               <div class="addfirst">
                <input name="id" class="firstcolumn" value="'.$res[$i]["id_news"].'" type="text" maxlength="25" placeholder="ingredient" hidden>
                <input type="submit" value="Enlever de News" class="sup" name="enlever">
                </div>
          </form></td>
           </tr>';
              }
              else{
                echo  '<td class="hid"><form method="post" id="form_mod" class="form_modifier">
                <div class="addfirst">
                 <input name="id" class="firstcolumn" value="'.$res[$i]["id_recette"].'" type="text" maxlength="25" placeholder="ingredient" hidden>
                 <input type="submit" value="Ajouter au News" class="val" name="ajouter">
                 </div>
           </form></td>
            </tr>';
              }
    
      
   }
   ?>
   </tbody>
   </table>
  
       <?php
   }
    public function afficher_gestion_news(){
        ?>
        <!DOCTYPE html>
            <html>
        <?php
        $c=new Accueil();
        $cont=new controler();
        $c->entete_page("Gestion des News","./master_gestion_news.css");
        ?>
        <body>
            <?php
            $this->form_ajouter();
           $this->afficher_news();
            $this->afficher_recettes();
            
         
            ?>
            <script src="../jquery-3.6.1.min.js"></script>
            <script src="./gestion_news.js"></script>
            </body>
            </html>
            <?php
    }
}