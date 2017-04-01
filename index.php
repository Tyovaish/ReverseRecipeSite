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
    <div class="pre-login" style="display:flex;justify-content:center;align-items:center;">
      <form class="card-rounded login-screen" style="width:50%;">
        <h1>Reverse Cookbook</h1>
        <div class="container">
          <label><b>Username</b></label>
          <br>
          <input type="text" placeholder="Enter Username" name="uname" class="card card-hover" required>
          <br><br><br>
          <label><b>Password</b></label>
          <br>
          <input type="password" placeholder="Enter Password" name="psw" class="card card-hover" required>
          <br><br><br>
          <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="rememberme">
          <input type="checkbox" id="rememberme" class="mdl-checkbox__input" checked />
          <span class="mdl-checkbox__label">Remember Me</span>
          <br><br>
          <button type="submit" class="card-hover mdl-button mdl-js-button mdl-js-ripple-effect";>LOGIN</button>
          <div>
            <button class="card-hover psw mdl-button mdl-js-button mdl-button-accent mdl-js-ripple-effect">FORGOT PASSWORD</button>
          	<button onclick="location.href = 'index.html';" id="create" class="card card-hover create mdl-button mdl-js-button mdl-button--colored mdl-button-accent mdl-js-ripple-effect">CREATE ACCOUNT</button>
          </div>
        </div>
      </form>
    </div>

    <div class="create-account">
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
          <div class="clearfix">
            <button type="button"  class="cancelbtn">Cancel</button>
            <button type="submit" class="signupbtn">Sign Up</button>
          </div>
        </div>
      </form>
    </div>

    <div class="home-page">
      <h1>Reverse Cook Book</h1>
      <br><br>
      <text>You are logged in!</text>
      <br><br>
      <?php
        include 'oracle.php';
      ?>
    </div>

    <script src="controller.js"></script>
  </body>
<html>
