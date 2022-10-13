//Validar email
$("#txtEmailUsuario").keyup(function () {
  function validateEmail(email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    if (!emailReg.test(email)) {
      return false;
    } else {
      return true;
    }
  }
  var email = $(this).val();
  var bool = validateEmail(email);
  if (bool == true) {
    $("#avisoEmail").text("Email Válido");
    $("#avisoEmail").addClass("textoCerto");
    $("#avisoEmail").removeClass("textoErrado");
  } else {
    $("#avisoEmail").text("Email inválido");
    $("#avisoEmail").addClass("textoErrado");
    $("#avisoEmail").removeClass("textoCerto");
  }
});

// Validar nome de usuário
$("#txtLoginUsuario").keyup(function () {
  var tamanhoUsuario = $("#txtLoginUsuario").val().length;

  var regex = new RegExp("^[A-Za-z0-9]+$");
  var login = $(this).val();
  if (regex.test(login)) {
    if (tamanhoUsuario < 4) {
      $(".avisoNomeUsuarioQtd").text(
        "Utilize um login com 4 ou mais caracteres."
      );
      $(".avisoNomeUsuarioQtd").removeClass("textoCerto");
      $(".avisoNomeUsuarioQtd").addClass("textoErrado");
      $("#submitUsuario").prop("disabled", true);
      $(".avisoNomeUsuarioValidacao").addClass("textoErrado");
      $(".avisoNomeUsuarioValidacao").removeClass("textoCerto");
      $(".avisoNomeUsuarioValidacao").text("Usuário Inválido");
    } else {
      $(".avisoNomeUsuarioQtd").text("");
      $("#submitUsuario").prop("disabled", false);
      $(".avisoNomeUsuarioValidacao").text("Usuário Válido");
      $(".avisoNomeUsuarioValidacao").addClass("textoCerto");
      $(".avisoNomeUsuarioValidacao").removeClass("textoErrado");
    }
  } else {
    $("#submitUsuario").prop("disabled", true);
    $(".avisoNomeUsuarioValidacao").addClass("textoErrado");
    $(".avisoNomeUsuarioValidacao").removeClass("textoCerto");
    $(".avisoNomeUsuarioValidacao").text("Usuário Inválido");
  }
});
//Senha aviso

$("#txtPw").keyup(function () {
  var senha = $("#txtPwConfirm").val();
  var tamanhoSenha = $("#txtPw").val().length;

  if (tamanhoSenha > 0) {
    if (senha == $(this).val()) {
      $("#senhaAvisoVerificacao").text("Senhas correspondem.");
      $("#senhaAvisoVerificacao").addClass("textoCerto");
      $("#senhaAvisoVerificacao").removeClass("textoErrado");
    } else {
      $("#senhaAvisoVerificacao").text("Senhas não correspondem.");
      $("#senhaAvisoVerificacao").addClass("textoErrado");
      $("#senhaAvisoVerificacao").removeClass("textoCerto");
    }
  } else {
    $("#senhaAvisoVerificacao").text("");
  }
});

$("#txtPwConfirm").keyup(function () {
  var senha = $("#txtPw").val();
  var tamanhoSenha = $("#txtPwConfirm").val().length;

  if (tamanhoSenha > 0) {
    if (senha == $(this).val()) {
      $("#senhaAvisoVerificacao").text("Senhas correspondem.");
      $("#senhaAvisoVerificacao").addClass("textoCerto");
      $("#senhaAvisoVerificacao").removeClass("textoErrado");
    } else {
      $("#senhaAvisoVerificacao").text("Senhas não correspondem.");
      $("#senhaAvisoVerificacao").addClass("textoErrado");
      $("#senhaAvisoVerificacao").removeClass("textoCerto");
    }
  } else {
    $("#senhaAvisoVerificacao").text("");
  }
});

$("#txtPw").keyup(function () {
  var tamanhoSenha = $("#txtPw").val().length;

  if (tamanhoSenha < 6) {
    $("#senhaAvisoTamanho").text("Utilize uma senha com 6 ou mais caracteres.");
    $("#senhaAvisoTamanho").addClass("textoErrado");
    $("#senhaAvisoTamanho").removeClass("textoCerto");
  } else {
    $("#senhaAvisoTamanho").text("");
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


