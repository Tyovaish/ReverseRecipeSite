while (!window.jQuery)
  sleep(10);

$(document).ready(function() {
  //Global variable declarations
  var modal = document.getElementById('login');
  var username = '';
  var ingredientInput = document.getElementById('add-ingredient');
  var addIngredientButton = document.getElementById('add-ingredient-button');
  var ingredientList = document.getElementById('ingredient-list');
  var recipeList = document.getElementById('recipe-list');
  var acc = document.getElementsByClassName("accordion");

  //Expands recipe names on click to show ingredients and descriptions
  $(document).on('click', '.accordion', function() {
    var i;
    for (i = 0; i < acc.length; i++) {
      acc[i].onclick = function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.maxHeight){
          panel.style.maxHeight = null;
        }
        else {
          panel.style.maxHeight = panel.scrollHeight + "px";
        }
      }
    }
  });

  $('#create-button').click(function() {
    var recipeName = $('#create-name').val();
    var description = $('#create-description').val();
    console.log("Created name: " + recipeName + "    Description: " + description);
    $.post('create_recipe.php', {username: username, recipeName: recipeName, description: description}, function(data) {
      console.log(data);
    });
  });

  //Adds ingredients to ingredient list in HTML
  var addIngredient = function (newIngredient) {
    // var newIngredient = ingredientInput.value;
    var li = document.createElement('li');
    li.innerHTML = "<label>" + newIngredient + "</label>" +
                   "<button class='delete mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect'>" + "<i class='material-icons'>" + 'delete' + "</i>" + "</button>";
    ingredientList.appendChild(li);
  }

  //Adds recipes to recipe list in HTML
  var addRecipe = function (newRecipe, recipeInfo) {
    var li = document.createElement('div');
    li.innerHTML = "<button class='accordion'>" + newRecipe + "</button>" + "<div class='panel'>" + "<p>" + recipeInfo + "</p>" + "</div>";
    recipeList.appendChild(li);
  }

  //Gets Ingredients associated with a user
  var getMyIngredients = function() {
    $.post('get_my_ingredients.php', {username: username}, function(data) {
      data = data.replace(/,\s*$/, "");
      var my_ingredients = data.split('|');
      for(i in my_ingredients) {
        //Adds ingredients to list in HTML
        addIngredient(my_ingredients[i]);
      }
    });
  }

  var getRecipeInfo = function(recipeName) {
    $.post('get_recipe_ingredients.php', {recipe: recipeName}, function(info) {
      //Adds recipe to list in HTML
      addRecipe(recipeName, info);
    });
  }

  //Gets recipes
  var getMyRecipes = function() {
    console.log("Attempting to get recipes for " + username);
    $.post('get_my_recipes.php', {username: username}, function(data) {
      // $('div#recipe-list').text(data);
      console.log("Retrieved recipes: " + data);
      data = data.replace(/,\s*$/, "");
      var my_recipes = data.split('|');
      for(i in my_recipes) {
        getRecipeInfo(my_recipes[i]);
      }
    });
  }

  //Removes recipe from list and from user account
  $(document).on('click', '.delete', function() {
    var remove = $(this).parent().find('label').text();
    $(this).parent().remove();
    //Ajax call to remove from account
    $.post('remove_ingredient.php', {remove: remove, username: username}, function(data) {
      console.log(data);
    });
  });

  //Add ingredients to user account and returns recipe names
  $('button#add-ingredient-button').on('click', function() {
    var recipe = $('input#add-ingredient').val();
    addIngredient(recipe);
    if($.trim(recipe) != '') {
      //Ajax call to add ingredient to user account
      $.post('add_ingredient.php', {recipe: recipe, username: username}, function(data) {
        // $('div#recipe-list').text(data);
        data = data.replace(/,\s*$/, "");
        var my_recipes = data.split('|');
        for(i in my_recipes) {
          //Adds recipes to recipe list in HTML
          getRecipeInfo(my_recipes[i]);
        }
      });
    }
  });

  //Login function
  $("#login").click(function() {
    username = $("#username").val();
    var password = $("#password").val();
    // Checking for blank fields.
    if( username =='' || password ==''){
      $('input[type="text"],input[type="password"]').css("border","2px solid red");
      $('input[type="text"],input[type="password"]').css("box-shadow","0 0 3px red");
      // alert("Please fill all fields...!!!!!!");
    }
    else {
      $.post("login.php",{username: username, password: password}, function(data) {
        if(data=='Added New User!'){
          console.log("Wrong");
          // $('input[type="text"],input[type="password"]').css({"border":"2px solid red","box-shadow":"0 0 3px red"});
          // alert("Wrong username or password" + data);
        }
        else if(data == 'SUCCESS!'){
          $("form")[0].reset();
          // $('input[type="text"],input[type="password"]').css({"border":"2px solid #00F5FF","box-shadow":"0 0 5px #00F5FF"});
          //Get ingredients associated with user account once they log in
          getMyIngredients();
          //Get recipes you can make with user ingredients
          getMyRecipes();
          // alert("Logged in: " + data);
          document.getElementById('login').style.display='none';
        }
        else{
          alert("Nothing happened: " + data);
        }
      });
    }
  });
});
