<?php

   class ActionConfirmAction extends AbstractEditAction implements Action {

      public function commit( $content ) {
          $dbFunction = new RacerTaskDbFunction();
          $racerTaskId = $dbFunction->doAction( $content['racerDeliveryId'], $content['isDropoff'], $content['manned'] );
          $racerTaskId = $dbFunction->stopRacerTask( $content['racerTaskId'] );
          $dbFunction->close();
          return null;

      
      }
   
   }

?>
