/* SIDEBAR 
const menuItems = document.querySelectorAll('.menu-item');

const mudarItemActive = () => {
    menuItems.forEach(item => {
        item.classList.remove('active');
    })
}

menuItems.forEach(item => {
    item.addEventListener('click', () => {
        mudarItemActive();
        item.classList.add('active');
    })
})

*/

/* TABS - ativos/bloqueados */
function openTab(evt, linkSituacao) {
    // Declare all variables
    var i, tabcontent, tablinks;
  
    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
  
    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
  
    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(linkSituacao).style.display = "block";
    evt.currentTarget.className += " active";
}

// Pesquisa categoria

function myFunction() {
  // Declare variables
  var input, filter, ul, li, a, i, txtValue;
  input = document.getElementById("procurarCat");
  filter = input.value.toUpperCase();
  lista = document.getElementsByClassName("listaCat");
  
    
  // Loop through all list items, and hide those who don't match the search query
  for (i = 0; i < li.length; i++) {
      valor = lista[i].getElementsByClassName("itemCat")[0];
      console.log(valor);
    txtValue = a.textContent || a.innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      li[i].style.display = "";
    } else {
      li[i].style.display = "none";
    }
  }
}

function hidePopup(){
  setTimeout(function(){
    document.querySelector(".toast").classList.add("hide");
  }, 5000);
  
}

function closePopup(){
  document.querySelector(".toast").classList.add("close");
}