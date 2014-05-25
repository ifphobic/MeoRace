<?php

   class LoginModule implements Module {

      private $pages;

      public function LoginModule() {
         $this->pages = array( new ModulePage("login", "Login", array(ModulePage::NO_ROLE), true ) );
      }

      public function getPages() {
         return $this->pages;
      }

   }


?>
