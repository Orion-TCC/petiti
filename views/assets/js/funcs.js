$(document).ready(function () {
  var id = "";
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
      type: "POST", url: "/petiti/api/seguir", data: { id: id },
      success: function (data) {
        console.log("seguido");
        console.log(data)
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
        $("<p style='font-weight: 500 !important'><span style='font-weight: 900 !important'>" + data[0].loginUsuario + "</span> " + data[0].textoComentario + "</p>").appendTo(".comentarios");
        $("#txtComentar" + id).val("");
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

function showPopUp() {
  const popup = document.getElementById("popup");

  if (popup.style.display == "none" || !popup.style.display) {
    popup.style.display = "flex";
  } else {
    popup.style.display = "none";
  }
}

$(document).ready(function () {
  $(".edit").click(function () {
    var idPub = $(this).attr('id');
    const options = document.getElementById("opcoesPost "+idPub);
    if (options.classList.contains("close")) {
      options.classList.remove("close");
      options.classList.add("open");
    } else {
      options.classList.remove("open");
      options.classList.add("close");
    }
  });

  $(".denunciaPost").click(function(){
    var idUsu = $(this).attr('id');
    var idPost = $(".postDenunciado").attr('id');
    $("#idUsuarioPub").val(idUsu);
    $("#idPost").val(idPost);
  });

});