<?php
header('Content-type: text/html; charset=UTF-8');
require_once('../../vues/user/Accueil.php');
require_once('../../controlers/controler.php');
class gestion_ingredient{
    private function rechercher_ingredient(){
        ?>
        <button class="log" id="aj">Ajouter ingredient</button>
        <form method="post" id="formrech_ing">
         <div class="addfirst">
          <input name="ingredient" class="firstcolumn" type="text" maxlength="25" placeholder="ingredient">
          <input type="submit" value="Rechercher" class="log" name="Rechercher_ing">
          </div>
    </form>
          <?php
    }
    private function info($rechrche){
        ?>
        <div class="cont_tab">
        <table class="tableau" >
        <caption>
        </caption>
        <thead >
            <?php
             $c=new Controler();
             $res=$c->get_all_ingredients($rechrche);
             if(count($res)==0){
                echo '<h1>Aucun Résultat</h1>';
             }
             else {
                ?>
                <tr class="premierRow">
                <th scope="col" class="grey">L'ingredient</th>
                <th scope="col" class="grey">Le nombre de calories</th>
                <th scope="col" class="grey">Glucides</th>
                <th scope="col" class="grey">Lipides</th>
                <th scope="col" class="grey">Minéraux</th>
                <th scope="col" class="grey">Vitamines</th>
                <th scope="col" class="grey">Healthy</th>
                <th scope="col" class="grey">Saison naturelle</th>
                <th hidden></th>
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
            $info=$c->get_info_ingredient($res[$i]["id_ingredient"]);
            $saison=$c->get_saison_of_ingredient($res[$i]["id_ingredient"]);
            if($res[$i]["healthy"]==TRUE){
                $healthy="OUI";
            }
            else{
                $healthy="NON";
            }
            if(count($saison)==0) $s="toute l'année";
            else $s=$saison[0]["name"];
            echo '<tr>
            <td >'.$res[$i]["name"].'</td>
            <td >'.$res[$i]["calories"].' Kcal/100g</td>
            <td >'.$info[0]["glucides"].' g/100g</td>
            <td >'.$info[0]["lipides"].' g/100g</td>
            <td >'.$info[0]["minéraux"].'</td>
            <td >'.$info[0]["vitamines"].'</td>
            <td >'.$healthy.'</td>
            <td >'.$s.'</td>
            <td hidden> '.$res[$i]["proportion"].'</td>
            <td class="hid"><form method="post" id="form_sup">
            <div class="addfirst">
             <input name="sup_ingredient" class="firstcolumn" value="'.$res[$i]["id_ingredient"].'" type="text" maxlength="25" placeholder="ingredient" hidden>
             <input type="submit" value="Supprimer" class="sup" name="sup_ing">
             </div>
       </form></td>
       <td class="hid"><form method="post" id="form_mod" class="form_modifier">
            <div class="addfirst">
             <input name="mod_ingredient" class="firstcolumn" value="'.$res[$i]["id_ingredient"].'" type="text" maxlength="25" placeholder="ingredient" hidden>
             <input type="submit" value="Modifier" class="mod" name="mod_ing">
             </div>
       </form></td>
        </tr>
        ';
         }
         ?>
        </tbody>
       </table>
        </div>
        <?php
    }
    private function form_ajouter(){
       ?>
        <form method="post" id="mod_form">
            <div class="inp_cont">
         <input name="name" class="inputs_ajou"  type="text" maxlength="25" placeholder="ingredient" required>
         <input name="calories" class="inputs_ajou" min=0 max=100 type="number" step=0.01 maxlength="5" placeholder="Calories dans 100g" required>
         <input name="glucides" class="inputs_ajou" min=0 max=100 type="number" step=0.01 maxlength="5" placeholder="Glucides dans 100g" required>
    </div>
    <div class="inp_cont">
         <input name="lipides" class="inputs_ajou" min=0 max=100 type="number"  step=0.01  maxlength="5" placeholder="Lipides dans 100g" required>
         <input name="minéraux" class="inputs_ajou"  type="text" maxlength="25" placeholder="Minéraux séparés par virgule" >
         <input name="vitamines" class="inputs_ajou"  type="text" maxlength="25" placeholder="Vitamines séparés par virgule">
    </div>
    <div class="inp_cont">
         <select name="select_saison" id="select_saison" required>
        <option value="1">L’été</option>
        <option value="2">Le printemps</option>
        <option value="3">L’hiver</option>
        <option value="4">L’automne</option>
        <option value="5">Toute l'année</option>
        <input name="modie" class="firstcolumn"  type="text" maxlength="25" placeholder="ingredient" hidden>
          <input name="proportion" class="inputs_ajou" min=0 max=100 type="number" step=0.01 maxlength="5" placeholder="Proportion de healthy %" required>
    </div> 
          <div class="sub_cont">
         <button class="annuler" id="annuler1">Annuler</button>
          <input type="submit" value="Modifier" class="log" name="modifier">
    </div>
</form>
        

         <form method="post" id="ajou_form">
            <div class="inp_cont">
         <input name="name" class="inputs_ajou"  type="text" maxlength="25" placeholder="ingredient" required>
         <input name="calories" class="inputs_ajou" min=0 max=100 type="number" step=0.01 maxlength="5" placeholder="Calories dans 100g" required>
         <input name="glucides" class="inputs_ajou" min=0 max=100 type="number" step=0.01 maxlength="5" placeholder="Glucides dans 100g" required>
    </div>
    <div class="inp_cont">
         <input name="lipides" class="inputs_ajou" min=0 max=100 type="number"  step=0.01  maxlength="5" placeholder="Lipides dans 100g" required>
         <input name="minéraux" class="inputs_ajou"  type="text" maxlength="25" placeholder="Minéraux séparés par virgule" >
         <input name="vitamines" class="inputs_ajou"  type="text" maxlength="25" placeholder="Vitamines séparés par virgule">
    </div>
    <div class="inp_cont">
         <select name="select_saison" id="select_saison" required>
        <option value="1">L’été</option>
        <option value="2">Le printemps</option>
        <option value="3">L’hiver</option>
        <option value="4">L’automne</option>
        <option value="5">Toute l'année</option>
         
          <input name="proportion" class="inputs_ajou" min=0 max=100 type="number" step=0.01 maxlength="5" placeholder="Proportion de healthy %" required>
    </div> 
          <div class="sub_cont">
         <button class="annuler" id="annuler2">Annuler</button>
          <input type="submit" value="Ajouter" class="log" name="ajouter">
    </div>
</form>
        <?php
        }
    


    public function afficher_gestion_ingredient(){
        ?>
        <!DOCTYPE html>
            <html>
        <?php
        $c=new Accueil();
        $cont=new controler();
        $c->entete_page("Gestion de la nutrition","./master_gestion_ingredient.css");
        ?>
        <body>
            <?php
           
            if(isset($_POST["sup_ing"])){
                $cont->delete_ingredient($_POST["sup_ingredient"]);
            }

            if(isset($_POST["ajouter"])){
                $healthy=0;
               if($_POST["proportion"]>=50) {
                $healthy=1;
               }
               $cont->ajouter_ingredient($_POST["name"],$_POST["calories"],$_POST["glucides"],$_POST["lipides"],$_POST["minéraux"],$_POST["vitamines"],$_POST["select_saison"],$healthy,$_POST["proportion"]);
               header("Location:./Router_gestion_ingredient.php");
            }
            if(isset($_POST["modifier"])){
                $healthy=0;
               if($_POST["proportion"]>=50) {
                $healthy=1;
               }
               $cont->modifier_ingredient($_POST["modie"],$_POST["name"],$_POST["calories"],$_POST["glucides"],$_POST["lipides"],$_POST["minéraux"],$_POST["vitamines"],$_POST["select_saison"],$healthy,$_POST["proportion"]);
               header("Location:./Router_gestion_ingredient.php");
            }
            $this->rechercher_ingredient();
            $this->form_ajouter();
            if(isset($_POST["Rechercher_ing"])){
                $this->info($_POST["ingredient"]);
            }
            else $this->info(NULL);
           
            ?>
             <script src="../jquery-3.6.1.min.js"></script>
            <script src="./gestion_ingredient.js"></script>
            </body>
            </html>
            <?php
    }
}