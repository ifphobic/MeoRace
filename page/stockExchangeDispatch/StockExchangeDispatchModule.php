<?php

   class StockExchangeDispatchModule implements Module {

      private $pages;

      public function StockExchangeDispatchModule() {
         $this->pages = array(
            new ModulePage("racerList", "Dispatch", array(Role::CHECKPOINT, Role::RACE_MASTER, Role::ADMIN), null, false, CommonDbFunction::userHasRace(), array("racer/Racer", "race/Race") ), 
            new ModulePage("taskDispatch", "Task Dispatch", array(Role::CHECKPOINT, Role::RACE_MASTER, Role::ADMIN, Role::NO_ROLE), null, false, CommonDbFunction::userIsNoRole(), array("race/Race") ), 
            new ModulePage("dispatchConfirm", "Confirm Dispatch", array(Role::CHECKPOINT, Role::RACE_MASTER, Role::ADMIN), array(Role::CHECKPOINT, Role::RACE_MASTER, Role::ADMIN), 
                           true, false, array("racer/Racer", "race/Race", "race/Task", "racerTask/RacerTask")  ), 
         );
      }

      public function getPages() {
         return $this->pages;
      }

   }


?>
