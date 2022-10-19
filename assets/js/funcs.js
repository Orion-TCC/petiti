$(document).ready(function () {
  $("#curtir").click(function () {
      var id = $(this).val();

    $.ajax({
      type: "POST",
      url: "/petiti/api/curtir",
      data: {"id":id },
      success: function (data) {
        console.log(data);
        var qtdItis = data - 1;
        $("#itimalias["+id+"]").text(qtdItis);
      },
    });

  });
});
