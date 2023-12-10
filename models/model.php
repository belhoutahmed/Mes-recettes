<?php
require_once('../../controlers/controler.php');
header('Content-type: text/html; charset=UTF-8');
class model{
    private $host="localhost";
    private $dbname="TDW";
    private $username="root";
    private $password="";
    private function connection($host,$dbname,$username,$password){
        try {
            $conn = new PDO("mysql:host=$host;dbname=$dbname;",$username,$password);
           
            $conn->exec("SET NAMES utf8mb4");
        } catch (Exception $ex) {
         echo $ex->getMessage();
        }
        return $conn;
    }
    private function deconnexion(&$conn){
        $conn=null;
    }
    public function get_recettes($catid){
        $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
        $request=$conn->prepare("select * from recette WHERE id_categorie=:catid");
        $request->bindParam("catid",$catid);
        $request->execute();
          $res=$request->fetchAll(PDO::FETCH_ASSOC);
          $this->deconnexion($conn);
          return $res; 
    }
    public function delete_ingredient($id_ingredient){
      $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
        $request=$conn->prepare("DELETE FROM ingredient WHERE id_ingredient=:id_ingredient");
        $request->bindParam("id_ingredient",$id_ingredient);
        $request->execute();
        $request=$conn->prepare("DELETE FROM info WHERE id_ingredient=:id_ingredient");
        $request->bindParam("id_ingredient",$id_ingredient);
        $request->execute();
        $request=$conn->prepare("DELETE FROM apartenir_saison WHERE id_ingredient=:id_ingredient");
        $request->bindParam("id_ingredient",$id_ingredient);
        $request->execute();
          $this->deconnexion($conn);
    }
    public function ajouter_ingredient($name,$calories,$glucide,$lipides,$minereaux,$vitamines,$saison,$healthy,$proportion){
      $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
      $request=$conn->prepare("select max(id_ingredient) length from ingredient");
      $request->execute();
      $res=$request->fetchAll(PDO::FETCH_ASSOC);
      $id=$res[0]["length"]+1;
      $request=$conn->prepare("INSERT INTO `ingredient` ( `id_ingredient`,`name`,`healthy`,`proportion`,`calories`) VALUES
       ( :id,:namee, :healthy,:proportion,:calories)");
       $request->bindParam("id",$id);
      $request->bindParam("namee",$name);
      $request->bindParam("healthy",$healthy);
      $request->bindParam("proportion",$proportion);
      $request->bindParam("calories",$calories);
      $request->execute();
      $request=$conn->prepare("INSERT INTO `info` ( `glucides`,`lipides`,`minéraux`,`vitamines`,`id_ingredient`) VALUES
      (:glucides,:lipides,:minereaux,:vitamines,:id)");
      $request->bindParam("glucides",$glucide);
      $request->bindParam("lipides",$lipides);
      $request->bindParam("minereaux",$minereaux);
      $request->bindParam("vitamines",$vitamines);
      $request->bindParam("id",$id);
      $request->execute();
      if($saison<=4){
      $request=$conn->prepare("INSERT INTO `apartenir_saison` (`id_ingredient`,`id_saison`) VALUES
      (:id,:saison)");
      $request->bindParam("id",$id);
      $request->bindParam("saison",$saison);
      $request->execute();
    }
      $this->deconnexion($conn);
    }
    public function modifier_ingredient($id,$name,$calories,$glucide,$lipides,$minereaux,$vitamines,$saison,$healthy,$proportion){
      $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
      $request=$conn->prepare("UPDATE ingredient SET name= :namee, healthy = :healthy, proportion = :proportion,calories = :calories WHERE id_ingredient = :id ");
      $request->bindParam("id",$id);
      $request->bindParam("namee",$name);
      $request->bindParam("healthy",$healthy);
      $request->bindParam("proportion",$proportion);
      $request->bindParam("calories",$calories);
      $request->execute();
      $request=$conn->prepare("UPDATE info SET glucides= :glucides, lipides = :lipides, minéraux = :minereaux,vitamines = :vitamines WHERE id_ingredient = :id ");
      $request->bindParam("glucides",$glucide);
      $request->bindParam("lipides",$lipides);
      $request->bindParam("minereaux",$minereaux);
      $request->bindParam("vitamines",$vitamines);
      $request->bindParam("id",$id);
      $request->execute();
      if($saison<=4){
        $request=$conn->prepare("UPDATE apartenir_saison SET id_saison= :saison WHERE id_ingredient = :id ");
        $request->bindParam("id",$id);
      $request->bindParam("saison",$saison);
      $request->execute();
      }
      $this->deconnexion($conn);
    }
    public function valider_user($id,$valider){
      $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
      $request=$conn->prepare("UPDATE user SET validate= :valider WHERE id_user=:id");
      $request->bindParam("id",$id);
      $request->bindParam("valider",$valider);
      $request->execute();
        $this->deconnexion($conn);
  }
  public function supprimer_user($id){
    $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
    $request=$conn->prepare("DELETE from user WHERE id_user=:id");
    $request->bindParam("id",$id);
    $request->execute();
      $this->deconnexion($conn);
}

    public function get_recette($id){
        $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
        $request=$conn->prepare("select * from recette WHERE id_recette=:id");
        $request->bindParam("id",$id);
        $request->execute();
          $res=$request->fetchAll(PDO::FETCH_ASSOC);
          $this->deconnexion($conn);
          return $res;
    }
    public function get_etapes($id_recette){
        $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
        $request=$conn->prepare("select * from etape WHERE id_recette=:id");
        $request->bindParam("id",$id_recette);
        $request->execute();
          $res=$request->fetchAll(PDO::FETCH_ASSOC);
          $this->deconnexion($conn);
          return $res;
    }
    public function get_ingredients_recette($id_recette){
        $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
        $request=$conn->prepare("select * from contenir_ingredient WHERE id_recette=:id");
        $request->bindParam("id",$id_recette);
        $request->execute();
          $res=$request->fetchAll(PDO::FETCH_ASSOC);
          $this->deconnexion($conn);
          return $res;
    }
    public function get_user($email,$pass){
      $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
        $request=$conn->prepare("select * from user WHERE email=:email and hash_pwd=:pass");
        $request->bindParam("email",$email);
        $request->bindParam("pass",$pass);
        $request->execute();
          $res=$request->fetchAll(PDO::FETCH_ASSOC);
          $this->deconnexion($conn);
          return $res;
    }
    public function filtre_users($sexe,$valider,$trier){
      $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
      $rec="select * from user where 1";
      if($sexe!=0){
        if($sexe==1) $rec=$rec." and sexe='M'";
        else $rec=$rec." and sexe='F'";
      }
      if($valider!=0){
        if($valider==1) $rec=$rec." and validate=1";
        else $rec=$rec." and validate=0";
      }
      if($trier!=0){
        if($trier==1) $rec=$rec." order by name";
        else $rec=$rec." order by date_naissance";
      }
        $request=$conn->prepare($rec);
        $request->execute();
          $res=$request->fetchAll(PDO::FETCH_ASSOC);
          $this->deconnexion($conn);
          return $res;
    }
    public function get_prefered_recettes($id_user){
      $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
        $request=$conn->prepare("select recette.* from recette join 
        (select * from preferance where id_user=:id) D on recette.id_recette=D.id_recette");
        $request->bindParam("id",$id_user);
        $request->execute();
          $res=$request->fetchAll(PDO::FETCH_ASSOC);
          $this->deconnexion($conn);
          return $res;
    }
    public function get_user_info($id){
      $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
        $request=$conn->prepare("select * from user WHERE id_user=:id");
        $request->bindParam("id",$id);
        $request->execute();
          $res=$request->fetchAll(PDO::FETCH_ASSOC);
          $this->deconnexion($conn);
          return $res;
    }
    public function add_user($name,$email,$password,$birthdate,$gender){
      $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
      $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
      $request=$conn->prepare("select max(id_user) length from user");
      $request->execute();
      $res=$request->fetchAll(PDO::FETCH_ASSOC);
      $id=$res[0]["length"]+1;
        $request=$conn->prepare("INSERT INTO `user` (`id_user`,`name`, `email`,`hash_pwd`,`sexe`,`date_naissance`,validate) VALUES
        (:id,:namee,:email,:passworde,:gender,:birthdate,FALSE);");
        $request->bindParam("id",$id);
        $request->bindParam("namee",$name);
        $request->bindParam("email",$email);
        $request->bindParam("passworde",$password);
        $request->bindParam("gender",$gender);
        $request->bindParam("birthdate",$birthdate);
        $request->execute();
          $this->deconnexion($conn);
          return $id;
    }
    public function get_ingredients($id){
        $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
        $request=$conn->prepare("select * from ingredient WHERE id_ingredient=:id");
        $request->bindParam("id",$id);
        $request->execute();
          $res=$request->fetchAll(PDO::FETCH_ASSOC);
          $this->deconnexion($conn);
          return $res;
    }
    public function get_recettes_idees($ids){
      $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
      $rec="Select * from (SELECT recette.*,COUNT(*) contenir from recette 
      join contenir_ingredient on recette.id_recette=contenir_ingredient.id_recette WHERE ";
      $list=explode(' ',$ids);
      $len=count($list)-1;
      $pou=($this->get_parametre()[0]["pourcentage"])/100;
      for ($i = 1; $i <count($list); $i++) {
         if($i==count($list)-1){
            $rec=$rec.' contenir_ingredient.id_ingredient='.$list[$i].' ';
         }
         else{
          $rec=$rec.' contenir_ingredient.id_ingredient='.$list[$i].' or ';
         }
      }
      $rec=$rec.' GROUP by recette.id_recette) D WHERE (contenir/'.$len.')>=:pourcentage';
      
      $request=$conn->prepare($rec);
      $request->bindParam("pourcentage",$pou);
      $request->execute();
        $res=$request->fetchAll(PDO::FETCH_ASSOC);
        $this->deconnexion($conn);
        return $res;
  }
    public function get_all_ingredients($recherche){
        $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
        if($recherche==NULL) $request=$conn->prepare("select * from ingredient");
        else{
            $request=$conn->prepare("select * from ingredient WHERE name like '%$recherche%'");
        }
        $request->execute();
          $res=$request->fetchAll(PDO::FETCH_ASSOC);
          $this->deconnexion($conn);
          return $res;
    }
    public function get_recettes_healthy(){
      $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
      $pourcentage=($this->get_parametre()[1]["pourcentage"])/100;
      $seuil=$this->get_parametre()[2]["pourcentage"];
       $request=$conn->prepare("SELECT recette.*,M.moy,R.contenir,R.total from recette join  
       (SELECT recette.id_recette,AVG(ingredient.calories) moy  from recette join contenir_ingredient 
       on recette.id_recette=contenir_ingredient.id_recette join ingredient on contenir_ingredient.id_ingredient=ingredient.id_ingredient 
       GROUP by recette.id_recette) M on recette.id_recette=M.id_recette join 
       (select D.id_recette,D.total,C.contenir from (select recette.id_recette,count(*) total 
       from recette join contenir_ingredient on recette.id_recette=contenir_ingredient.id_recette 
       GROUP by recette.id_recette) D join (SELECT recette.id_recette,count(*) contenir from recette
        join contenir_ingredient on recette.id_recette=contenir_ingredient.id_recette join ingredient 
        on contenir_ingredient.id_ingredient=ingredient.id_ingredient WHERE ingredient.healthy=1 
        GROUP by recette.id_recette) C on D.id_recette=C.id_recette
        WHERE (contenir/total)>=:pourcentage) R on recette.id_recette=R.id_recette WHERE M.moy<=:seuil");
         $request->bindParam("pourcentage",$pourcentage);
         $request->bindParam("seuil",$seuil);
      $request->execute();
        $res=$request->fetchAll(PDO::FETCH_ASSOC);
        $this->deconnexion($conn);
        return $res;
  }
    public function get_all_info(){
      $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
     $request=$conn->prepare("select * from info");
      $request->execute();
        $res=$request->fetchAll(PDO::FETCH_ASSOC);
        $this->deconnexion($conn);
        return $res;
  }
  public function get_apartenir_saison(){
    $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
   $request=$conn->prepare("select * from apartenir_saison");
    $request->execute();
      $res=$request->fetchAll(PDO::FETCH_ASSOC);
      $this->deconnexion($conn);
      return $res;
}
    public function get_info_ingredient($id_ingredient){
        $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
        $request=$conn->prepare("select * from info WHERE id_ingredient=:id");
        $request->bindParam("id",$id_ingredient);
        $request->execute();
          $res=$request->fetchAll(PDO::FETCH_ASSOC);
          $this->deconnexion($conn);
          return $res;
    }
    public function get_new($id_news){
        $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
        $request=$conn->prepare("select * from news WHERE id_news=:id");
        $request->bindParam("id",$id_news);
        $request->execute();
          $res=$request->fetchAll(PDO::FETCH_ASSOC);
          $this->deconnexion($conn);
          return $res;
    }
    public function verifier_preferance($id_user,$id_recette){
      $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
      $request=$conn->prepare("select * from preferance WHERE id_user=:id_user and id_recette=:id_recette");
      $request->bindParam("id_user",$id_user);
      $request->bindParam("id_recette",$id_recette);
      $request->execute();
        $res=$request->fetchAll(PDO::FETCH_ASSOC);
        $this->deconnexion($conn);
        return $res;
  }
  public function get_recettes_news(){
    $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
    $request=$conn->prepare("select recette.*,news.id_news from recette LEFT join news on recette.id_recette=news.id_recette");
    $request->execute();
      $res=$request->fetchAll(PDO::FETCH_ASSOC);
      $this->deconnexion($conn);
      return $res;
}
public function get_admin($email,$password){
  $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
  $request=$conn->prepare("select * from admin where email=:email and hash_pwd=:password");
  $request->bindParam("email",$email);
  $request->bindParam("password",$password);
  $request->execute();
    $res=$request->fetchAll(PDO::FETCH_ASSOC);
    $this->deconnexion($conn);
    return $res;
}
  public function add_preferance($id_user,$id_recette){
    $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
    $request=$conn->prepare("INSERT INTO `preferance` (`id_user`,`id_recette`) VALUES
    (:id_user,:id_recette)");
    $request->bindParam("id_user",$id_user);
    $request->bindParam("id_recette",$id_recette);
    $request->execute();
      $this->deconnexion($conn);
}
public function add_news($id_recette){
  $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
  $request=$conn->prepare("INSERT INTO `news` (`id_recette`) VALUES
  (:id_recette)");
  $request->bindParam("id_recette",$id_recette);
  $request->execute();
    $this->deconnexion($conn);
}
public function get_parametre(){
  $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
  $request=$conn->prepare("SELECT * from parametre");
  $request->execute();
  $res=$request->fetchAll(PDO::FETCH_ASSOC);
  $this->deconnexion($conn);
  return $res;
}
public function change_parametre($value,$index){
  $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
  $request=$conn->prepare("UPDATE parametre SET pourcentage= :val Where id_parametre=:index");
  $request->bindParam("val",$value);
  $request->bindParam("index",$index);
  $request->execute();
  $this->deconnexion($conn);

}
public function remove_preferance($id_user,$id_recette){
  $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
  $request=$conn->prepare("DELETE from preferance WHERE id_user=:id_user and id_recette=:id_recette");
  $request->bindParam("id_user",$id_user);
  $request->bindParam("id_recette",$id_recette);
  $request->execute();
    $this->deconnexion($conn);
}
public function supprimer_recette($id_recette){
  $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
  $request=$conn->prepare("DELETE from recette WHERE id_recette=:id_recette");
  $request->bindParam("id_recette",$id_recette);
  $request->execute();
    $this->deconnexion($conn);
}
public function valider_recette($id_recette,$val){
  $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
  $request=$conn->prepare("UPDATE recette SET validate= :val WHERE id_recette = :id ");
  $request->bindParam("id",$id_recette);
  $request->bindParam("val",$val);
  $request->execute();
    $this->deconnexion($conn);
}
public function supprimer_news($id_news){
  $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
  $request=$conn->prepare("DELETE from news WHERE id_news=:id_news");
  $request->bindParam("id_news",$id_news);
  $request->execute();
    $this->deconnexion($conn);
}
    public function get_notation($id_recette){
      $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
      $request=$conn->prepare("SELECT *,AVG(note) noter from recette LEFT join notation on recette.id_recette=notation.id_recette WHERE recette.id_recette=:id GROUP BY
      recette.id_recette");
      $request->bindParam("id",$id_recette);
      $request->execute();
        $res=$request->fetchAll(PDO::FETCH_ASSOC);
        $this->deconnexion($conn);
        return $res;
  }
    public function get_saison_of_ingredient($id_ingredient){
        $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
        $request=$conn->prepare("select saison.* from saison JOIN apartenir_saison ON saison.id_saison=apartenir_saison.id_saison and apartenir_saison.id_ingredient=:id");
        $request->bindParam("id",$id_ingredient);
        $request->execute();
        $res=$request->fetchAll(PDO::FETCH_ASSOC);
          $this->deconnexion($conn);
          return $res;
    }
    public function get_news(){
        $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
        $request=$conn->prepare("select * from news");
        $request->execute();
          $res=$request->fetchAll(PDO::FETCH_ASSOC);
          $this->deconnexion($conn);
          return $res;
    }
    public function get_new_of_diapo($id,$type){
      $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
      if($type==1) $request=$conn->prepare("select * from diaporama where id_news=:id");
      else $request=$conn->prepare("select * from diaporama where id_recette=:id");
      $request->bindParam("id",$id);
      $request->execute();
        $res=$request->fetchAll(PDO::FETCH_ASSOC);
        $this->deconnexion($conn);
        return $res;
  }
  public function add_diapo($id,$type){
    $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
    if($type==1) $request=$conn->prepare("INSERT INTO `diaporama` (`id_news`) VALUES
    (:id)");
    else $request=$conn->prepare("INSERT INTO `diaporama` (`id_recette`) VALUES
    (:id)");
    $request->bindParam("id",$id);
    $request->execute();
      $this->deconnexion($conn);
  
}
public function delete_diapo($id_news,$type){
  $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
  if($type==1) $request=$conn->prepare("DELETE FROM diaporama WHERE id_news=:id");
  else $request=$conn->prepare("DELETE FROM diaporama WHERE id_recette=:id");
  $request->bindParam("id",$id_news);
  $request->execute();
    $this->deconnexion($conn);
}

    public function get_diaporama(){
        $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
        $request=$conn->prepare("select * from diaporama");
        $request->execute();
          $res=$request->fetchAll(PDO::FETCH_ASSOC);
          $this->deconnexion($conn);
          return $res;
    }
    public function filtre($categorie,$saison,$trier){
      $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
      $rec="";
      if($categorie!=0){
        $rec="SELECT recette.* from recette where recette.id_categorie=:id_categorie";
      }
      if($saison!=0){
        if($rec==""){
          $rec="SELECT G.* from (select R.*,max(R.sais) from 
          (select recette.*,apartenir_saison.id_saison,COUNT(apartenir_saison.id_saison) 
          sais from recette join contenir_ingredient on recette.id_recette=contenir_ingredient.id_recette 
          LEFT join apartenir_saison on contenir_ingredient.id_ingredient=apartenir_saison.id_ingredient GROUP by recette.id_recette,apartenir_saison.id_saison) 
          R WHERE R.id_saison is NOT NULL GROUP by R.id_recette) G where G.id_saison=:id_saison";
        }
        else{
          $rec="SELECT G.* from (select R.*,max(R.sais) from 
          (select recette.*,apartenir_saison.id_saison,COUNT(apartenir_saison.id_saison) 
          sais from recette join contenir_ingredient on recette.id_recette=contenir_ingredient.id_recette 
          LEFT join apartenir_saison on contenir_ingredient.id_ingredient=apartenir_saison.id_ingredient GROUP by recette.id_recette,apartenir_saison.id_saison) 
          R WHERE R.id_saison is NOT NULL GROUP by R.id_recette) G where G.id_saison=:id_saison and G.id_categorie=:id_categorie";
        }
      }
      if($trier!=0){
        if($trier==4){
        if($rec==""){
          $rec="SELECT recette.*,AVG(note) noter from recette LEFT join notation on recette.id_recette=notation.id_recette GROUP BY
          recette.id_recette ORDER BY noter DESC";
        }
        else{
          if($saison!=0){
          $rec="select * from (SELECT G.* from (select R.*,max(R.sais) from 
          (select recette.*,apartenir_saison.id_saison,COUNT(apartenir_saison.id_saison) 
          sais from recette join contenir_ingredient on recette.id_recette=contenir_ingredient.id_recette 
          LEFT join apartenir_saison on contenir_ingredient.id_ingredient=apartenir_saison.id_ingredient GROUP by recette.id_recette,apartenir_saison.id_saison) 
          R WHERE R.id_saison is NOT NULL GROUP by R.id_recette) G where G.id_saison=:id_saison) M JOIN (SELECT recette.*,AVG(note) noter from recette LEFT join notation on recette.id_recette=notation.id_recette GROUP BY
          recette.id_recette ) Y on M.id_recette=Y.id_recette ORDER BY Y.noter DESC";
          }
          if($categorie!=0){
            $rec="SELECT recette.*,AVG(note) noter from recette  LEFT join notation on recette.id_recette=notation.id_recette 
            where recette.id_categorie=:id_categorie GROUP BY recette.id_recette ORDER BY noter DESC";
          }
          if($saison!=0 and $categorie!=0){
            $rec="select * from (SELECT G.* from (select R.*,max(R.sais) from 
          (select recette.*,apartenir_saison.id_saison,COUNT(apartenir_saison.id_saison) 
          sais from recette join contenir_ingredient on recette.id_recette=contenir_ingredient.id_recette 
          LEFT join apartenir_saison on contenir_ingredient.id_ingredient=apartenir_saison.id_ingredient GROUP by recette.id_recette,apartenir_saison.id_saison) 
          R WHERE R.id_saison is NOT NULL GROUP by R.id_recette) G where G.id_saison=:id_saison AND G.id_categorie=:id_categorie) M JOIN (SELECT recette.*,AVG(note) noter from recette LEFT join notation on recette.id_recette=notation.id_recette GROUP BY
          recette.id_recette ) Y on M.id_recette=Y.id_recette ORDER BY Y.noter DESC";
          }
        }
      }
        if($trier==1){
          if($rec==""){
            $rec="SELECT recette.* from recette ORDER by recette.temps_preparation";
          }
          else{
            if($saison!=0){
            $rec="SELECT G.* from (select R.*,max(R.sais) from 
            (select recette.*,apartenir_saison.id_saison,COUNT(apartenir_saison.id_saison) 
            sais from recette join contenir_ingredient on recette.id_recette=contenir_ingredient.id_recette 
            LEFT join apartenir_saison on contenir_ingredient.id_ingredient=apartenir_saison.id_ingredient GROUP by recette.id_recette,apartenir_saison.id_saison) 
            R WHERE R.id_saison is NOT NULL GROUP by R.id_recette) G where G.id_saison=:id_saison ORDER by G.temps_preparation";
            }
            if($categorie!=0){
              $rec="SELECT recette.* from recette where recette.id_categorie=:id_categorie ORDER by recette.temps_preparation";
            }
            if($categorie!=0 and $saison!=0){
              $rec="SELECT G.* from (select R.*,max(R.sais) from 
            (select recette.*,apartenir_saison.id_saison,COUNT(apartenir_saison.id_saison) 
            sais from recette join contenir_ingredient on recette.id_recette=contenir_ingredient.id_recette 
            LEFT join apartenir_saison on contenir_ingredient.id_ingredient=apartenir_saison.id_ingredient GROUP by recette.id_recette,apartenir_saison.id_saison) 
            R WHERE R.id_saison is NOT NULL GROUP by R.id_recette) G where G.id_saison=:id_saison AND G.id_categorie=:id_categorie ORDER by G.temps_preparation";
            }
          }
      }
      if($trier==2){
        if($rec==""){
          $rec="SELECT recette.* from recette ORDER by recette.temps_cuisant";
        }
        else{
          if($saison!=0){
          $rec="SELECT G.* from (select R.*,max(R.sais) from 
          (select recette.*,apartenir_saison.id_saison,COUNT(apartenir_saison.id_saison) 
          sais from recette join contenir_ingredient on recette.id_recette=contenir_ingredient.id_recette 
          LEFT join apartenir_saison on contenir_ingredient.id_ingredient=apartenir_saison.id_ingredient GROUP by recette.id_recette,apartenir_saison.id_saison) 
          R WHERE R.id_saison is NOT NULL GROUP by R.id_recette) G where G.id_saison=:id_saison ORDER by G.temps_cuisant";
          }
          if($categorie!=0){
            $rec="SELECT recette.* from recette where recette.id_categorie=:id_categorie ORDER by recette.temps_cuisant";
          }
          if($categorie!=0 and $saison!=0){
            $rec="SELECT G.* from (select R.*,max(R.sais) from 
          (select recette.*,apartenir_saison.id_saison,COUNT(apartenir_saison.id_saison) 
          sais from recette join contenir_ingredient on recette.id_recette=contenir_ingredient.id_recette 
          LEFT join apartenir_saison on contenir_ingredient.id_ingredient=apartenir_saison.id_ingredient GROUP by recette.id_recette,apartenir_saison.id_saison) 
          R WHERE R.id_saison is NOT NULL GROUP by R.id_recette) G where G.id_saison=:id_saison  AND G.id_categorie=:id_categorie ORDER by G.temps_cuisant";
          }
        }
    }
    if($trier==3){
      if($rec==""){
        $rec="SELECT recette.*,recette.temps_preparation+recette.temps_repos+recette.temps_cuisant as total from recette ORDER by total";
      }
      else{
        if($saison!=0){
        $rec="SELECT G.*,G.temps_preparation+G.temps_repos+G.temps_cuisant as total from (select R.*,max(R.sais) from 
        (select recette.*,apartenir_saison.id_saison,COUNT(apartenir_saison.id_saison) 
        sais from recette join contenir_ingredient on recette.id_recette=contenir_ingredient.id_recette 
        LEFT join apartenir_saison on contenir_ingredient.id_ingredient=apartenir_saison.id_ingredient GROUP by recette.id_recette,apartenir_saison.id_saison) 
        R WHERE R.id_saison is NOT NULL GROUP by R.id_recette) G where G.id_saison=:id_saison ORDER by total";
        }
        if($categorie!=0){
          $rec="SELECT recette.*,recette.temps_preparation+recette.temps_repos+recette.temps_cuisant as total from recette where recette.id_categorie=:id_categorie ORDER by total";
        }
        if($saison!=0 and $categorie!=0){
          $rec="SELECT G.*,G.temps_preparation+G.temps_repos+G.temps_cuisant as total from (select R.*,max(R.sais) from 
        (select recette.*,apartenir_saison.id_saison,COUNT(apartenir_saison.id_saison) 
        sais from recette join contenir_ingredient on recette.id_recette=contenir_ingredient.id_recette 
        LEFT join apartenir_saison on contenir_ingredient.id_ingredient=apartenir_saison.id_ingredient GROUP by recette.id_recette,apartenir_saison.id_saison) 
        R WHERE R.id_saison is NOT NULL GROUP by R.id_recette) G where G.id_saison=:id_saison AND G.id_categorie=:id_categorie ORDER by total";
        }
      }
  }
  if($trier==5){
    if($rec==""){
         $rec="SELECT B.*,SUM(CASE WHEN B.unite is NULL THEN B.quantite/100*ingredient.calories ELSE B.quantite*B.`quantite en unite`/100*ingredient.calories END) cal from (select recette.*,contenir_ingredient.id_ingredient,contenir_ingredient.quantite,contenir_ingredient.unite,
         contenir_ingredient.`quantite en unite` from recette join contenir_ingredient on recette.id_recette=contenir_ingredient.id_recette) B 
         JOIN ingredient WHERE B.id_ingredient=ingredient.id_ingredient  GROUP by id_recette ORDER by cal";
    }
    if($saison!=0){
       $rec="SELECT * from (select R.*,max(R.sais) from 
       (select recette.*,apartenir_saison.id_saison,COUNT(apartenir_saison.id_saison) 
       sais from recette join contenir_ingredient on recette.id_recette=contenir_ingredient.id_recette 
       LEFT join apartenir_saison on contenir_ingredient.id_ingredient=apartenir_saison.id_ingredient GROUP by recette.id_recette,apartenir_saison.id_saison) 
       R WHERE R.id_saison is NOT NULL GROUP by R.id_recette) G join (SELECT B.id_recette,SUM(CASE WHEN B.unite is NULL THEN B.quantite/100*ingredient.calories ELSE B.quantite*B.`quantite en unite`/100*ingredient.calories END) cal from (select recette.id_recette,contenir_ingredient.id_ingredient,contenir_ingredient.quantite,contenir_ingredient.unite,
      contenir_ingredient.`quantite en unite` from recette join contenir_ingredient on recette.id_recette=contenir_ingredient.id_recette) B 
      JOIN ingredient WHERE B.id_ingredient=ingredient.id_ingredient  GROUP by id_recette ORDER by cal)T WHERE G.id_recette=T.id_recette and G.id_saison=:id_saison ORDER by cal";
    }
    if($categorie!=0){
       $rec="SELECT *,SUM(CASE WHEN B.unite is NULL THEN B.quantite/100*ingredient.calories ELSE B.quantite*B.`quantite en unite`/100*ingredient.calories END) cal from 
       (select recette.*,contenir_ingredient.id_ingredient,contenir_ingredient.quantite,contenir_ingredient.unite,contenir_ingredient.`quantite en unite` from recette join contenir_ingredient on recette.id_recette=contenir_ingredient.id_recette WHERE recette.id_categorie=:id_categorie) B JOIN 
       ingredient WHERE B.id_ingredient=ingredient.id_ingredient  GROUP by id_recette ORDER by cal";
    }
    if($categorie!=0 and $saison!=0){
      $rec="SELECT * from (select R.*,max(R.sais) from 
      (select recette.*,apartenir_saison.id_saison,COUNT(apartenir_saison.id_saison) 
      sais from recette join contenir_ingredient on recette.id_recette=contenir_ingredient.id_recette 
      LEFT join apartenir_saison on contenir_ingredient.id_ingredient=apartenir_saison.id_ingredient GROUP by recette.id_recette,apartenir_saison.id_saison) 
      R WHERE R.id_saison is NOT NULL GROUP by R.id_recette) G join (SELECT B.id_recette,SUM(CASE WHEN B.unite is NULL THEN B.quantite/100*ingredient.calories ELSE B.quantite*B.`quantite en unite`/100*ingredient.calories END) cal from (select recette.id_recette,contenir_ingredient.id_ingredient,contenir_ingredient.quantite,contenir_ingredient.unite,
     contenir_ingredient.`quantite en unite` from recette join contenir_ingredient on recette.id_recette=contenir_ingredient.id_recette where recette.id_categorie=:id_categorie) B 
     JOIN ingredient WHERE B.id_ingredient=ingredient.id_ingredient  GROUP by id_recette ORDER by cal)T WHERE G.id_recette=T.id_recette and G.id_saison=:id_saison ORDER BY cal";
    }
  }
    
    }
      $request=$conn->prepare($rec);
      if($saison!=0) $request->bindParam("id_saison",$saison);
      if($categorie!=0) $request->bindParam("id_categorie",$categorie);
      $request->execute();
        $res=$request->fetchAll(PDO::FETCH_ASSOC);
        $this->deconnexion($conn);
        return $res;
  }

    public function get_recettes_of_fete($id_fetes){
        $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
        $request=$conn->prepare("SELECT recette.* from recette JOIN fetes_recette on recette.id_recette=fetes_recette.id_recette AND fetes_recette.id_fetes=:id");
        $request->bindParam("id",$id_fetes);
        $request->execute();
          $res=$request->fetchAll(PDO::FETCH_ASSOC);
          $this->deconnexion($conn);
          return $res;
    }
    public function get_note($id_user,$id_recette){
      $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
      $request=$conn->prepare("SELECT * from notation WHERE id_utilisateur=:id and id_recette=:id_recette");
      $request->bindParam("id",$id_user);
      $request->bindParam("id_recette",$id_recette);
      $request->execute();
        $res=$request->fetchAll(PDO::FETCH_ASSOC);
        $this->deconnexion($conn);
        return $res;
  }
  public function modifier_note($id_user,$id_recette,$note){
    $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
    $request=$conn->prepare("UPDATE notation SET note= :note WHERE id_utilisateur=:id and id_recette=:id_recette");
    $request->bindParam("note",$note);
    $request->bindParam("id",$id_user);
    $request->bindParam("id_recette",$id_recette);
    $request->execute();
      $this->deconnexion($conn);
}
public function add_note($id_user,$id_recette,$note){
  $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
  $request=$conn->prepare("INSERT INTO `notation` (`id_utilisateur`,`id_recette`,`note`) VALUES
  (:id,:id_recette,:note);");
  $request->bindParam("id",$id_user);
  $request->bindParam("id_recette",$id_recette);
  $request->bindParam("note",$note);
  $request->execute();
    $this->deconnexion($conn);
}
    
    public function get_all_recettes(){
        $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
        $request=$conn->prepare("select * from recette");
        $request->execute();
          $res=$request->fetchAll(PDO::FETCH_ASSOC);
          $this->deconnexion($conn);
          return $res;
    }
    public function get_all_users(){
      $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
      $request=$conn->prepare("select * from user");
      $request->execute();
        $res=$request->fetchAll(PDO::FETCH_ASSOC);
        $this->deconnexion($conn);
        return $res;
  }
    public function get_saison_of_recette($id_recette){
        $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
        $request=$conn->prepare("select * from contenir_ingredient WHERE id_recette=:id");
        $request->bindParam("id",$id_recette);
        $request->execute();
        $res=$request->fetchAll(PDO::FETCH_ASSOC);
        $ete=0;
        $hiver=0;
        $automn=0;
        $printemp=0;
        for ($i = 0; $i <count($res); $i++) {
             $sais=$this->get_saison_of_ingredient($res[$i]["id_ingredient"]);
             if($sais!=NULL){
                if($sais[0]["id_saison"]==1)  $ete=$ete+1        ;
                if($sais[0]["id_saison"]==2)   $printemp=$printemp+1       ;
                if($sais[0]["id_saison"]==3)   $hiver=$hiver+1       ;
                if($sais[0]["id_saison"]==4)    $automn=$automn+1      ;
                   }
                
        }
          $this->deconnexion($conn);
          if(max($ete,$hiver,$automn,$printemp)!=0){
          if(max($ete,$hiver,$automn,$printemp)==$ete) return 1;
          if(max($ete,$hiver,$automn,$printemp)==$printemp) return 2;
          if(max($ete,$hiver,$automn,$printemp)==$hiver) return 3;
          if(max($ete,$hiver,$automn,$printemp)==$automn) return 4;
          }
          else return NULL;
    }
    public function get_recettes_of_saisons($id_saison){
      $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
      $request=$conn->prepare("SELECT G.* from (select R.*,max(R.sais) from (select recette.*,
      apartenir_saison.id_saison,COUNT(apartenir_saison.id_saison) sais from recette join 
      contenir_ingredient on recette.id_recette=contenir_ingredient.id_recette LEFT join 
      apartenir_saison on contenir_ingredient.id_ingredient=apartenir_saison.id_ingredient GROUP by recette.id_recette,apartenir_saison.id_saison) 
      R WHERE R.id_saison is NOT NULL GROUP by R.id_recette) G where G.id_saison=:id");
        $request->bindParam("id",$id_saison);
      $request->execute();
        $res=$request->fetchAll(PDO::FETCH_ASSOC);
        $this->deconnexion($conn);
        return $res;
    }
    public function get_calories_recette($id_recette){
        $ingredients=$this->get_ingredients_recette($id_recette);
        $calories=0;
        for ($i = 0; $i <count($ingredients); $i++) {
           $ingredient=$this->get_ingredients($ingredients[$i]["id_ingredient"]);
           if($ingredients[$i]["unite"]==NULL){
            $calories=$calories+($ingredients[$i]["quantite"]/100)*$ingredient[0]["calories"];
        }
        else{
            $calories=$calories+($ingredients[$i]["quantite"]*$ingredients[$i]["quantite en unite"]/100)*$ingredient[0]["calories"]; 
        }
        
    }
    return $calories;
    }
    public function get_categorie($id_categorie){
      $conn=$this->connection($this->host,$this->dbname,$this->username,$this->password);
        $request=$conn->prepare("SELECT * from categorie where id_categorie=:id");
        $request->bindParam("id",$id_categorie);
        $request->execute();
          $res=$request->fetchAll(PDO::FETCH_ASSOC);
          $this->deconnexion($conn);
          return $res;
    }

}