<?php

   class EditUserAction extends AbstractEditAction implements Action {

      public function commit( $content ) {
         return $this->genericCommit("login", "user", $content);
      }
   
   }

?>
