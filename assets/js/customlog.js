document.onmousemove = function(e) {
    const backgroundlog = document.body;
    const  x = - e.clientX/30,
      y = - e.clientY/30;
      backgroundlog.style.backgroundPositionX = x + "px";
      backgroundlog.style.backgroundPositionY = y + "px";
}