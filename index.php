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
      <section id="home-page">
        <div class="page-content">
          <div style="display:flex;justify-content:center;align-items:center;">
            <div class="mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--8-col">
              <h2>Reverse Cook Book</h2>
              <br><br>
              <text>Welcome</text>
              <br><br>
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
            <form class="card-back login-screen modal-content animate" style="width:50%;">
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
                <button type="submit" class="card-hover mdl-button mdl-js-button mdl-js-ripple-effect";>LOGIN</button>
                <div>
                  <button class="card-hover psw mdl-button mdl-js-button mdl-button-accent mdl-js-ripple-effect">FORGOT PASSWORD</button>
                	<button id="create" class="card card-hover create mdl-button mdl-js-button mdl-button--colored mdl-button-accent mdl-js-ripple-effect">CREATE ACCOUNT</button>
                  <button id="login" onclick class="card-hover psw mdl-button mdl-js-button mdl-button-accent mdl-js-ripple-effect">LET ME IN</button>
                </div>
              </div>
            </form>
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
<html>
