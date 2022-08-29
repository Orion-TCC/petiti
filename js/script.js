
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

