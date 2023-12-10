<?php
header('Content-type: text/html; charset=UTF-8');
require_once('../../vues/user/Accueil.php');
require_once('../../controlers/controler.php');
class fetes{
    
    private function fete(){
        ?>
        <div class="saison_cont">
        <div  class="saisons">
             <button id="all">Toutes</button>
           </div>
           <div class="saisons">
             <button id="Mariage">Mariage</button>
           </div>
           <div class="saisons">
             <button id="Achoura">Achoura</button>
           </div>
           <div class="saisons">
             <button id="Aid">Aid</button>
           </div>
           <div class="saisons">
             <button id="Ramadan">Ramadan</button>
           </div>
           <div class="saisons">
             <button id="Elmawlid">El mawlid</button>
           </div>
       </div>
       <?php
    }
    public function recettes(){
        ?>
        <div class="cont_recettes">
      </div>
        <?php
      }
    public function afficher_fetes(){
        ?>
        <!DOCTYPE html>
            <html>
        <?php
        $c=new Accueil();
        $c->entete_page("Fêtes","./master_fetes.css");
        ?>
        <body>
            <?php
            $c->navbar(6);
            $this->fete();
            $this->recettes();
            $c->footer();
            ?>
            <script src="../jquery-3.6.1.min.js"></script>
            <script src="./fetes.js"></script>
            </body>
            </html>
            <?php
    }

}