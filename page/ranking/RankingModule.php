<?php

   class RankingModule implements Module {

      private $pages;

      public function RankingModule() {
         $this->pages = array(
            new ModulePage("rankingOverview", "Ranking Overview", array(Role::RACE_MASTER, Role::DISPATCHER, Role::CHECKPOINT, Role::NO_ROLE), null, false, true, array( "race/Race" )  ), 
            new ModulePage("rankingDetail", "Ranking Detail", array(Role::RACE_MASTER, Role::DISPATCHER, Role::CHECKPOINT, Role::NO_ROLE), null, false, false, array( "racer/Racer", "race/Race" ) ), 
            new ModulePage("taskDetail", "Manifest Detail", array(Role::RACE_MASTER, Role::DISPATCHER, Role::CHECKPOINT, Role::NO_ROLE), null, false, false, array( "race/Race" ) ),
            new ModulePage("parcelDetail", "Task Detail", array(Role::RACE_MASTER, Role::DISPATCHER, Role::CHECKPOINT, Role::NO_ROLE), null, false, false ),
         );
      }

      public function getPages() {
         return $this->pages;
      }

   }


?>
