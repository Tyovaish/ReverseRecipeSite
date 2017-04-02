while (!window.jQuery)
  sleep(10);

$(document).ready(function() {
  console.log("JS is running");

  //Login modal
  var modal = document.getElementById('login');

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    console.log("Clicked login");
    if (event.target == modal) {
        modal.style.display = "none";
    }
  }
});
