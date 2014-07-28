<?php

   class StockExchangeDispatchModule implements Module {

      private $pages;

      public function StockExchangeDispatchModule() {
         $this->pages = array(
            new ModulePage("taskDispatch", "Task Dispatch", array(Role::DISPATCHER), null, false, true, array("race/Task") ), 
         );
      }

      public function getPages() {
         return $this->pages;
      }

   }


?>
