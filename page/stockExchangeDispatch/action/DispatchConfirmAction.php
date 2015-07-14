<?php

   include( 'page/stockExchangeDispatch/PriceCalculator.php' );

   class DispatchConfirmAction extends AbstractEditAction implements Action {

      public function commit( $content ) {
         $user = CommonDbFunction::getUser();
         $raceId = $user->raceFk;
         $checkpointId = $user->checkpointFk;
         if ( ! RaceDbFunction::isPrepare( $raceId ) ) {
            PriceCalculator::dispatchTask( $raceId, $checkpointId, $content['taskId'] );
         }
         $dbFunction = new RacerTaskDbFunction();
         $racerTaskId = $dbFunction->dispatch( $content['racerId'],$content['taskId'], $content['price'] );
         $dbFunction->startRacerTask( $racerTaskId );
         $dbFunction->close();
         return null;
      }
   
   }

?>
