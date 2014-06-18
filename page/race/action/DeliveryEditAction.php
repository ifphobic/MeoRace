<?php

   class DeliveryEditAction extends AbstractEditAction implements Action {

      public function commit( $content ) {
         return $this->genericCommit("race", "delivery", "deliveryList", $content, "delivery", array("id" => $content['taskFk'] ) );
      }
   
   }

?>
