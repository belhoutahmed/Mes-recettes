/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
    let rec=document.getElementsByClassName("reccont");
    rec[0].style.display="none";
  }
   
  function filterFunction() {
    var input, filter, ul, li, a, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    div = document.getElementById("myDropdown");
    a = div.getElementsByTagName("a");
    for (i = 0; i < a.length; i++) {
      txtValue = a[i].textContent || a[i].innerText;
      if(input.value.toUpperCase()==0) a[i].style.display = "none";
      else{
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        a[i].style.display = "block";
      } else {
        a[i].style.display = "none";
      }
    }
    }
  }
  div = document.getElementById("myDropdown");
  $(document).ready(function(){
    let aff=document.getElementById("aff");
    let ings=document.getElementsByClassName("ings");
    input = document.getElementById("myInput");
    $("#myDropdown a").click(function(){
      div.removeChild(this);
      input.value="";
      document.getElementById("myDropdown").classList.toggle("show");
        let inp=$(this).siblings()[0];
        ings[0].style.display="inline-block";
        console.log($(this).next());
        txtValue = this.textContent || this.innerText;
        console.log(txtValue);
        let name="";
        for(i=0;i<txtValue.split(" ").length-1;i++){
            name=name+txtValue.split(" ")[i]+" ";
            
        }
        let id=document.getElementById("ids");
        console.log(id.value);
        id.value=id.value+" "+txtValue.split(" ")[txtValue.split(" ").length-1];
        console.log(id.value);
        console.log(id.value.split(" ").length);
        let ing=$(`<div class="ing">${name}</div>
        <hr size="1" width="90%" color="black">
        `);
        $(".ings").append(ing);
    });
    
    
    
  });