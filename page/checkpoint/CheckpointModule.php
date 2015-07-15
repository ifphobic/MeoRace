<?php

   class CheckpointModule implements Module {

      private $pages;

      public function CheckpointModule() {
         $this->pages = array(
            new ModulePage("checkpointList", "Checkpoint List", array(Role::ADMIN, Role::RACE_MASTER), null, false, CommonDbFunction::userHasRace() ), 
            new ModulePage("checkpointEdit", "Edit Checkpoint", array(Role::ADMIN, Role::RACE_MASTER), array(Role::ADMIN, Role::RACE_MASTER), true, false )
         );
      }

      public function getPages() {
         return $this->pages;
      }

   }


?>
