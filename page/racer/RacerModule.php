<?php

   class RacerModule implements Module {

      private $pages;

      public function RacerModule() {
         $this->pages = array(
            new ModulePage("racerList", "Racer List", array(Role::RACE_MASTER, Role::REGISTRATION), null, false, true ), 
            new ModulePage("racerEdit", "Edit Racer", array(Role::RACE_MASTER, Role::REGISTRATION), array(Role::RACE_MASTER, Role::REGISTRATION), true, false )
         );
      }

      public function getPages() {
         return $this->pages;
      }

   }


?>
