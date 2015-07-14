<?php

   class UserEditAction extends AbstractEditAction implements Action {

      public function commit( $content ) {
         if ( $content['checkpointFk'] == "" ) {
            $content['checkpointFk'] = null;
         }
         return $this->genericCommit("user", "user", "userEdit", $content);
      }
   
   }

?>
