<?php

session_start();
header('Content-type: text/html; charset=UTF-8');
require_once('../../vues/user/Accueil.php');
require_once('../../controlers/controler.php');
class login{
    private function signup(){
      ?>
        <div class="container_signup">
        <form method="post" action="">
            <input class="inp" name="prenom"  type="text" placeholder="Prénom" maxlength="16" required>
            <input class="inp" name="nom"  type="text" placeholder="Nom" maxlength="16" >
            <input class="inp" name="email"  type="email" placeholder="Email" maxlength="30" required>
            <div id="inf">
            <input class="inp" name="datebirth"  type="date" placeholder="Nom" maxlength="16" required>
            <select name="gender" class="inp" required>
            <option value="1">Masculin</option>
        <option value="2">Féminin</option>
    </select>
    </div>
            <input class="inp" name="Password"  type="password" placeholder="Password" maxlength="16" required>
            <input class="log" type="submit" value="S'inscrire" name="signup">
        </form>
        <div class="change">
        Vous avez déjà un compte?
          <button id="signin">S'identifier</button>
    </div>
</div>
      <?php
    }
    private function signin(){
      ?>
        <div class="container">
        <form method="post" action="">
            <input class="inp" name="email"  type="email" placeholder="Email" maxlength="30" required>
            <input class="inp" name="Password"  type="password" placeholder="Password" maxlength="16" required>
            <input class="log" type="submit" value="S'identifier" name="login">
        </form>
        <div class="change">
          Vous n'avez pas de compte?
          <button id="signup">S'inscrire</button>
    </div>
</div>
      <?php
    }
    private function authentification(){
        $this->signin();
        $this->signup();
        if(isset($_POST["login"])){
          $c=new controler();
          $res=$c->get_user($_POST["email"],$_POST["Password"]);
          if(count($res)>0){
                  $_SESSION['id_user']=$res[0]["id_user"];
                  $_SESSION['message']="Vous êtes connecté avec succès";
                  header("Location:../Accueil/Router_Accueil.php");
              
             }
          else{
            $r=$c->get_admin($_POST["email"],$_POST["Password"]);
              if(count($r)>0){
              $_SESSION['id_admin']=$r[0]["id_admin"];
              $_SESSION['message']="Vous êtes connecté avec succès";
              header("Location:../home/Router_home.php");
              }
              else{
            $_SESSION['message']="Email erroné ou mo de passe erroné";
            header("Location:../login/Router_login.php");
              }
          }
            }
         
        if(isset($_POST["signup"])){
          $c=new controler();
          if($_POST["gender"]==1) $gender='M';
          else $gender='F';
          $name=$_POST["nom"]." ".$_POST["prenom"];
          $res=$c->add_user($name,$_POST["email"],$_POST["Password"],$_POST["datebirth"],$gender);
          $_SESSION['id_user']=$res;
          $_SESSION['message']="Vous êtes inscrit avec succès";
          header("Location:../Accueil/Router_Accueil.php");
        }

    }
    public function afficher_login(){
        ?>
        <!DOCTYPE html>
            <html>
        <?php
        $c=new Accueil();
        $c->entete_page("Mes recette","./master_login.css");
        ?>
        <body>
            <?php
            $this->authentification();
            ?>
            <script src="../jquery-3.6.1.min.js"></script>
            </body>
            <script  src="./login.js"></script>
            </html>
            <?php
    }
}