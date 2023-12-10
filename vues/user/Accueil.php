<?php
header('Content-type: text/html; charset=UTF-8');
class Accueil{
    public function entete_page($title,$css){
        ?>
        <head>
      <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
      <?php
       echo $title;
        ?>
    </title>
    <?php
     $c=new Controler();
     $res=$c->get_diaporama();
     $len=count($res);
     $s=$len*100;
   echo '<style>
   .diap{
    width: 97.8%;
    height: 600px;
    overflow: hidden;
    background-color: black;
    margin: 0px 15px

}
.diap .img{
    width: '.$s.'%;
    height: 100%;
    display: flex;
    gap: 0.02%;
    animation: diaporama '.($len*5).'s infinite;
}
.diap .img a{
    width: 100%;
    height: 100%;
    box-sizing: border-box;
   
}';
echo '@keyframes diaporama{
  0%{
      transform: translateX(0%);
  }';
for ($i = 1; $i <$len; $i++) {
   echo  ''.($i*(100/$len)).'%{
    transform: translateX(-'.($i*(100/$len)).'%);
}';
}
echo '100%{
  transform: translateX(0%);
}
}';

   
    echo '</style>';
    echo '<link rel="stylesheet" href="'.$css.'">';
    ?>
    
    
      <style></style>
      
    </head>
        <?php
    }
    public function navbar($clic){
        ?>
        <div class="nav">
        <div class="cont">
        <div class="logocontainer">
          <img src="../../assets/images/logo.png" alt="Logo" id="logo" >
        </div>
        
        <div class="row">
          <?php
        if(!empty($_SESSION)){
           if(isset($_SESSION["id_user"])){
         echo   '<a href="../profil/Router_profil.php?id='.$_SESSION["id_user"].'" id="profil">Profil</a>';
           }
        }
        else{
          ?>
          <a href="../login/Router_login.php" id="signup">S'inscrire</a>
          <?php
        }
        ?>
        <div class="reseausoc">
            <a class="lienres" href="">
            <img src="../../assets/images/facebook.png" alt="facebook" class="res" ></a>
        </div>
        <div class="reseausoc">
            <a class="lienres" href="">
            <img src="../../assets/images/youtube.png" alt="Youtube" class="res" ></a>
        </div>
        <div class="reseausoc">
            <a class="lienres" href="">
            <img src="../../assets/images/instagram.png" alt="Instagram" class="res" ></a>
        </div>
    </div>
    </div>
        
        <ul>
            <?php
            if($clic==1){?>
            <li  class="lienpr lienprclic"><a href="../Accueil/Router_Accueil.php">Accueil</a></li>
            <?php
          }else{
            ?>
            <li  class="lienpr"><a href="../Accueil/Router_Accueil.php">Accueil</a></li>
            <?php
            
          }?>
          <?php
            if($clic==2){?>
            <li  class="lienpr lienprclic"><a href="../News/Router_news.php">News</a></li>
            <?php
          }else{
            ?>
            <li  class="lienpr"><a href="../News/Router_news.php">News</a></li>
            <?php
            
          }?>
          <?php
            if($clic==3){?>
            <li  class="lienpr lienprclic"><a href="../idees_recette/Router_idees_recette.php">Idées de recette</a></li>
            <?php
          }else{
            ?>
            <li  class="lienpr"><a href="../idees_recette/Router_idees_recette.php">Idées de recette</a></li>
            <?php
            
          }?>
           <?php
            if($clic==4){?>
            <li  class="lienpr lienprclic"><a href="../healthy/Router_healthy.php">Healthy</a></li>
            <?php
          }else{
            ?>
            <li  class="lienpr"><a href="../healthy/Router_healthy.php">Healthy</a></li>
            <?php
            
          }?>
          <?php
            if($clic==5){?>
            <li  class="lienpr lienprclic"><a href="../saison/Router_saison.php">Saisons</a></li>
            <?php
          }else{
            ?>
            <li  class="lienpr"><a href="../saison/Router_saison.php">Saisons</a></li>
            <?php
            
          }?>
          <?php
            if($clic==6){?>
            <li  class="lienpr lienprclic"><a href="../fetes/Router_fetes.php">Fêtes</a></li>
            <?php
          }else{
            ?>
            <li  class="lienpr"><a href="../fetes/Router_fetes.php">Fêtes</a></li>
            <?php
            
          }?>
          <?php
            if($clic==7){?>
            <li  class="lienpr lienprclic"><a href="../Nutrition/Router_Nutrition.php">Nutrition</a></li>
            <?php
          }else{
            ?>
            <li  class="lienpr"><a href="../Nutrition/Router_Nutrition.php">Nutrition</a></li>
            <?php
            
          }?>
          <?php
            if($clic==8){?>
            <li  class="lienpr lienprclic"><a href="#">Contact</a></li>
            <?php
          }else{
            ?>
            <li  class="lienpr"><a href="#">Contact</a></li>
            <?php
            
          }?>
           </ul>
       </div>
        <?php
    }
    private function diaporama(){

      ?>
      <div class="diap">
        <div class="img">
        <?php
         $c=new Controler();
         $res=$c->get_diaporama();
        
         for ($i = 0; $i <count($res); $i++) {
          if($res[$i]["id_recette"]!=NULL){
            $rec=$c->get_recette($res[$i]["id_recette"]);
            echo '<a href="../Details_recette/Router_Details_recette.php?id='.$rec[0]["id_recette"].'"> <img src="'.$rec[0]["image"].'" title="agriculture" alt="agriculture" width="100%" height="600px"></a>';
          }
          else{
            $rec=$c->get_new($res[$i]["id_news"]);
            echo '<a href="../Details_news/Router_Details_news.php?id='.$rec[0]["id_news"].'"> <img src="'.$rec[0]["image"].'" title="agriculture" alt="agriculture" width="100%" height="600px"></a>';
          }
         }
        ?>
        
        </div>
           
    </div>
    <?php
    }
    private function categorie($categorie,$catid){
        ?>
        <div class="categories">
          <?php
          echo '<button class="but" onclick="window.open(\'../Categorie/Router_categorie.php?id='.$catid.'\',\'_self\')">'.$categorie.'</button>';
          ?>
           </div>
           <div class="reccont">
            <?php 
             $c=new Controler();
             $res=$c->get_recettes($catid);
             for ($i = 0; $i <count($res); $i++) {
              if($res[$i]["validate"]==1){
              echo '<div class="recettecard">
              <img src="'.$res[$i]["image"].'" alt="burger" id="recette" style="width:100%">
              <div class="container">
                <h4><b>'.$res[$i]["titre"].'</b></h4>
                <p class="desc">'.$res[$i]["description"].'</p>
                <a target="_blank" id="afficherlasuite" href="../Details_recette/Router_Details_recette.php?id='.$res[$i]["id_recette"].'">afficher la suite</a>
              </div>
            </div>';
              }
            }
            ?>
</div>
        <?php
    }
    public function footer(){
        ?>
        <div class="footer">
    <h4>Bienvenue sur Mesrecettes.com ! Nous vous proposons Les meilleurs recettes</h4>
    <p>Tous droits réservés Mesrecettes.com</p>
    <ul>
        <div>
            <li ><a href="../Accueil/Router_Accueil.php">Accueil</a></li>
            <li ><a  href="../News/Router_news.php" >News</a></li>
            <li ><a  href="../idees_recette/Router_idees_recette.php">Idées de recette</a></li>
            <li ><a  href="../healthy/Router_healthy.php" > Healthy</a>   </li>
        </div>
        <div >
            <li ><a  href="../saison/Router_saison.php" > saisons</a>   </li>
            <li ><a  href="../fetes/Router_fetes.php" > Fêtes</a>   </li>
            <li  ><a  href="../Nutrition/Router_Nutrition.php" > Nutrition</a>   </li>
            <li ><a  href="#" > Contact</a>   </li>
        </div>
       
       </ul>
</div>
        <?php
    }
    public function afficher_site(){
        ?>
        <!DOCTYPE html>
            <html>
        <?php
        $this->entete_page("Accueil","./master_Accueil.css");
        ?>
        <body>
            <?php
            $this->navbar(1); 
            $this->diaporama();
            $this->categorie("Entrées",1);
            $this->categorie("Plats",2);
            $this->categorie("Desserts",3);
            $this->categorie("Boissons",4);
            $this->footer();
            ?>
            </body>
            </html>
            <?php
            
    }
}