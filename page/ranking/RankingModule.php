<?php

   class RankingModule implements Module {

      private $pages;

      public function RankingModule() {
         $this->pages = array(
            new ModulePage("rankingOverview", "Ranking Overview", Role::getAllRoles(true), null, false, CommonDbFunction::getUser() == null || CommonDbFunction::userHasRace(), array( "race/Race" )  ), 
            new ModulePage("rankingDetail", "Ranking Detail", Role::getAllRoles(true), null, false, false, array( "racer/Racer", "race/Race" ) ), 
            new ModulePage("taskDetail", "Manifest Detail", Role::getAllRoles(true), null, false, false, array( "race/Race" ) ),
            new ModulePage("parcelDetail", "Task Detail", Role::getAllRoles(true), null, false, false ),
         );
      }

      public function getPages() {
         return $this->pages;
      }

   }


?>
