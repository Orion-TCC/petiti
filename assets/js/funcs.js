$(document).ready(function () {
  $("#curtir").click(function () {
      var id = $(this).val();
      var json;
    $.getJSON(
      "/petiti/api/publicacoes",
      { get_param: "value" },
      function (data) {
        $.each(data, function (index, element) {
          var json = data;
          console.log(json);
        });
      }
    );
    $.ajax({
      type: "POST",
      url: "/petiti/api/curtir",
      data: {"id":id },
      success: function (data) {
        console.log("curtiu");
      },
    });
    $.ajax({
      type: "POST",
      url: "/petiti/feed",
      data: {"json": json},
      success: function (data) {
        console.log(data);
      },
    });
  });
});
