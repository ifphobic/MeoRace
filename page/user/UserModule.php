<?php

   class UserModule implements Module {

      private $pages;

      public function UserModule() {
         $this->pages = array(
            new ModulePage("userList", "User List", array(Role::ADMIN, Role::RACE_MASTER), null, false, CommonDbFunction::userHasRace() || Role::isAdmin( CommonDbFunction::getUser() )), 
            new ModulePage("userEdit", "Edit User", array(Role::ADMIN, Role::RACE_MASTER), array(Role::ADMIN, Role::RACE_MASTER), true, false, array( "race/Race", "checkpoint/Checkpoint" ) )
         );
      }

      public function getPages() {
         return $this->pages;
      }

   }


?>
