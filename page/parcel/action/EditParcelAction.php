<?php

   class EditParcelAction extends AbstractEditAction implements Action {

      public function commit( $content ) {
         return $this->genericCommit("parcel", "parcel", $content);
      }
   
   }

?>
