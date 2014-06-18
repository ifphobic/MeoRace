<?php

   class DeliveryDeleteAction implements Action {

      public function commit( $content ) {
         $dbFunction = new DeliveryDbFunction ();
         $dbFunction->delete( $content['deliveryId'] );
         $dbFunction->close();
         return new NextPage( "race", "deliveryList", array( "id" => $content["taskId"] ) );
      }
   
   }

?>
