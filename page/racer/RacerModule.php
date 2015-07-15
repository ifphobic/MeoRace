<?php

   class RacerModule implements Module {

      private $pages;

      public function RacerModule() {
         $this->pages = array(
            new ModulePage("racerList", "Racer List", array(Role::RACE_MASTER, Role::REGISTRATION, Role::ADMIN), null, false, CommonDbFunction::userHasRace() ), 
            new ModulePage("racerEdit", "Edit Racer", array(Role::RACE_MASTER, Role::REGISTRATION, Role::ADMIN), array(Role::RACE_MASTER, Role::REGISTRATION, Role::ADMIN), true, false )
         );
      }

      public function getPages() {
         return $this->pages;
      }

   }


?>
