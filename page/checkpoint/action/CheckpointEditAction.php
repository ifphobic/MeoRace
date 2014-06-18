<?php

   class CheckpointEditAction extends AbstractEditAction implements Action {

      public function commit( $content ) {
         if ( !isset( $content['manned'] ) ) {
            $content['manned'] = 0;
         }
         return $this->genericCommit("checkpoint", "checkpoint", "checkpointEdit", $content);
      }
   
   }

?>
