while (!window.jQuery)
  sleep(10);

$(document).ready(function() {
  //Global variable declarations
  var modal = document.getElementById('login');
  var username = 'guest';
  var ingredientInput = document.getElementById('add-ingredient');
  var addIngredientButton = document.getElementById('add-ingredient-button');
  var ingredientList = document.getElementById('ingredient-list');
  var recipeList = document.getElementById('recipe-list');
  var favList = document.getElementById('fav-list');
  var topList = document.getElementById('top-connections');
  var worstList = document.getElementById('worst-connections');
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

  var getTopConnections = function() {
    $.post('get_top_connections.php', function(data) {
      console.log(data);
      data = data.replace(/,\s*$/, "");
      var top = data.split('|');
      for(i in top) {
        var li = document.createElement('li');
        li.innerHTML = "<label>" + top[i] + "</label>";
        topList.appendChild(li);
      }
    });
  }

  var getWorstConnections = function() {
    $.post('get_worst_connections.php', function(data) {
      console.log(data);
      data = data.replace(/,\s*$/, "");
      var worst = data.split('|');
      for(i in worst) {
        var li = document.createElement('li');
        li.innerHTML = "<label>" + worst[i] + "</label>";
        worstList.appendChild(li);
      }
    });
  }

  getTopConnections();
  getWorstConnections();

  $('#create-button').click(function() {
    var recipeName = $('#create-name').val();
    var description = $('#create-description').val();
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
    if(newRecipe) {
      var li = document.createElement('div');
      li.innerHTML = "<button id=" + newRecipe + " class='accordion'>" + newRecipe + "</button>" + "<div class='panel'>" + "<p>" + recipeInfo + "</p>" + "<button class='favorite' value='" + newRecipe + "'>" + "Favorite" + "</button>" + "<br>" + "</div>";
      console.log("New Recipe: " + newRecipe);
      recipeList.appendChild(li);
    }
  }

  var getFavs = function() {
    var li = document.createElement('li');
    $.post("refresh_favorites.php", {username: username}, function(favs) {
      console.log(favs);
      favs = favs.replace(/,\s*$/, "");
      var myFavs = favs.split('|');
      for(i in myFavs) {
        if(myFavs[i]) {
          var li = document.createElement('li');
          li.innerHTML = "<label>" + myFavs[i] + "</label>";
          favList.appendChild(li);
        }
      }
    });
  }

  $(document).on('click', '.favorite', function() {
    console.log($(this).val());
    $.post('add_recipe_to_favorites.php', {recipe: $(this).val(), username: username}, function(data) {
      console.log(data);
    });
    getFavs();
  });

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
    $("#recipe-list").empty();
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
    $("#recipe-list").empty();
    getMyRecipes();
  });

  //Add ingredients to user account and returns recipe names
  $('button#add-ingredient-button').on('click', function() {
    $("#recipe-list").empty();
    var recipe = $('input#add-ingredient').val();
    addIngredient(recipe);
    //Ajax call to add ingredient to user account
    $.post('add_ingredient.php', {recipe: recipe, username: username}, function(data) {
      console.log("Inserted into table");
    });
    $.post('get_my_recipes.php', {username: username}, function(data) {
      // $('div#recipe-list').text(data);
      console.log("Inserting into HTML list");
      data = data.replace(/,\s*$/, "");
      var my_recipes = data.split('|');
      for(i in my_recipes) {
        //Adds recipes to recipe list in HTML
        getRecipeInfo(my_recipes[i]);
      }
    });
  });

  var firstCombo = [];

  var refreshCombos = function() {
    $.post('ingredient_connection.php', function(combo) {
        combo = combo.replace(/,\s*$/, "");
        firstCombo = combo.split('|');
        console.log(firstCombo[0]);
        console.log(firstCombo[1]);
        $('#ingredient1').append(firstCombo[0]);
        $('#ingredient2').append(firstCombo[1]);
    });
  }

  refreshCombos();

  $("#combo-yes").click(function() {
    $.post('positive_connections.php', {ingredient1: firstCombo[0], ingredient2: firstCombo[1]}, function(data) {
      console.log("Fucking data: " + data);
    });
    refreshCombos();
  });

  $("#combo-no").click(function() {
    $.post('negative_connections.php', {ingredient1: firstCombo[0], ingredient2: firstCombo[1]}, function(data) {
      console.log("Kill me: " + data);
    });
    refreshCombos();
  });

  //Login function
  $("#login").click(function() {
    username = $("#username").val();
    var password = $("#password").val();
    // Checking for blank fields.
    if( username =='' || password ==''){
      // $('input[type="text"],input[type="password"]').css("border","2px solid red");
      // $('input[type="text"],input[type="password"]').css("box-shadow","0 0 3px red");
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
          $("#ingredient-list").empty();
          // $('input[type="text"],input[type="password"]').css({"border":"2px solid #00F5FF","box-shadow":"0 0 5px #00F5FF"});
          //Get ingredients associated with user account once they log in
          getMyIngredients();
          //Get recipes you can make with user ingredients
          getMyRecipes();
          // alert("Logged in: " + data);
          //Get favs
          getFavs();
          document.getElementById('login').style.display='none';
        }
        else{
          alert("Nothing happened: " + data);
        }
      });
    }
  });
});
