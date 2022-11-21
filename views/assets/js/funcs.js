$(document).ready(function () {
  var id = "";
  var resize = $("#upload-demo-post-perfil").croppie({
    enableExif: true,
    enableOrientation: true,
    viewport: {
      // Default { width: 100, height: 100, type: 'square' }
      width: 795,
      height: 740,
      type: "square", //square
    },
    boundary: {
      width: 795,
      height: 740,
    },
  });
  $(".FotoPostPerfil").on("change", function () {
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
    $("#modal-recortar-foto").modal("show");
    $(".FotoPostPerfil").val("");
  });

  $("#continuar-post").on("click", function (ev) {
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
            $(".baseFoto").val(img);
            html = '<img src="' + img + '" />';
            $("#preview-crop-image").html(html);

            console.log(data);
          },
        });
      });
  });

  $(".curtir").on("click", function () {
    id = $(this).val();
    $.ajax({
      type: "POST",
      url: "/petiti/api/curtir",
      data: { idPub: id },
      success: function (data) {
        console.log("post de id " + id + " foi curtido");
        console.log(data);
        $("#itimalias" + id).text(data);
      },
    });
  });

  $(".seguir").on("click", function () {
    id = $(this).val();
    $.ajax({
      type: "POST",
      url: "/petiti/api/seguir",
      data: { id: id },
      success: function (data) {
        var qtdSeguidores = data[0];
        console.log(data);
        $("#seguidores").text(qtdSeguidores);
        if (data[2] == false) {
          $(".seguir").addClass("btn-primary");
          $(".seguir").removeClass("btn-secundary");
          $(".seguir").text("Seguir");
        } else {
          $(".seguir").removeClass("btn-primary");
          $(".seguir").addClass("btn-secundary");
          $(".seguir").text("Seguindo");
        }
      },
    });
  });

  $(".seguir-na-postagem").on("click", function () {
    id = $(this).attr("id");
    $.ajax({
      type: "POST",
      url: "/petiti/api/seguir",
      data: { id: id },
      success: function (data) {
        if (data[2] == true) {
          $("#icon-seguir-post").removeClass("fa-user-plus");
          $("#icon-seguir-post").addClass("fa-user-minus");
          $(".deixSeguir").text("Deixar de seguir");
        } else {
          $("#icon-seguir-post").removeClass("fa-user-minus");
          $("#icon-seguir-post").addClass("fa-user-plus");
          $(".deixSeguir").text("Seguir");
        }
      },
    });
  });

  $(".seguirNotif").on("click", function () {
    id = $(this).val();
    $.ajax({
      type: "POST",
      url: "/petiti/api/seguir",
      data: { id: id },
      success: function (data) {
        console.log(data);
        if (data[2] == false) {
          $(".botaoUsuario" + id).addClass("btn-primary");
          $(".botaoUsuario" + id).removeClass("btn-secundary");
          $(".botaoUsuario" + id).text("Seguir");
        } else {
          $(".botaoUsuario" + id).removeClass("btn-primary");
          $(".botaoUsuario" + id).addClass("btn-secundary");
          $(".botaoUsuario" + id).text("Seguindo");
        }
      },
    });
  });

  $(".seguirPet").on("click", function () {
    id = $(this).val();
    $.ajax({
      type: "POST",
      url: "/petiti/api/seguir-pet",
      data: { idPet: id },
      success: function (data) {
        var qtdSeguidores = data[0];
        $("#seguidores").text(qtdSeguidores);
        if (data[2] == false) {
          $(".seguirPet").addClass("btn-primary");
          $(".seguirPet").removeClass("btn-secundary");
          $(".seguirPet").text("Seguir");
        } else {
          $(".seguirPet").removeClass("btn-primary");
          $(".seguirPet").addClass("btn-secundary");
          $(".seguirPet").text("Seguindo");
        }
      },
    });
  });

  $(".comentar").on("click", function () {
    id = $(this).val();
    console.log(id);
    var texto = $("#txtComentar" + id).val();
    console.log(texto);
    $.ajax({
      type: "POST",
      url: "/petiti/api/comentar",
      data: { id: id, texto: texto },
      success: function (data) {
        console.log();
        console.log();
        $(
          "<div style='display: flex; flex-direction: row; align-items: center; gap: 0.6rem;'> <h2 style='font-weight: 900 !important; align-self: start;'>" +
            data[0].loginUsuario +
            "</h2> " +
            "<h3 style='color: rgba(86, 86, 86, 1);'>" +
            data[0].textoComentario +
            "</h3> </div>"
        ).appendTo(".comentarios");
        $("#txtComentar" + id).val("");
      },
    });
  });

  $(".badge-categoria").on("click", function () {
    id = $(this).attr("id");
    $.ajax({
      type: "POST",
      url: "/petiti/api/seguir-categoria",
      data: { id: id },
      success: function (data) {
        console.log(data);
        if (data[0] == true) {
          $("#" + id).addClass("seguida");
        } else {
          $("#" + id).removeClass("seguida");
        }
      },
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

    categoriasHolder.style.borderBottom = "none";
  }
}

function auto_grow(element) {
  element.style.height = "60px";
  element.style.paddingBottom = "12px";
  element.style.height = element.scrollHeight + "px";
}

function setupTabs() {
  document.querySelectorAll(".userTabOption").forEach((button) => {
    button.addEventListener("click", () => {
      const userTabs = button.parentElement;
      const tabsContainer = userTabs.parentElement;
      const tabNumber = button.dataset.forTab;
      const tabToActivate = tabsContainer.querySelector(
        `.tabs_content[data-tab="${tabNumber}"]`
      );

      userTabs.querySelectorAll(".userTabOption").forEach((button) => {
        button.classList.remove("userTabOption--ativo");
      });

      tabsContainer.querySelectorAll(".tabs_content").forEach((tab) => {
        tab.classList.remove("tabAtiva");
      });

      button.classList.add("userTabOption--ativo");
      tabToActivate.classList.add("tabAtiva");
    });
  });
}

function openTab(evt, tabNumber) {
  var i, tabcontent, tablinks;

  tabcontent = document.getElementsByClassName("tabs-conteudo");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  tablinks = document.getElementsByClassName("menu-item");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" ativo", "");
  }

  document.getElementById(tabNumber).style.display = "flex";
  evt.currentTarget.className += " ativo";
}

document.addEventListener("DOMContentLoaded", () => {
  setupTabs();
});

function showPassword() {
  const password = document.getElementById("txtPw");
  const passwordConfirm = document.getElementById("txtPwConfirm");

  const toggle = document.getElementById("revealPassword");
  const untoggle = document.getElementById("hidePassword");

  password.setAttribute("type", "text");

  toggle.style.display = "block";
  untoggle.style.display = "none";

  passwordConfirm.setAttribute("type", "text");
}

function hidePassword() {
  const password = document.getElementById("txtPw");
  const passwordConfirm = document.getElementById("txtPwConfirm");

  const toggle = document.getElementById("revealPassword");
  const untoggle = document.getElementById("hidePassword");

  password.setAttribute("type", "password");

  toggle.style.display = "none";
  untoggle.style.display = "block";

  passwordConfirm.setAttribute("type", "password");
}

function showPasswordUm() {
  const password = document.getElementById("txtPw");

  const toggle = document.getElementById("revealPassword");
  const untoggle = document.getElementById("hidePassword");

  password.setAttribute("type", "text");

  toggle.style.display = "block";
  untoggle.style.display = "none";
}

function hidePasswordUm() {
  const password = document.getElementById("txtPw");

  const toggle = document.getElementById("revealPassword");
  const untoggle = document.getElementById("hidePassword");

  password.setAttribute("type", "password");

  toggle.style.display = "none";
  untoggle.style.display = "block";
}

$(document).ready(function () {
  $(".edit").click(function () {
    var idPub = $(this).attr("id");
    const options = document.getElementById("opcoesPost " + idPub);
    if (options.classList.contains("close")) {
      options.classList.remove("close");
      options.classList.add("open");
    } else {
      options.classList.remove("open");
      options.classList.add("close");
    }
  });

  $(".denunciaPost").click(function () {
    var idUsu = $(this).attr("id");
    var idPost = $(".postDenunciado").attr("id");
    $("#idUsuarioPub").val(idUsu);
    $("#idPost").val(idPost);
  });
});

window.onload = function () {
  var hidedivmenupost = document.getElementById("menuPost");

  document.onclick = function (div) {
    if (div.target.id !== "menuPost") {
      hidedivmenupost.style.display = "none";
    }
  };
};

window.onload = function () {
  setTimeout(function () {
    document.querySelector(".toast-denuncia").classList.add("hide");
  }, 5000);
};

function closePopup() {
  document.querySelector(".toast-denuncia").classList.add("close");
}
