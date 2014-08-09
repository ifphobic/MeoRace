<?php

   class RacerTaskModule implements Module {

      private $pages;

      public function RacerTaskModule() {
         $this->pages = array(
            new ModulePage("racerList", "Racer List", array(Role::CHECKPOINT), null, false, true, array( "racer/Racer" ) ), 
            new ModulePage("racerTask", "RacerTask", array(Role::CHECKPOINT), null, false, false, array( "racer/Racer" ) ), 
            new ModulePage("actionConfirm", "xxx", array(Role::CHECKPOINT), array(Role::CHECKPOINT), true, false, array( "racer/Racer", "parcel/Parcel" ) ), 
         );
      }

      public function getPages() {
         return $this->pages;
      }

   }


?>
