<?php

   class RaceEditAction extends AbstractEditAction implements Action {

      public function commit( $content ) {
         return $this->genericCommit("race", "race", null, $content);
      }
   
   }

?>
