<?php

   class RaceModule implements Module {

      private $pages;

      public function RaceModule() {
         $this->pages = array(
            new ModulePage("raceList", "Race List", array(Role::ADMIN), null, false, true ), 
            new ModulePage("editRace", "Edit Race", array(Role::ADMIN), array(Role::ADMIN), true, false )
         );
      }

      public function getPages() {
         return $this->pages;
      }

   }


?>
