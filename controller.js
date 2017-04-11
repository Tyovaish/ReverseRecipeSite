while (!window.jQuery)
  sleep(10);

$(document).ready(function() {
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

  var addIngredient = function (newIngredient) {
    // var newIngredient = ingredientInput.value;
    var li = document.createElement('li');
    console.log("New ingredient:" + newIngredient);
    console.log("Ingredient input: " + ingredientInput.value);
    li.innerHTML = "<label>" + newIngredient + "</label>" +
                   "<button class='delete mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect'>" + "<i class='material-icons'>" + 'delete' + "</i>" + "</button>";
    ingredientList.appendChild(li);
  }

  $(document).ready(function() {
    $.get('get_my_ingredients.php', function(data) {
      data = data.replace(/,\s*$/, "");
      var my_ingredients = data.split(',');
      console.log(my_ingredients);
      for(i in my_ingredients){
        addIngredient(my_ingredients[i]);
      }
    });
  });

  $(document).on('click', '.delete', function() {
    var remove = $(this).parent().find('label').text();
    console.log(remove);
    $(this).parent().remove();
    $.post('remove_ingredient.php', {remove: remove}, function(data) {
      console.log(data);
    });
  });

  $('button#add-ingredient-button').on('click', function() {
    var recipe = $('input#add-ingredient').val();
    addIngredient(recipe);
    if($.trim(recipe) != '') {
      $.post('add_ingredient.php', {recipe: recipe}, function(data) {
        $('div#recipe-list').text(data);
      });
    }
  });
});
