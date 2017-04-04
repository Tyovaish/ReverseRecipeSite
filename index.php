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
            <span class="mdl-layout__title" style="color: black; background-color: rgba(255, 255, 255, 0.7); height: 24px; width: 200px; margin: auto;">Reverse Cookbook</span>
          </span>
          <a id="login-button" onclick="document.getElementById('login').style.display='block'" class="mdl-button mdl-js-button mdl-js-ripple-effect";>LOGIN</a>
        </div>
      </header>
    <main id="content"class="mdl-layout__content">
      <br>
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
          </div>
          <div class="mdl-cell mdl-card mdl-shadow--4dp">
            <div class="mdl-card__title">
              <h2 class="mdl-card__title-text">Recipes</h2>
            </div>
            <div class="mdl-card__supporting-text">
              <?php
                include 'oracle.php';
              ?>
            </div>
          </div>
        </div>
      </section>
      <section id="login" class="modal">
        <div class="page-content">
          <div class="pre-login" style="display:flex;justify-content:center;align-items:center;">
            <!-- Output error message if any -->
            <?php echo $error; ?>

            <!-- form for login -->
            <form method="post" action="index.php" class="card-back login-screen modal-content animate" style="width:50%;">
                <label for="username">Username:</label><br/>
                <input type="text" name="username" id="username"><br/>
                <label for="password">Password:</label><br/>
                <input type="password" name="password" id="password"><br/>
                <input type="submit" value="Log In!">
            </form>
            <!-- <form class="card-back login-screen modal-content animate" style="width:50%;">
              <br>
              <span onclick="document.getElementById('login').style.display='none'" class="close" title="Close Modal">&times;</span>
              <h3>Login</h3>
              <div class="container">
                <label><b>Username</b></label>
                <br>
                <input type="text" placeholder="Enter Username" name="uname" class="card card-hover" required>
                <br><br>
                <label><b>Password</b></label>
                <br>
                <input type="password" placeholder="Enter Password" name="psw" class="card card-hover" required>
                <br>
                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="rememberme">
                <input type="checkbox" id="rememberme" class="mdl-checkbox__input" checked />
                <span class="mdl-checkbox__label">Remember Me</span>
                <br><br>
                <button type="submit" class="modal-buttons card-hover mdl-button mdl-js-button mdl-js-ripple-effect";>LOGIN</button>
                <div>
                  <button class="modal-buttons card-hover psw mdl-button mdl-js-button mdl-button-accent mdl-js-ripple-effect">FORGOT PASSWORD</button>
                	<button id="create" class="modal-buttons card card-hover create mdl-button mdl-js-button mdl-button--colored mdl-button-accent mdl-js-ripple-effect">CREATE ACCOUNT</button>
                </div>
              </div>
            </form> -->
          </div>
        </div>
      </section>
      <section id="create-account">
        <div>
          <form>
            <div class="container">
              <label><b>Email</b></label>
              <input type="text" placeholder="Enter Email" name="email" required>
              <label><b>Password</b></label>
              <input type="password" placeholder="Enter Password" name="psw" required>
              <label><b>Repeat Password</b></label>
              <input type="password" placeholder="Repeat Password" name="psw-repeat" required>
              <input type="checkbox" checked="checked"> Remember me
              <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
              <div>
                <button type="button"  class="cancelbtn">Cancel</button>
                <button type="submit" class="signupbtn">Sign Up</button>
              </div>
            </div>
          </form>
        </div>
      </section>
    </main>
    <script src="controller.js"></script>
  </body>
<!DOCTYPE HTML>

<?php

    // Start the session
    session_start();

    // Defines username and password. Retrieve however you like,
    $username = "user";
    $password = "password";

    // Error message
    $error = "";

    // Checks to see if the user is already logged in. If so, refirect to correct page.
    if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
        $error = "success";
        header('Location: success.php');
    }

    // Checks to see if the username and password have been entered.
    // If so and are equal to the username and password defined above, log them in.
    if (isset($_POST['username']) && isset($_POST['password'])) {
        if ($_POST['username'] == $username && $_POST['password'] == $password) {
            $_SESSION['loggedIn'] = true;
            header('Location: success.php');
        } else {
            $_SESSION['loggedIn'] = false;
            $error = "Invalid username and password!";
        }
    }
?>
