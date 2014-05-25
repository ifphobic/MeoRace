<?php


   class LoginAction implements Action {

      public function commit() {

         $result = new NextPage("login", "login");
         return $result;
      }
   
   }

?>
