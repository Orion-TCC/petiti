
var prevScrollpos = window.pageYOffset;

window.onscroll = function() {

var currentScrollPos = window.pageYOffset;

  if (prevScrollpos > currentScrollPos) {
    document.getElementById("navbar").style.top = "0";
  } else {
    document.getElementById("navbar").style.top = "-170px";
  }
  
  prevScrollpos = currentScrollPos;
}


var prevScrollpos = window.pageYOffset;

window.onscroll = function() {

var currentScrollPos = window.pageYOffset;

  if (prevScrollpos > currentScrollPos) {
    document.getElementById("barraPesquisa").style.top = "0";
  } else {
    document.getElementById("barraPesquisa").style.top = "-170px";
  }
  
  prevScrollpos = currentScrollPos;
}

let input = document.getElementById("inputTag");
let imageName = document.getElementById("imageName");

input.addEventListener("change", () => {
  let inputImage = document.querySelector("input[type=file]").files[0];

  imageName.innerText = inputImage.name;
});
function preview() {
  frame.src = URL.createObjectURL(event.target.files[0]);
}
