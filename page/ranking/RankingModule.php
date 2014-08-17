<?php

   class RankingModule implements Module {

      private $pages;

      public function RankingModule() {
         $this->pages = array(
            new ModulePage("rankingOverview", "Ranking Overview", array(Role::RACE_MASTER, Role::DISPATCHER, Role::CHECKPOINT), null, false, true ), 
            new ModulePage("rankingDetail", "Ranking Detail", array(Role::RACE_MASTER, Role::DISPATCHER, Role::CHECKPOINT), null, false, false, array( "racer/Racer" ) ), 
            new ModulePage("taskDetail", "Manifest Detail", array(Role::RACE_MASTER, Role::DISPATCHER, Role::CHECKPOINT), null, false, false ),
            new ModulePage("parcelDetail", "Task Detail", array(Role::RACE_MASTER, Role::DISPATCHER, Role::CHECKPOINT), null, false, false ),
         );
      }

      public function getPages() {
         return $this->pages;
      }

   }


?>
