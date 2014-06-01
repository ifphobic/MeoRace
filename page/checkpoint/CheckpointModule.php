<?php

   class CheckpointModule implements Module {

      private $pages;

      public function CheckpointModule() {
         $this->pages = array(
            new ModulePage("checkpointList", "Checkpoint List", array(Role::RACE_MASTER), null, false, true ), 
            new ModulePage("checkpointEdit", "Edit Checkpoint", array(Role::RACE_MASTER), array(Role::RACE_MASTER), true, false )
         );
      }

      public function getPages() {
         return $this->pages;
      }

   }


?>
