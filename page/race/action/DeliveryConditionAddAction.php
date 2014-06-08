<?php

   class DeliveryConditionAddAction extends AbstractEditAction implements Action {

      public function commit( $content ) {
         return $this->genericCommit("race", "xxxx", "deliveryList", $content, "deliveryCondition", "id=" . $content['taskId'] );
      }
   
   }

?>
