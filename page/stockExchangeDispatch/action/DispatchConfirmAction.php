<?php

   include( 'page/stockExchangeDispatch/PriceCalculator.php' );

   class DispatchConfirmAction extends AbstractEditAction implements Action {

      public function commit( $content ) {
         $raceId = CommonDbFunction::getUser()->raceFk;
         if ( ! RaceDbFunction::isPrepare( $raceId ) ) {
            PriceCalculator::dispatchTask( $raceId, $content['taskId'] );
         }
         $dbFunction = new RacerTaskDbFunction();
         $racerTaskId = $dbFunction->dispatch( $content['racerId'],$content['taskId'], $content['price'] );
         $dbFunction->startRacerTask( $racerTaskId );
         $dbFunction->close();
         return null;
      }
   
   }

?>
