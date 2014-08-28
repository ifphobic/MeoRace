<?php

   include( 'page/stockExchangeDispatch/PriceCalculator.php' );

   class DispatchConfirmAction extends AbstractEditAction implements Action {

      public function commit( $content ) {
         PriceCalculator::dispatchTask( CommonDbFunction::getUser()->raceFk, $content['taskId'] );
         $dbFunction = new RacerTaskDbFunction();
         $racerTaskId = $dbFunction->dispatch( $content['racerId'],$content['taskId'], $content['price'] );
         $dbFunction->startRacerTask( $racerTaskId );
         $dbFunction->close();
         return null;
      }
   
   }

?>
