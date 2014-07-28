<?php

   class StockExchangeDispatchModule implements Module {

      private $pages;

      public function StockExchangeDispatchModule() {
         $this->pages = array(
            new ModulePage("taskDispatch", "Task Dispatch", array(Role::DISPATCHER), null, false, true ), 
            new ModulePage("racerList", "Racer List", array(Role::DISPATCHER), null, false, false, array("racer/Racer") ), 
            new ModulePage("racerDispatch", "Racer Dispatch", array(Role::DISPATCHER), array(Role::DISPATCHER), true, false, array("racer/Racer", "race/Task")  ), 
         );
      }

      public function getPages() {
         return $this->pages;
      }

   }


?>
