<?php

   class RacerTaskModule implements Module {

      private $pages;

      public function RacerTaskModule() {
         $this->pages = array(
            new ModulePage("racerList", "Checkpoint Actions", array(Role::CHECKPOINT), null, false, true, array( "racer/Racer", "race/Race" ) ), 
            new ModulePage("racerTask", "Racer Actions", array(Role::CHECKPOINT), null, false, false, array( "racer/Racer", "race/Race" ) ), 
            new ModulePage("actionConfirm", "Confirm Action", array(Role::CHECKPOINT), array(Role::CHECKPOINT), true, false, array( "racer/Racer", "parcel/Parcel", "race/Race" ) ), 
         );
      }

      public function getPages() {
         return $this->pages;
      }

   }


?>
