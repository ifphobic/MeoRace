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

   <body>

      <form method='post' action='login.php'>
         Benutzer: <input name="user" /><br>
         Passwort: <input name="password" type="password" /><br>
         <input type='submit' name='login' />

      </form>
   </body>
</html>
