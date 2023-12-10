
let aj_form=document.getElementById("ajou_form");
let mod_form=document.getElementById("mod_form");
$("#aj").click(function(e){
    e.preventDefault();
 aj_form.style.display="inline";
});
$("#annuler1").click(function(e){
    e.preventDefault();
    mod_form.style.display="none";
   });
$("#annuler2").click(function(e){
    e.preventDefault();
    aj_form.style.display="none";
   });
   
  $(".form_modifier").submit(function(e){
      e.preventDefault();
      mod_form.style.display="inline";
      console.log($(" [name='mod_ingredient']",this).val());
      console.log($(this).parent().siblings());
      mod_form.children[0].children[0].value=$(this).parent().siblings()[0].textContent;
      mod_form.children[0].children[1].value=Number($(this).parent().siblings()[1].textContent.split(" ")[0]);
      mod_form.children[0].children[2].value=Number($(this).parent().siblings()[2].textContent.split(" ")[0]);
      mod_form.children[1].children[0].value=Number($(this).parent().siblings()[3].textContent.split(" ")[0]);
      mod_form.children[1].children[1].value=$(this).parent().siblings()[4].textContent;
      mod_form.children[1].children[2].value=$(this).parent().siblings()[5].textContent;
      if($(this).parent().siblings()[7].textContent=="été") mod_form.children[2].children[0].value=1;
      if($(this).parent().siblings()[7].textContent=="printemps") mod_form.children[2].children[0].value=2;
      if($(this).parent().siblings()[7].textContent=="hiver") mod_form.children[2].children[0].value=3;
      if($(this).parent().siblings()[7].textContent=="automne") mod_form.children[2].children[0].value=4;
      if($(this).parent().siblings()[7].textContent=="toute l'année") mod_form.children[2].children[0].value=5;
      mod_form.children[2].children[1].value=$(" [name='mod_ingredient']",this).val();
      mod_form.children[2].children[2].value=Number($(this).parent().siblings()[8].textContent);
      console.log(mod_form.children[2].children[1].value);
      console.log(mod_form.children[0].children);
   });
