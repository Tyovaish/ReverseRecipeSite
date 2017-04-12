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

  var recipeList = document.getElementById('recipe-list');

  var addIngredient = function (newIngredient) {
    // var newIngredient = ingredientInput.value;
    var li = document.createElement('li');
    li.innerHTML = "<label>" + newIngredient + "</label>" +
                   "<button class='delete mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect'>" + "<i class='material-icons'>" + 'delete' + "</i>" + "</button>";
    ingredientList.appendChild(li);
  }

  var addRecipe = function (newRecipe) {
    var li = document.createElement('tr');
    console.log("New Recipe:" + newRecipe);
    li.innerHTML = "<label>" + newRecipe + "</label>";
    recipeList.appendChild(li);
  }

  var getMyIngredients = function() {
    $.post('get_my_ingredients.php', {username: username}, function(data) {
      data = data.replace(/,\s*$/, "");
      var my_ingredients = data.split(',');
      for(i in my_ingredients) {
        addIngredient(my_ingredients[i]);
      }
    });
  }

  // $(document).ready(function() {
  //   $.get('get_my_ingredients.php', function(data) {
  //     data = data.replace(/,\s*$/, "");
  //     var my_ingredients = data.split(',');
  //     for(i in my_ingredients) {
  //       addIngredient(my_ingredients[i]);
  //     }
  //   });
  // });

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
      $.post('add_ingredient.php', {recipe: recipe, username: username}, function(data) {
        // $('div#recipe-list').text(data);
        data = data.replace(/,\s*$/, "");
        var my_recipes = data.split(',');
        console.log(my_recipes);
        for(i in my_recipes){
          addRecipe(my_recipes[i]);
        }
      });
    }
  });

  var username = '';

  $('#get-account-info').click(function() {
    alert("Username: " + username + "    Password: " + password);
  });

  $("#login").click(function(){
    username = $("#username").val();
    var password = $("#password").val();
    // Checking for blank fields.
    if( username =='' || password ==''){
      $('input[type="text"],input[type="password"]').css("border","2px solid red");
      $('input[type="text"],input[type="password"]').css("box-shadow","0 0 3px red");
      // alert("Please fill all fields...!!!!!!");
    }
    else {
      console.log("Username: " + username);
      console.log("Password: " + password);
      $.post("login.php",{username: username, password: password}, function(data) {
        if(data=='Added New User!'){
          $('input[type="text"],input[type="password"]').css({"border":"2px solid red","box-shadow":"0 0 3px red"});
          // alert("Wrong username or password" + data);
        }
        else if(data=='SUCCESS!'){
          $("form")[0].reset();
          $('input[type="text"],input[type="password"]').css({"border":"2px solid #00F5FF","box-shadow":"0 0 5px #00F5FF"});
          getMyIngredients();
          // alert("Logged in: " + data);
        }
        else{
          // alert("Nothing happened: " + data);
        }
      });
    }
  });



});
