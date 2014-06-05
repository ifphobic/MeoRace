<?php

   class LoginAction implements Action {

      public function commit( $content ) {

         $dbFunction = new UserDbFunction();
         $user = $dbFunction->findUser( $content["user"] );
         if ( isset( $user ) ) {
            
            //if ( strcmp($user->password, $content["password"] ) == 0 ) {
            if ( strcmp($user->password, hash( "sha256" , $content["password"] ) ) == 0 ) {
               
               $sessionId = $dbFunction->insertSession($user);
            }
         }

         $dbFunction->close();

         if ( isset( $sessionId ) ) {
            $result = new NextPage( null, null );
         } else {
            $result = new NextPage( "user", "login" );
         }
         return $result;
      }
   
   }

?>
