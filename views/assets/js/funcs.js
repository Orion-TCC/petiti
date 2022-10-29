$(document).ready(function () {
  var id = "";
  $(".curtir").on("click",function () {
    id = $(this).val();
    $.ajax({
      type: "POST",
      url: "/petiti/api/curtir",
      data: {"id":id },
      success: function (data) {
        console.log("post de id "+id+" foi curtido");
        $("#itimaliasPost"+id).text(data+" itimalias");
      }
    });
  });

  $(".seguir").on("click", function (){
    id = $(this).val();
    $.ajax({type: "POST", url: '/petiti/api/seguir', data: {"id":id}});
    console.log("seguido");
  });
  
  $(".comentar").on("click",function () {
    id = $(this).val();
    console.log(id);
    var texto = $("#txtComentar"+id).val();
    console.log(texto);
    $.ajax({
      type: "POST",
      url: "/petiti/api/comentar",
      data: {"id":id, "texto": texto},
      success: function (data) {
        console.log();
        console.log(data[0].nomeUsuario+" "+data[0].textoComentario);
      }
    });
  });
});




function showHideElement() {
  var x = document.getElementById("categoriasHolder");

  var expandMore = document.getElementById("expandMoreIcon");
  var expandLess = document.getElementById("expandLessIcon");
  
  var botaoShowHide = document.getElementById("botaoShowHide");

  var categoriasHolder = document.getElementById("categoriasHolder");
  
  if (x.style.display === "none") {
    x.style.display = "flex";
    expandMore.style.display = "none";
    expandLess.style.display = "block";
    
    botaoShowHide.style.borderBottom = "none";
    botaoShowHide.style.paddingBottom = "1px";
    categoriasHolder.style.borderBottom = "1px solid gray";
    
    
  } else {
    x.style.display = "none";
    expandMore.style.display = "block";
    expandLess.style.display = "none";
    
    botaoShowHide.style.borderBottom = "1px solid gray";
    botaoShowHide.style.paddingBottom = "none";

    categoriasHolder.style.borderBottom = "none"
  }
}





function auto_grow(element) {
  element.style.height = "60px";
  element.style.paddingBottom = "12px"
  element.style.height = (element.scrollHeight)+"px";
}

function setupTabs(){
  document.querySelectorAll(".userTabOption").forEach(button =>{
      button.addEventListener("click", () =>{
          const userTabs = button.parentElement;
          const tabsContainer = userTabs.parentElement;
          const tabNumber = button.dataset.forTab;
          const tabToActivate = tabsContainer.querySelector(`.tabs_content[data-tab="${tabNumber}"]`);
      
          userTabs.querySelectorAll(".userTabOption").forEach(button =>{
              button.classList.remove("userTabOption--ativo");

          });

          tabsContainer.querySelectorAll(".tabs_content").forEach(tab =>{
              tab.classList.remove("tabAtiva");
              
          });

          button.classList.add("userTabOption--ativo");
          tabToActivate.classList.add("tabAtiva");
      });
  });
}

document.addEventListener("DOMContentLoaded", () =>{
  setupTabs();
});


