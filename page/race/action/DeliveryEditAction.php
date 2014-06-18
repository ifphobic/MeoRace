<?php

   class DeliveryEditAction extends AbstractEditAction implements Action {

      public function commit( $content ) {
         return $this->genericCommit("race", "delivery", "deliveryEdit", $content, "delivery", array("taskId" => $content['taskFk'] ) );
      }
   
   }

?>
