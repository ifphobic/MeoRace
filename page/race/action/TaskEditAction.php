<?php

   class TaskEditAction extends AbstractEditAction implements Action {

      public function commit( $content ) {
         if ( !isset( $content['fixPrice'] ) ) {
            $content['fixPrice'] = 0;
         }
         if ( $content['dispatchCheckpointFk'] == "" ) {
            $content['dispatchCheckpointFk'] = null;
         }
         return $this->genericCommit("race", "task", "taskEdit", $content, "task");
      }
   
   }

?>
