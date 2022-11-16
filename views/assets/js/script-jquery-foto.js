$(document).ready(function () {
  var resize = $("#upload-demo").croppie({
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
    $("#modal-recortar-foto").modal("show");
    $("#flFoto").val("");
  });

  $("#flFotoPerfil").on("change", function () {
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
    $("#flFotoPerfil").val("");
  });

  $("#flFotoPet").on("change", function () {
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
    $("#flFotoPet").val("");
  });

  $("#continuar-crop-foto").on("click", function (ev) {
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
            $("#preview").attr("src", "");
            $("#preview").attr("src", html);
            console.log(data);
          },
        });
      });
  });

    $("#continuar-crop-foto-perfil").on("click", function (ev) {
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
              $("#baseFoto").val(html);
              $("#preview").attr("src", "");
              $("#preview").attr("src", html);
              $("#modal-recortar-foto").modal("hide");
              $("#modal-editar-perfil").modal("show");
              $(".baseFoto").val(html);
              console.log(data);
            },
          });
        });
    });

  $("#enviarFoto").on("click", function (ev) {
    var foto = $("#baseFoto").val();
    $.ajax({
      type: "POST",
      enctype: "multipart/form-data",
      data: { imageBase: foto },
      url: "/petiti/assets/libs/croppie/croppie-usuario.php",
      success: function (data) {
        console.log(data);
        console.log(foto);
      },
    });
  });
  


  $("#enviarFotoPet").on("click", function (ev) {
    var foto = $("#baseFoto").val();
    $.ajax({
      type: "POST",
      enctype: "multipart/form-data",
      data: { imageBase: foto },
      url: "/petiti/assets/libs/croppie/croppie-pet.php",
      success: function (data) {
        console.log(data);
        console.log(foto);
      },
    });
  });

  $("#continuar-crop-foto-pet").on("click", function (ev) {
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
            $("#preview").attr("src", "");
            $("#preview").attr("src", html);
            console.log(data);
          },
        });
      });
  });
});
