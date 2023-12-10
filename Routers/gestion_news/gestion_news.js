let aj_form=document.getElementById("ajou_form");

$("#aj").click(function(e){
    e.preventDefault();
 aj_form.style.display="inline";
});

$("#annuler2").click(function(e){
    e.preventDefault();
    aj_form.style.display="none";
   });