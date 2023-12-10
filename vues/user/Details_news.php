<?php
header('Content-type: text/html; charset=UTF-8');
require_once('../../vues/user/Accueil.php');
require_once('../../controlers/controler.php');
class Details_news{
    private function information($titre,$paragraphe,$image){
        ?>
        <div class="cont_info">
        <h2>
            <?php
            echo $titre;
            ?>
        </h2>
        <p>
        <?php
            echo $paragraphe;
            ?> 
        </p>
      <div class="img">
        <?php
         echo '<img src="'.$image.'" alt="'.$titre.'" id="recette" >';
         ?>
      </div> 
      </div>
        <?php
      }
    public function afficher_details_news($id_news){
        ?>
        <!DOCTYPE html>
            <html>
        <?php
        $cont=new Controler();
        $new=$cont->get_new($id_news);
        $c=new Accueil();
        $c->entete_page($new[0]["titre"],"./master_Details_news.css");
        ?>
        <body>
            <?php
            $c->navbar(0);
            $this->information($new[0]["titre"],$new[0]["paragraphe"],$new[0]["image"]);
            $c->footer();
            ?>
            </body>
            </html>
            <?php
    }

}