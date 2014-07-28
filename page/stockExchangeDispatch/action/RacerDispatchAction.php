<?php

   include( 'page/stockExchangeDispatch/PriceCalculator.php' );

   class RacerDispatchAction extends AbstractEditAction implements Action {

      public function commit( $content ) {
        
        PriceCalculator::dispatchTask( CommonDbFunction::getUser()->raceFk, $content['taskId'] );
        

        return null;
      }
   
   }

?>
