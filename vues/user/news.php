<?php
header('Content-type: text/html; charset=UTF-8');
require_once('../../vues/user/Accueil.php');
require_once('../../controlers/controler.php');
class news{
    private function cadres_news(){
        ?>
           <div class="reccont">
            <?php 
             $c=new Controler();
             $res=$c->get_news();
             for ($i = 0; $i <count($res); $i++) {
              if($res[$i]["id_recette"]==NULL){
              echo '<div class="recettecard">
              <img src="'.$res[$i]["image"].'" alt="'.$res[$i]["titre"].'" id="recette" style="width:100%">
              <div class="container">
                <h4><b>'.$res[$i]["titre"].'</b></h4>
                <p class="desc">'.$res[$i]["paragraphe"].'</p>
                <a target="_blank" id="afficherlasuite" href="../Details_news/Router_Details_news.php?id='.$res[$i]["id_news"].'">afficher la suite</a>
              </div>
            </div>';
              }
              else{
                $rec=$c->get_recette($res[$i]["id_recette"]);
                echo '<div class="recettecard">
                <img src="'.$rec[0]["image"].'" alt="'.$rec[0]["titre"].'" id="recette" style="width:100%">
                <div class="container">
                  <h4><b>'.$rec[0]["titre"].'</b></h4>
                  <p class="desc">'.$rec[0]["description"].'</p>
                  <a target="_blank" id="afficherlasuite" href="../Details_recette/Router_Details_recette.php?id='.$rec[0]["id_recette"].'">afficher la suite</a>
                </div>
              </div>';
              }
            }
            ?>
</div>
  
        <?php
    }



    public function afficher_news(){
        ?>
        <!DOCTYPE html>
            <html>
        <?php
        $c=new Accueil();
        $c->entete_page("News","./master_news.css");
        ?>
        <body>
            <?php
            $c->navbar(2);
            $this->cadres_news();
            $c->footer();
            ?>
            </body>
            </html>
            <?php
    }

}