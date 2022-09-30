// Validar nome de usuário
$("#txtLoginUsuario").keyup(function () {
  var regex = new RegExp("^[A-Za-z0-9]+$");
  var login = $(this).val();
  if (regex.test(login)) {
    $("#avisoNomeUsuario").text("Usuário Válido");
    $("#avisoNomeUsuario").addClass("avisoNomeUsuarioValido");
    $("#avisoNomeUsuario").removeClass("avisoNomeUsuarioInvalido");
    $("#submitUsuario").prop("disabled", false);
  } else {
    $("#submitUsuario").prop("disabled", true);
    $("#avisoNomeUsuario").addClass("avisoNomeUsuarioInvalido");
    $("#avisoNomeUsuario").removeClass("avisoNomeUsuarioValido");
    $("#avisoNomeUsuario").text("Usuário Inválido");
  }
});
//Senha aviso

$("#txtPw").keyup(function () {
  var tamanhoSenha = $("#txtPw").val().length;

  if (tamanhoSenha < 6) {
    $(".senhaAviso").text("Utilize uma senha com 6 ou mais caracteres.");
    $("#senhaAviso").addClass("senhaAvisoErrada");
    $("#senhaAviso").removeClass("senhaAvisoCerta");
  } else {
    $("#senhaAviso").text("");
  }
});

$("#txtPw").keyup(function () {
  var senha = $("#txtPwConfirm").val();

  //Verificar Senhas
  if (senha == $(this).val()) {
    $("#senhaAvisoVerificacao").text("Senhas correspondem.");
    $("#senhaAviso").addClass("senhaAvisoCerta");
    $("#senhaAviso").removeClass("senhaAvisoErrada");
  } else {
    $("#senhaAvisoVerificacao").text("Senhas não correspondem.");
    $("#senhaAviso").addClass("senhaAvisoErrada");
    $("#senhaAviso").removeClass("senhaAvisoCerta");
  }
});

$("#txtPwConfirm").keyup(function () {
  var senha = $("#txtPw").val();
  if (senha == $(this).val()) {
    $(".senhaAviso").text("Senhas correspondem.");
    $("#senhaAviso").addClass("senhaAvisoCerta");
    $("#senhaAviso").removeClass("senhaAvisoErrada");
  } else {
    $("#senhaAviso").text("Senhas não correspondem.");
    $("#senhaAviso").addClass("senhaAvisoErrada");
    $("#senhaAviso").removeClass("senhaAvisoCerta");
  }
});

//mostrarSenhas

$("#mostrarSenha").change(function () {
  if ($("#mostrarSenha").is(":checked")) {
    $("#txtPw").prop("type", "text");
    $("#txtPwConfirm").prop("type", "text");
  } else {
    $("#txtPw").prop("type", "password");
    $("#txtPwConfirm").prop("type", "password");
  }
});

//Limitar com base no select a idade do pet
$(".SelectDiaMesAno").on("change", function () {
  switch (this.value) {
    case "d":
      $("#txtIdadePet").attr("max", "59");
      break;
    case "m":
      $("#txtIdadePet").attr("max", "11");
      break;
    case "y":
      $("#txtIdadePet").attr("max", "2022");
      break;
  }
});
