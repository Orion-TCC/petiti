$(document).ready(function () {
  
  var resize = $("#upload-demo").croppie({
    enableExif: true,
    enableOrientation: true,
    viewport: {
      // Default { width: 100, height: 100, type: 'square' }
      width: 200,
      height: 200,
      type: "square", //square
    },
    boundary: {
      width: 300,
      height: 300,
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
    $("#modal-foto-post").modal("hide");
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
    
    resize.croppie("result", {
         type: "canvas",
         size: "viewport",
       }).then(function (img) {
         $.ajax({
           type: "POST",
           enctype: "multipart/form-data",
           data: {"image":img},
           url: "/petiti/assets/libs/croppie/croppie.php",
           success: function (data) {
             html = '<img src="' + img + '" />';
             $("#preview-crop-image").html(html);
             console.log(data);
           },
         });
       });
  });
});
