<?php

   class ParcelEditAction extends AbstractEditAction implements Action {

      public function commit( $content ) {
         return $this->genericCommit("parcel", "parcel", "parcelEdit", $content);
      }
   
   }

?>
