$(document).ready(function () {
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
    var tamanhoEmail = $("#txtEmailUsuario").val().length;
    if (tamanhoEmail > 0) {
      if (bool == true) {
        $("#avisoEmail").text("");
        $("#avisoEmail").addClass("textoCerto");
        $("#avisoEmail").removeClass("textoErrado");
      } else {
        $("#avisoEmail").text("Email inválido");
        $("#avisoEmail").addClass("textoErrado");
        $("#avisoEmail").removeClass("textoCerto");
      }
    } else {
      $("#avisoEmail").text("");
    }
  });

  // Validar nome de usuário
  var jsonUsers;
  var jsonPets;
  $.getJSON("/petiti/api/logins", { get_param: "value" }, function (data) {
    $.each(data, function (index) {
      jsonUsers = data;
    });
  });
  $.getJSON("/petiti/api/logins-pets", { get_param: "value" }, function (data) {
    $.each(data, function (index) {
      jsonPets = data;
    });
  });
  //usuario verificação
  $("#txtLoginUsuario").keyup(function () {
    var tamanhoUsuario = $("#txtLoginUsuario").val().length;

    var regex = new RegExp("^[A-Za-z0-9_]+$");
    var login = $(this).val();
    var qtd = 0;
    var qtdPets = 0;
    try {
      for (let index = 0; index < jsonUsers.length; index++) {
        if (jsonUsers[index] == login) {
          qtd++;
        }
      }
      for (let indexPet = 0; indexPet < jsonPets.length; indexPet++) {
        if (jsonPets[indexPet] == login) {
          qtdPets++;
        }
      }
    } catch (e) {
      console.log(e);
    }

    if (qtd > 0 || qtdPets > 0) {
      $("#submitUsuario").prop("disabled", true);
      $(".avisoNomeUsuarioValidacao").addClass("textoErrado");
      $(".avisoNomeUsuarioValidacao").removeClass("textoCerto");
      $(".avisoNomeUsuarioValidacao").text("Usuário já em uso.");
      $(".avisoNomeUsuarioQtd").text("");
    } else {
      if (regex.test(login)) {
        if (tamanhoUsuario < 4 || tamanhoUsuario == 0) {
          $(".avisoNomeUsuarioQtd").text(
            "Utilize um nome de usuário com 4 ou mais caracteres."
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
    }
  });
  //usuario pet verificação
  $("#txtUserPet").keyup(function () {
    var tamanhoUsuario = $("#txtUserPet").val().length;

    var regex = new RegExp("^[A-Za-z0-9_]+$");
    var login = $(this).val();
    var qtd = 0;
    var qtdPets = 0;
    try {
      for (let index = 0; index < jsonUsers.length; index++) {
        if (jsonUsers[index] == login) {
          qtd++;
        }
      }
      try {
        for (let indexPet = 0; indexPet < jsonPets.length; indexPet++) {
          if (jsonPets[indexPet] == login) {
            qtdPets++;
          }
        }
      } catch (e) {
        console.log(e)
      }
    } catch (e) {
      console.log(e);
    }

    if (qtd > 0 || qtdPets > 0) {
      $("#submitUsuario").prop("disabled", true);
      $(".avisoNomeUsuarioValidacao").addClass("textoErrado");
      $(".avisoNomeUsuarioValidacao").removeClass("textoCerto");
      $(".avisoNomeUsuarioValidacao").text("Usuário já em uso.");
      $(".avisoNomeUsuarioQtd").text("");
      console.log("leandro");
    } else {
      if (regex.test(login)) {
        if (tamanhoUsuario < 4 || tamanhoUsuario == 0) {
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
      $("#senhaAvisoTamanho").text(
        "Utilize uma senha com 6 ou mais caracteres."
      );
      $("#senhaAvisoTamanho").addClass("textoErrado");
      $("#senhaAvisoTamanho").removeClass("textoCerto");
    } else {
      $("#senhaAvisoTamanho").text("Senha válida");
      $("#senhaAvisoTamanho").addClass("textoCerto");
      $("#senhaAvisoTamanho").removeClass("textoErrado");
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
});
