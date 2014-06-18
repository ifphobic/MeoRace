<?php

   class UserEditAction extends AbstractEditAction implements Action {

      public function commit( $content ) {
         return $this->genericCommit("user", "user", "userEdit", $content);
      }
   
   }

?>
