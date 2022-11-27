function offsidebar() {
    var sidebar = document.getElementById("sidebar");
    sidebar.classList.remove("active");
}

function onsidebar() {
    var sidebar = document.getElementById("sidebar");
    sidebar.classList.add("active");
}


function myFunction(x) {
    if (x.matches) { // If media query matches
        offsidebar();
    } else {
        onsidebar();
    }
}


function toogledark() {
    var element = document.body;
    element.classList.toggle("theme-dark");
} 

  
  let x = window.matchMedia("(max-width: 1203px)")
  myFunction(x) // Call listener function at run time
  x.addListener(myFunction) // Attach listener function on state changes 