<?php

   class RacerTaskModule implements Module {

      private $pages;

      public function RacerTaskModule() {
         $this->pages = array(
            new ModulePage("racerList", "Racer List", array(Role::CHECKPOINT), null, false, true, array( "racer/Racer" ) ), 
            new ModulePage("racerTask", "RacerTask", array(Role::CHECKPOINT), null, false, false ), 
            new ModulePage("actionConfirm", "xxx", array(Role::CHECKPOINT), array(Role::CHECKPOINT), true, false ), 
         );
      }

      public function getPages() {
         return $this->pages;
      }

   }


?>
