<?php

   class DeliveryConditionDeleteAction implements Action {

      public function commit( $content ) {
         $dbFunction = new DeliveryConditionDbFunction ();
         $dbFunction->delete( $content['deliveryConditionId'] );
         $dbFunction->close();
         return new NextPage( "race", "deliveryList", array( "taskId" => $content['taskId'] ) );
      }
   
   }

?>
