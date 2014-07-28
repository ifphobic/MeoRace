<?php

   class PriceCalculator {


      public static function dispatchTask( $raceId, $taskId ) {

         $dbFunction = new StockExchangeDispatchDbFunction();
         $racerTasks = $dbFunction->findAll( $raceId );

         $counter = 0;
         $priceDelta = 0;
         
         foreach ( $racerTasks as $racerTask ) {
            if ( $racerTask->taskFk == $taskId ) {
               $racerTask->counter++;
               $priceDelta = $racerTask->price - ( $racerTask->price / 2 ); 
               $racerTask->price /= 2;
            }
            $counter += $racerTask->counter;
         }
         
         foreach ( $racerTasks as $racerTask ) {
            $dbFunction->update( $racerTask );
         }
      }

   }


?>
