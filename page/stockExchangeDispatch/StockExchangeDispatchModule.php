<?php

   class StockExchangeDispatchModule implements Module {

      private $pages;

      public function StockExchangeDispatchModule() {
         $this->pages = array(
            new ModulePage("racerList", "Dispatch", array(Role::DISPATCHER), null, false, true, array("racer/Racer") ), 
            new ModulePage("taskDispatch", "Task Dispatch", array(Role::DISPATCHER), null, false, false ), 
            new ModulePage("dispatchConfirm", "Confirm Dispatch", array(Role::DISPATCHER), array(Role::DISPATCHER), true, false, array("racer/Racer", "race/Task", "racerTask/RacerTask")  ), 
         );
      }

      public function getPages() {
         return $this->pages;
      }

   }


?>
