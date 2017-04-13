<!doctype html>

<html>
  <head>
    <meta charset="utf-8">
    <title>Reverse Cookbook</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>
  <body>
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
      <header class="mdl-layout__header mdl-layout__header--waterfall portfolio-header">
        <div class="mdl-layout__header-row portfolio-logo-row">
          <span class="mdl-layout__title">
            <div class="portfolio-logo"></div>
            <span class="mdl-layout__title" style="color: black; background-color: rgba(255, 255, 255, 0.7); height: 24px; width: 200px; margin: auto; font-size: 16pt;">Reverse Cookbook</span>
          </span>
          <a id="login-button" onclick="document.getElementById('login').style.display='block'" class="mdl-button mdl-js-button mdl-js-ripple-effect";>LOGIN</a>
        </div>
      </header>
    <main id="content"class="mdl-layout__content">
      <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
        <div class="mdl-tabs__tab-bar" style="color: black; background-color: rgba(255, 255, 255, 0.7);">
          <a class="mdl-tabs__tab" href="#fav-tab">Favorites</a>
          <a class="mdl-tabs__tab is-active" href="#home-tab">Home</a>
          <a class="mdl-tabs__tab" href="#stats-tab">Fun Facts</a>
        </div>
        <div class="mdl-tabs__panel is-active" id="home-tab">
          <section id="home-page">
            <input id="add-ingredient" type="text" placeholder="Add Ingredients" class="card card-hover">
            <button id="add-ingredient-button" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
              <i class="material-icons">add</i>
            </button>
            <br>
            <div class="page-content max-width mdl-grid" style="justify-content:center;">
              <div class="mdl-cell mdl-card mdl-shadow--4dp">
                <div class="mdl-card__title">
                  <h2 class="mdl-card__title-text">Your Ingredients</h2>
                </div>
                <div class="mdl-card__supporting-text">
                  <ul id='ingredient-list'>
                  </ul>
                </div>
                <button onclick="document.getElementById('create').style.display='block'">Create Recipe</button>
              </div>
              <div class="mdl-cell mdl-card mdl-shadow--4dp">
                <div class="mdl-card__title">
                  <h2 class="mdl-card__title-text">Recipes</h2>
                </div>
                <div id="recipe-list" class="mdl-card__supporting-text">
                </div>
            </div>
          </section>
        </div>
        <div id="fav-tab" class="mdl-tabs__panel">
          <section>
            <div>
              <h2>Favorites</h2>
            </div>
          </section>
        </div>
        <div id="stats-tab" class="mdl-tabs__panel">
          <section>
            <div>
              <h2>Fun Facts</h2>
            </div>
          </section>
        </div>
        <div id="login-screen">
          <section id="login" class="modal">
            <div class="page-content">
              <div class="pre-login" style="display:flex;justify-content:center;align-items:center;">
                <div class="container card-back login-screen modal-content animate" style="width:50%;">
                  <div class="main">
                    <form class="form" method="post" action="#">
                      <span onclick="document.getElementById('login').style.display='none'" class="close" title="Close Modal">&times;</span>
                      <h2>Login</h2>
                      <label>Username :</label>
                      <br>
                      <input type="text" name="username" id="username">
                      <br><br><br><br>
                      <label>Password :</label>
                      <br>
                      <input type="password" name="password" id="password">
                      <br><br><br>
                      <input type="button" name="login" id="login" value="Login">
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
        <div id="create-recipe">
          <section id="create" class="modal">
            <div class="page-content">
              <div class="pre-login" style="display:flex;justify-content:center;align-items:center;">
                <div class="container card-back login-screen modal-content animate" style="width:50%;">
                  <div class="main">
                    <form class="form" method="post" action="#">
                      <span onclick="document.getElementById('create').style.display='none'" class="close" title="Close Modal">&times;</span>
                      <h2>Create New Recipe</h2>
                      <label>Name</label>
                      <br>
                      <input type="text" name="name" id="create-name">
                      <br><br><br><br>
                      <label>Description</label>
                      <br>
                      <input type="text" name="description" id="create-description">
                      <br><br><br>
                      <input type="button" name="create" id="create-button" value="create">
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </main>
    <script src="controller.js"></script>
  </body>
