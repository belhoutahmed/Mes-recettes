function getdata($saison){
    $.get("./fetes_getter.php",(data)=>{ 
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
        $("#Mariage").css("background-color","bisque");
        $("#Achoura").css("background-color","bisque");
        $("#Aid").css("background-color","bisque");
        $("#Ramadan").css("background-color","bisque");
        $("#Elmawlid").css("background-color","bisque");

        getdata(0);
    });
    $("#Mariage").click(function(){
        $("#Mariage").css("background-color","rgb(142, 206, 223)");
        $("#all").css("background-color","bisque");
        $("#Achoura").css("background-color","bisque");
        $("#Aid").css("background-color","bisque");
        $("#Ramadan").css("background-color","bisque");
        $("#Elmawlid").css("background-color","bisque");
        getdata(1);
    });
    $("#Achoura").click(function(){
        $("#Achoura").css("background-color","rgb(142, 206, 223)");
        $("#Mariage").css("background-color","bisque");
        $("#all").css("background-color","bisque");
        $("#Aid").css("background-color","bisque");
        $("#Ramadan").css("background-color","bisque");
        $("#Elmawlid").css("background-color","bisque");
        getdata(2);
    });
    $("#Aid").click(function(){
        $("#Aid").css("background-color","rgb(142, 206, 223)");
        $("#Mariage").css("background-color","bisque");
        $("#Achoura").css("background-color","bisque");
        $("#all").css("background-color","bisque");
        $("#Ramadan").css("background-color","bisque");
        $("#Elmawlid").css("background-color","bisque");
        getdata(3);
    });
    $("#Ramadan").click(function(){
        $("#Ramadan").css("background-color","rgb(142, 206, 223)");
        $("#Mariage").css("background-color","bisque");
        $("#Achoura").css("background-color","bisque");
        $("#Aid").css("background-color","bisque");
        $("#all").css("background-color","bisque");
        $("#Elmawlid").css("background-color","bisque");
       
        getdata(4);
    });
    $("#Elmawlid").click(function(){
        $("#Elmawlid").css("background-color","rgb(142, 206, 223)");
        $("#Mariage").css("background-color","bisque");
        $("#Achoura").css("background-color","bisque");
        $("#Aid").css("background-color","bisque");
        $("#Ramadan").css("background-color","bisque");
        $("all").css("background-color","bisque");
        getdata(5);
    });
});
$("#all").css("background-color","rgb(142, 206, 223)");
getdata(0);