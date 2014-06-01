<?php

   class EditRaceAction extends AbstractEditAction implements Action {

      public function commit( $content ) {
         return $this->genericCommit("race", "race", $content);
      }
   
   }

?>
