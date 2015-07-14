<?php

   class StockExchangeDispatchModule implements Module {

      private $pages;

      public function StockExchangeDispatchModule() {
         $this->pages = array(
            new ModulePage("racerList", "Dispatch", array(Role::CHECKPOINT, Role::RACE_MASTER), null, false, true, array("racer/Racer", "race/Race") ), 
            new ModulePage("taskDispatch", "Task Dispatch", array(Role::CHECKPOINT, Role::RACE_MASTER, Role::NO_ROLE), null, false, false, array("race/Race") ), 
            new ModulePage("dispatchConfirm", "Confirm Dispatch", array(Role::CHECKPOINT, Role::RACE_MASTER), array(Role::CHECKPOINT, Role::RACE_MASTER), true, false, array("racer/Racer", "race/Race", "race/Task", "racerTask/RacerTask")  ), 
         );
      }

      public function getPages() {
         return $this->pages;
      }

   }


?>
