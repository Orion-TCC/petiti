$(document).ready(function () {
  $("#novaSenha").keyup(function () {
    var senha = $("#confirmNovaSenha").val();
    var tamanhoSenha = $("#novaSenha").val().length;

    if (tamanhoSenha > 0) {
      if (senha == $(this).val()) {
          $("#senhaAvisoVerificacao").text("Senhas correspondem.");
           $(".formSubmitLogin").prop("disabled", false);
        $("#senhaAvisoVerificacao").addClass("textoCerto");
        $("#senhaAvisoVerificacao").removeClass("textoErrado");
      } else {
          $("#senhaAvisoVerificacao").text("Senhas não correspondem.");
            $(".formSubmitLogin").prop("disabled", true);
        $("#senhaAvisoVerificacao").addClass("textoErrado");
        $("#senhaAvisoVerificacao").removeClass("textoCerto");
      }
    } else {
      $("#senhaAvisoVerificacao").text("");
    }
  });

  $("#confirmNovaSenha").keyup(function () {
    var senha = $("#novaSenha").val();
    var tamanhoSenha = $("#confirmNovaSenha").val().length;

    if (tamanhoSenha > 0) {
      if (senha == $(this).val()) {
          $("#senhaAvisoVerificacao").text("Senhas correspondem.");
            $(".formSubmitLogin").prop("disabled", false);
        $("#senhaAvisoVerificacao").addClass("textoCerto");
        $("#senhaAvisoVerificacao").removeClass("textoErrado");
      } else {
          $("#senhaAvisoVerificacao").text("Senhas não correspondem.");
            $(".formSubmitLogin").prop("disabled", true);
        $("#senhaAvisoVerificacao").addClass("textoErrado");
        $("#senhaAvisoVerificacao").removeClass("textoCerto");
      }
    } else {
      $("#senhaAvisoVerificacao").text("");
    }
  });
      $("#novaSenha").keyup(function () {
        var tamanhoSenha = $("#novaSenha").val().length;

        if (tamanhoSenha < 6) {
          $("#senhaAvisoTamanho").text(
            "Utilize uma senha com 6 ou mais caracteres."
            );
              $(".formSubmitLogin").prop("disabled", true);
          $("#senhaAvisoTamanho").addClass("textoErrado");
          $("#senhaAvisoTamanho").removeClass("textoCerto");
        } else {
          $("#senhaAvisoTamanho").text("Senha válida");
            $("#senhaAvisoTamanho").addClass("textoCerto");
              $(".formSubmitLogin").prop("disabled", false);
          $("#senhaAvisoTamanho").removeClass("textoErrado");
        }
      });

});