<?php
header('Content-type: text/html; charset=UTF-8');
require_once('../../vues/user/Accueil.php');
require_once('../../controlers/controler.php');
class Nutrition{
    private function rechercher_ingredient(){
        ?>
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
        <table class="tableau" border="1">
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
        </tr>';
         }
         ?>
        </tbody>
       </table>
        </div>
        <?php
    }


    public function afficher_Nutrition(){
        ?>
        <!DOCTYPE html>
            <html>
        <?php
        $c=new Accueil();
        $c->entete_page("Nutrition","./master_Nutrition.css");
        ?>
        <body>
            <?php
            $c->navbar(7);
            $this->rechercher_ingredient();
            if(isset($_POST["Rechercher_ing"])){
                $this->info($_POST["ingredient"]);
            }
            else $this->info(NULL);
            $c->footer();
            ?>
            </body>
            </html>
            <?php
    }
}