<?php

   include( 'page/stockExchangeDispatch/PriceCalculator.php' );

   class RacerDispatchAction extends AbstractEditAction implements Action {

      public function commit( $content ) {
         $price = PriceCalculator::dispatchTask( CommonDbFunction::getUser()->raceFk, $content['taskId'] );
         $dbFunction = new RacerTaskDbFunction();
         $racerTaskId = $dbFunction->dispatch( $content['racerId'],$content['taskId'], $price );
         $dbFunction->startRacerTask( $racerTaskId );
         $dbFunction->close();
         return null;
      }
   
   }

?>
