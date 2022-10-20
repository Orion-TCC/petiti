$(document).ready(function () {
  var id = "";
  $(".curtir").on("click",function () {
    id = $(this).val();
    $.ajax({
      type: "POST",
      url: "/petiti/api/curtir",
      data: {"id":id },
      success: function (data) {
        console.log("post de id "+id+" foi curtido");
        $("#itimaliasPost"+id).text(data+" itimalias");
      }
    });
  });
});
