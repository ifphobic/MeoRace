<?php

   class RacerEditAction extends AbstractEditAction implements Action {

      public function commit( $content ) {
         return $this->genericCommit("racer", "racer", "racerEdit", $content);
      }
   
   }

?>
