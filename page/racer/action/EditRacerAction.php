<?php

   class EditRacerAction extends AbstractEditAction implements Action {

      public function commit( $content ) {
         return $this->genericCommit("racer", "racer", $content);
      }
   
   }

?>
