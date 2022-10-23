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
