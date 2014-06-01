<?php

   class LoginModule implements Module {

      private $pages;

      public function LoginModule() {
         $this->pages = array(
            new ModulePage("login", "Login", array(Role::NO_ROLE), array(Role::NO_ROLE), true, true ),
            new ModulePage("userList", "User List", array(Role::ADMIN, Role::RACE_MASTER), null, false, true ), 
            new ModulePage("userEdit", "Edit User", array(Role::ADMIN, Role::RACE_MASTER), array(Role::ADMIN, Role::RACE_MASTER), true, false, array( "race" ) )
         );
      }

      public function getPages() {
         return $this->pages;
      }

   }


?>
