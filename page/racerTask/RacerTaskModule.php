<?php

   class RacerTaskModule implements Module {

      private $pages;

      public function RacerTaskModule() {
         $this->pages = array(
            new ModulePage("racerTask", "RacerTask", array(Role::DISPATCHER), null, false, true ), 
         );
      }

      public function getPages() {
         return $this->pages;
      }

   }


?>
