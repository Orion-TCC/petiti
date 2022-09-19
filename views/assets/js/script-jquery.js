$("#txtLoginUsuario").change(function () {
  var regex = new RegExp("^[A-Za-z0-9]+$");
  var login = $(this).val();
  if (regex.test(login)) {
    alert("true");
  } else {
    alert("false");
    return false;
  }
});

$("#target").submit(function (event) {
  alert("Handler for .submit() called.");
event.preventDefault();
});