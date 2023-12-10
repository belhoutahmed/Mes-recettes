function getdata($saison){
    $.get("./saisons_getter.php",(data)=>{ 
        data = JSON.parse(data);
        console.log(data.length);
       $(".cont_recettes").empty();
       console.log(data);
       data[$saison].forEach(element => {
        let recette=$(`<div class="recettecard">
        <img src="${element.image}" alt="burger" id="recette" style="width:100%">
        <div class="container">
          <h4><b>${element.titre}</b></h4>
          <p class="desc">${element.description}</p>
          <a id="afficherlasuite" href="../Details_recette/Router_Details_recette.php?id=${element.id_recette}">afficher la suite</a>
        </div>
      </div>`);
        $(".cont_recettes").append(recette);
        });
    }
    );
}
$(document).ready(function(){
    $("#all").click(function(){
        $("#all").css("background-color","rgb(142, 206, 223)");
        $("#ete").css("background-color","bisque");
        $("#printemps").css("background-color","bisque");
        $("#hiver").css("background-color","bisque");
        $("#automn").css("background-color","bisque");

        getdata(0);
    });
    $("#ete").click(function(){
        $("#ete").css("background-color","rgb(142, 206, 223)");
        $("#all").css("background-color","bisque");
        $("#printemps").css("background-color","bisque");
        $("#hiver").css("background-color","bisque");
        $("#automn").css("background-color","bisque");
        getdata(1);
    });
    $("#printemps").click(function(){
        $("#printemps").css("background-color","rgb(142, 206, 223)");
        $("#ete").css("background-color","bisque");
        $("#all").css("background-color","bisque");
        $("#hiver").css("background-color","bisque");
        $("#automn").css("background-color","bisque");
        getdata(2);
    });
    $("#hiver").click(function(){
        $("#hiver").css("background-color","rgb(142, 206, 223)");
        $("#ete").css("background-color","bisque");
        $("#printemps").css("background-color","bisque");
        $("#all").css("background-color","bisque");
        $("#automn").css("background-color","bisque");
        getdata(3);
    });
    $("#automn").click(function(){
        $("#automn").css("background-color","rgb(142, 206, 223)");
        $("#ete").css("background-color","bisque");
        $("#printemps").css("background-color","bisque");
        $("#hiver").css("background-color","bisque");
        $("#all").css("background-color","bisque");
        getdata(4);
    });
});
$("#all").css("background-color","rgb(142, 206, 223)");
getdata(0);