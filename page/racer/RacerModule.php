<?php

   class RacerModule implements Module {

      private $pages;

      public function RacerModule() {
         $this->pages = array(
            new ModulePage("racerList", "Racer List", array(Role::RACE_MASTER), null, false, true ), 
            new ModulePage("editRacer", "Edit Racer", array(Role::RACE_MASTER), array(Role::RACE_MASTER), true, false )
         );
      }

      public function getPages() {
         return $this->pages;
      }

   }


?>
