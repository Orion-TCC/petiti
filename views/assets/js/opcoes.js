$(document).ready(function () {
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
  $("#txtLoginPet").keyup(function () {
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
  $("#txtIdadePet").on("input", function () {
    this.value = this.value.replace(/[^0-9]/g, "");
  });
});
