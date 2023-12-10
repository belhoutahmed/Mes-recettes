<?php
header('Content-type: text/html; charset=UTF-8');
require_once('../../vues/user/Accueil.php');
require_once('../../controlers/controler.php');
class home{
    private function seetings(){
        if(isset($_POST["logout"])){
            session_destroy();
            header("Location:../login/Router_login.php");
           }
        ?>
        <div class="log_cont">
        <form method="post" action="">
       <input class="log" type="submit" value="Logout" name="logout">
   </form>
    </div>
        <?php
    }
    private function categorie($titre,$path,$lien){
        
        
       echo '<a href="'.$lien.'"><div class="cat_card" style="background-image: url('.$path.');">
        
        <h3>'.$titre.'</h3>  
    </div></a>';
    
    }
    private function all_categories(){
        ?>
        <div class="all">
            <?php
            $this->categorie("Gestion des recettes","../../assets/images/rec.jpg","../gestion_recette/Router_gestion_recette.php");
            $this->categorie("Gestion des News","../../assets/images/news.jpg","../gestion_news/Router_gestion_news.php");
            $this->categorie("Gestion des utilisateurs","../../assets/images/user.jpg","../gestion_user/Router_gestion_user.php");
            $this->categorie("Gestion de la Nutrition","../../assets/images/ings.jpg","../gestion_ingredients/Router_gestion_ingredient.php");
            $this->categorie(" Paramètres","../../assets/images/param.jpg","../parametres/Router_parametres.php");

            ?>
        </div>
        <?php
    }
    public function afficher_home(){
        ?>
        <!DOCTYPE html>
            <html>
        <?php
        $c=new Accueil();
        $cont=new controler();
        $c->entete_page("Home","./master_home.css");
        ?>
        <body>
            <?php
            $this->seetings();
            $this->all_categories();
            ?>
            <script src="../jquery-3.6.1.min.js"></script>
            <script src="./parametres.js"></script>
            </body>
            </html>
            <?php
    }
}