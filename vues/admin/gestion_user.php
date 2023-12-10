<?php
header('Content-type: text/html; charset=UTF-8');
require_once('../../vues/user/Accueil.php');
require_once('../../controlers/controler.php');
class gestion_user{
    private function afficher_users(){
        ?>
        <div class="cont_tab">
        <table class="tableau" >
        <caption>
        </caption>
        <thead >
            <?php
             $c=new Controler();
             if(isset($_POST["filtrer"])){
                $res=$c->filtre_users($_POST["select_sexe"],$_POST["select_validation"],$_POST["trie"]);
             }
             else{
             $res=$c->get_all_users();
             }
             if(count($res)==0){
                echo '<h1>Aucun Résultat</h1>';
             }
             else {
                ?>
                <tr class="premierRow">
                <th scope="col" class="grey">Nom</th>
                <th scope="col" class="grey">Prénom</th>
                <th scope="col" class="grey">Mail</th>
                <th scope="col" class="grey">Sexe</th>
                <th scope="col" class="grey">Date de Naissance</th>
                <th scope="col" class="grey">Validé</th>
                <th scope="col" class="grey">Profil</th>
                <th scope="col" class="hid"></th>
                <th scope="col" class="hid"></th>
            </tr>
            <?php
             }
            ?>
       
        </thead>
        <tbody class="tbody2">
        <?php
         for ($i = 0; $i <count($res); $i++) {
            if($res[$i]["sexe"]=='M') $sexe="Masculin";
            else $sexe="Féminin";
            $nom=explode(' ',$res[$i]["name"])[0];
            $prenom=explode(' ',$res[$i]["name"])[1];
            if($res[$i]["validate"]==TRUE){
                $validate="OUI";
            }
            else{
                $validate="NON";
            }
            echo '<tr>
            <td >'.$nom.'</td>
            <td >'.$prenom.'</td>
            <td >'.$res[$i]["email"].'</td>
            <td >'.$sexe.'</td>
            <td >'.$res[$i]["date_naissance"].'</td>
            <td >'.$validate.'</td>
            <td ><a target="_blank" href="../profil/Router_profil.php?id='.$res[$i]["id_user"].'"> Lien </td>
            <td class="hid"><form method="post" id="form_sup">
            <div class="addfirst">
             <input name="supprimer_user" class="firstcolumn" value="'.$res[$i]["id_user"].'" type="text" maxlength="25" placeholder="ingredient" hidden>
             <input type="submit" value="Supprimer" class="sup" name="sup_user">
             </div>
       </form></td>';
       if($res[$i]["validate"]==False){
        echo  '<td class="hid"><form method="post" id="form_mod" class="form_modifier">
        <div class="addfirst">
         <input name="valider_user" class="firstcolumn" value="'.$res[$i]["id_user"].'" type="text" maxlength="25" placeholder="ingredient" hidden>
         <input type="submit" value="Valider" class="val" name="val_user">
         </div>
   </form></td>
    </tr>';
       }
       else{
         echo  '<td class="hid"><form method="post" id="form_mod" class="form_modifier">
         <div class="addfirst">
          <input name="bloquer_user" class="firstcolumn" value="'.$res[$i]["id_user"].'" type="text" maxlength="25" placeholder="ingredient" hidden>
          <input type="submit" value="Bloquer" class="blo" name="blo_user">
          </div>
    </form></td>
     </tr>
     ';
       }
      
         }
         ?>
        </tbody>
       </table>
        </div>
        <?php
    }
    
    private function filtre_form(){
        ?>
        <form method="post" id="filtre_form">
        <select name="select_sexe" id="select_sexe">
        <option value="0"  selected hidden>Sexe</option>
        <option value="1">Masculin</option>
        <option value="2">Féminin</option>
          </select>

        <select name="select_validation" id="select_validation">
        <option value="0"  selected hidden>Validé</option>
        <option value="1">OUI</option>
        <option value="2">NON</option>
          </select>
          <select name="trie" id="trie">
          <option value="0"  selected hidden>Trier par</option>
        <option value="1">Nom et Prénom</option>
        <option value="2">Date de Naissance</option>
          </select>
            <input type="submit" value="Appliquer" class="log" name="filtrer">
</form>
        <?php
    }

    public function afficher_gestion_user(){
        ?>
        <!DOCTYPE html>
            <html>
        <?php
        $c=new Accueil();
        $cont=new controler();
        $c->entete_page("Gestion des utilisateurs","./master_gestion_user.css");
        ?>
        <body>
            <?php
           
            if(isset($_POST["sup_user"])){
                $cont->supprimer_user($_POST["supprimer_user"]);
                header("Location:./Router_gestion_user.php");
            }

            if(isset($_POST["val_user"])){
               $cont->valider_user($_POST["valider_user"],1);
               header("Location:./Router_gestion_user.php");
            }
            if(isset($_POST["blo_user"])){
                $cont->valider_user($_POST["bloquer_user"],0);
                header("Location:./Router_gestion_user.php");
             }
            $this->filtre_form();
            $this->afficher_users();
           
            ?>
            
            </body>
            </html>
            <?php
    }
}