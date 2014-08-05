<?php

   include "core/include.php";
   include "page/user/UserDbFunction.php";

   if ( isset( $_COOKIE['sessionId'] ) ) {
      $dbFunction = new CommonDbFunction();
      $dbFunction->logout( $_COOKIE['sessionId'] );
      $dbFunction->close();
   }

   if ( isset( $_POST["user"] ) && isset( $_POST["password"] ) ) {
         $dbFunction = new UserDbFunction();
         $user = $dbFunction->findUser( $_POST["user"] );
         if ( isset( $user ) ) {

            //if ( strcmp($user->password, $_POST["password"] ) == 0 ) {
            if ( strcmp($user->password, hash( "sha256" , $_POST["password"] ) ) == 0 ) {
               $sessionId = $dbFunction->insertSession($user);
            }
         }
         $dbFunction->close();

         if ( isset( $sessionId ) ) {
            print("<head><meta http-equiv='refresh' content='0; URL=index.php' /></head> "); 
            exit;
         }
   
   }


?>
<html>
   <head>
      <title>MeoRace Login</title>
      <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
      <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
      <link href="core/html/design.css" rel="stylesheet">
      <link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
   </head>

   <body>
      <div style="max-width: 560px; padding: 15px;">
      <form method='post' action='login.php'>
         <label for="User" class="User"> <input name="user" type="text" placeholder="User" /><br>
         <label for="Password" class="Password"> <input name="password" type="password" placeholder="Password" /><br>
         <input type='submit' name='login' />

      </form>
      </div>
   </body>
</html>
