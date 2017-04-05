while (!window.jQuery)
  sleep(10);

$(document).ready(function() {
  console.log("JS is running");

  //Login modal
  var modal = document.getElementById('login');

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
  }

  var ingredientInput = document.getElementById('add-ingredient');
  var addIngredientButton = document.getElementById('add-ingredient-button');
  var ingredientList = document.getElementById('ingredient-list');

  var addIngredient = function () {
      var text = ingredientInput.value;
      var li = document.createElement('li');
      li.innerHTML = "<label>" + text + "</label>" +
                     "<button class='delete mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect'>" + "<i class='material-icons'>" + 'delete' + "</i>" + "</button>";
      ingredientList.appendChild(li);
  }

  $(document).on('click', '.delete', function() {
        $(this).parent().remove();
  });

  addIngredientButton.onclick = addIngredient;

  $('button#add-ingredient-button').on('click', function() {
    var ingredient = $('input#add-ingredient').val();
    if($.trim(ingredient) != '') {
      $.post('oracle.php', {ingredient: ingredient}, function(data) {
        $('div#recipe-list').text(data);
      });
    }
  });
});
