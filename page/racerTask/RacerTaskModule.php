<?php

   class RacerTaskModule implements Module {

      private $pages;

      public function RacerTaskModule() {
         $this->pages = array(
            new ModulePage("racerList", "Racer List", array(Role::DISPATCHER), null, false, true, array( "racer/Racer" ) ), 
            new ModulePage("racerTask", "RacerTask", array(Role::DISPATCHER), null, false, true ), 
            new ModulePage("actionConfirm", "xxx", array(Role::DISPATCHER), array(Role::DISPATCHER), true, false ), 
         );
      }

      public function getPages() {
         return $this->pages;
      }

   }


?>
