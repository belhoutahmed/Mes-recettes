<?php
header('Content-type: text/html; charset=UTF-8');
require_once('../../vues/user/Accueil.php');
require_once('../../controlers/controler.php');
class saison{
    public function saisons(){
        ?>
        <div class="saison_cont">
        <div  class="saisons">
             <button id="all">Toutes</button>
           </div>
           <div class="saisons">
             <button id="ete">L’été</button>
           </div>
           <div class="saisons">
             <button id="printemps">Le printemps</button>
           </div>
           <div class="saisons">
             <button id="hiver">L’hiver</button>
           </div>
           <div class="saisons">
             <button id="automn">L’automne</button>
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
    public function afficher_saison(){
        ?>
        <!DOCTYPE html>
            <html>
        <?php
        $cont= new controler();
        $m=$cont->get_recettes_of_saisons(1);
        $c=new Accueil();
        $c->entete_page("Saison","./master_saison.css");
        ?>
        <body>
            <?php
            $c->navbar(5);
            $this->saisons();
            $this->recettes();
            $c->footer();
            ?>
             <script src="../jquery-3.6.1.min.js"></script>
            <script src="./saison.js"></script>
           
            </body>
            </html>
            <?php
    }
}