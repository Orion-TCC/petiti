$(document).ready(function () {
  var resize = $("#upload-demo").croppie({
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

  var categorias = [];
  var input = document.getElementById("txtCategoria");

  $("#flFoto").on("change", function () {
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
    $("#modal-foto-post").modal("hide");
    $("#flFoto").val("");
    $("#modal-recortar-foto").modal("show");
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
            $("#baseFoto").val(img);
            html = '<img src="' + img + '" />';
            $("#preview-crop-image").html(html);

            console.log(data);
          },
        });
      });
  });
  $("#form-id").on("keypress", function (event) {
    console.log("aaya");
    var keyPressed = event.keyCode || event.which;
    if (keyPressed === 13) {
      alert("You pressed the Enter key!!");
      event.preventDefault();
      return false;
    }
  });

  $("#submitCategoria").click(function () {
    if (input.value == "") {
    } else {
      var categoriaCheck = categorias.push(input.value);

      $(".categoriasChecksHolder").append(
        "<div class='categoriaSelector'> <input class='checkbox' checked type='checkbox' name='categorias[]' id='' value=''> " +
          $(categorias).get(-1)
      );
      console.log(categoriaCheck);
      console.log(categorias);
      document.getElementById("categoriasValue").value = categorias;
      input.value = "";
      input.focus();
    }
  });

  $("#form-aid").on("keyup keypress", function (e) {
    var keyCode = e.keyCode || e.which;
    if (keyCode === 13) {
      e.preventDefault();
      return false;
    }
  });

  $("#form-aid #txtCategoria").keypress(function (event) {
    var keycode = event.keyCode ? event.keyCode : event.which;
    if (keycode == "13") {
      if (input.value == "") {
      } else {
        var categoriaCheck = categorias.push(input.value);

      $(".categoriasChecksHolder").append(
        "<div class='categoriaSelector'> <input class='checkbox' checked type='checkbox' name='categorias[]' id='' value=''> " +
          $(categorias).get(-1)
      );
      console.log(categoriaCheck);
      console.log(categorias);
      document.getElementById("categoriasValue").value = categorias;
      input.value = "";
      input.focus();
      }
    }
  });

  $("input.checkbox").change(function () {
    checkA = $(this).val();
    if ($(this).is(":checked")) {
      categorias.push(checkA);
      console.log(categorias);
      document.getElementById("categoriasValue").value = categorias;
    } else {
      categorias.splice(categorias.indexOf(checkA), 1);
      document.getElementById("categoriasValue").value = categorias;
      console.log(categorias);
    }
  });
});
