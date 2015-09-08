<?php

   include "core/include.php";
   include "page/user/UserDbFunction.php";

   if ( isset( $_COOKIE['sessionId'] ) ) {
      $dbFunction = new CommonDbFunction();
      $dbFunction->logout( $_COOKIE['sessionId'] );
      $dbFunction->close();
      if ( !isset( $_GET['raceId'] ) ) {
         print("<head><meta http-equiv='refresh' content='0; URL=index.php' /></head> ");
         exit;
      }
   }

   $parameter = "";
   if (isset( $_GET['raceId'] ) ) {
      $dbFunction = new UserDbFunction();
      $sessionId = $dbFunction->insertSession( Configuration::GUEST_USER_ID, $_GET['raceId'] );
      $dbFunction->close();
      $parameter = "?ranking";
   } else if ( isset( $_POST["user"] ) && isset( $_POST["password"] ) ) {
      $dbFunction = new UserDbFunction();
      $user = $dbFunction->findUser( $_POST["user"] );
      if ( isset( $user ) ) {

         //if ( strcmp($user->password, $_POST["password"] ) == 0 ) {
         if ( strcmp($user->password, hash( "sha256" , $_POST["password"] ) ) == 0 ) {
            $sessionId = $dbFunction->insertSession($user->userId, null );
         }
      }
      $dbFunction->close();
   }

   if ( isset( $sessionId ) ) {
      print("<head><meta http-equiv='refresh' content='0; URL=index.php$parameter' /></head> ");
      exit;
   }

?>
<html>
   <head>
      <title>MeoRace Login</title>
      <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
      <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
      <link href="core/html/design_new.css" rel="stylesheet">
      <link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
   </head>

   <body>

      <div class="flexbox-wrapper">

        <header class="flexbox-header">

          <div class="back-button">
          <a href="index.php"></a>
          </div>

        </header>

        <div class="login-wrapper">

          <h1 class="login">Login to RSW</h1>

          <form method='post' action='login.php'>
          <label for="User" class="User"> <input name="user" type="text" placeholder="User" />
          <label for="Password" class="Password"> <input name="password" type="password" placeholder="Password" />
          <input type='submit' name='login' />
          <input type="button" onclick="location.href='index.php';" value="cancel" />

      </div><!-- login-wrapper -->

      </form>
      </div>
   </body>
</html>
