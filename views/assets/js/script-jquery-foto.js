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
            $("#preview").attr("src", "");
            $("#preview").attr("src", html);
            // $("#imagePreview").html(html);
            console.log(data);
          },
        });
      });
  });

    $("#formFotoUsuario").submit(function (ev) {
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
            data: { "image": img },
            url: "/petiti/assets/libs/croppie/croppie-usuario.php",
            success: function (data) {
              console.log(data);
            },
          });
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
          url: "/petiti/assets/libs/croppie/croppie-pet.php",
          success: function (data) {
            html = img;
            $("#preview").attr("src", "");
            $("#preview").attr("src", html);
            // $("#imagePreview").html(html);
            console.log(data);
          },
        });
      });
  });
});
