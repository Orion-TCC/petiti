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
  $("#txtPw").keyup(function () {
    var senha = $("#txtPwConfirm").val();
    var tamanhoSenha = $("#txtPw").val().length;

    if (tamanhoSenha > 0) {
      if (senha == $(this).val()) {
        $("#senhaAvisoVerificacao").text("Senhas correspondem.");
        $("#senhaAvisoVerificacao").addClass("textoCerto");
        $("#senhaAvisoVerificacao").removeClass("textoErrado");
        $("#btnSenhaConfirmar").prop("disabled", false);
      } else {
        $("#senhaAvisoVerificacao").text("Senhas não correspondem.");
        $("#senhaAvisoVerificacao").addClass("textoErrado");
        $("#senhaAvisoVerificacao").removeClass("textoCerto");
        $("#btnSenhaConfirmar").prop("disabled", true);
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
        $("#btnSenhaConfirmar").prop("disabled", false);
      } else {
        $("#senhaAvisoVerificacao").text("Senhas não correspondem.");
        $("#senhaAvisoVerificacao").addClass("textoErrado");
        $("#senhaAvisoVerificacao").removeClass("textoCerto");
        $("#btnSenhaConfirmar").prop("disabled", true);
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



  var resize = $(".upload").croppie({
    enableExif: true,
    enableOrientation: true,
    viewport: {
      // Default { width: 100, height: 100, type: 'square' }
      width: 300,
      height: 300,
      type: "circle", //square
    },
    boundary: {
      width: 400,
      height: 400,
    },
  });

  $("#flFotoPerfilPet").on("change", function () {
    var reader = new FileReader();
    reader.onload = function (e) {
      resize
        .croppie("bind", {
          url: e.target.result,
        })
        .then(function () {
          console.log("jQuery bind complete");
        });
    };
    reader.readAsDataURL(this.files[0]);
    $("#modal-recortar-foto-perfil-pet").modal("show");
    $("#flFotoPerfilPet").val("");
  });

  $("#continuar-crop-foto-perfil-pet").on("click", function (ev) {
    ev.preventDefault();
   
    var blob;
    resize
      .croppie("result", {
        type: "blob",
      })
      .then(function (resp) {
        blob = resp;
      });

    resize
      .croppie("result", {
        type: "canvas",
        size: "viewport",
      })
      .then(function (img) {
        $.ajax({
          type: "POST",
          enctype: "multipart/form-data",
          data: { image: img },
          url: "/petiti/assets/libs/croppie/envio.php",
          success: function (data) {
            html = img;
            $("#preview-image-pet").attr("src", "");
            $("#preview-image-pet").attr("src", html);
            $("#baseFotoPet").val(html);
          },
        });
      });
  });

  $("#flFotoPerfilUsuario").on("change", function () {
    var reader = new FileReader();
    reader.onload = function (e) {
      resize
        .croppie("bind", {
          url: e.target.result,
        })
        .then(function () {
          console.log("jQuery bind complete");
        });
    };
    reader.readAsDataURL(this.files[0]);
    $("#modal-recortar-foto-perfil").modal("show");
    $("#flFotoPerfilUsuario").val("");
  });

  $("#continuar-crop-foto-perfil-config").on("click", function (ev) {
    ev.preventDefault();
   
    var blob;
    resize
      .croppie("result", {
        type: "blob",
      })
      .then(function (resp) {
        blob = resp;
      });

    resize
      .croppie("result", {
        type: "canvas",
        size: "viewport",
      })
      .then(function (img) {
        $.ajax({
          type: "POST",
          enctype: "multipart/form-data",
          data: { image: img },
          url: "/petiti/assets/libs/croppie/envio.php",
          success: function (data) {
            html = img;
            $("#preview-image").attr("src", "");
            $("#preview-image").attr("src", html);
            $("#baseFotoUsuario").val(html);
          },
        });
      });
  });
});
