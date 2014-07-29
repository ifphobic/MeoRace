<?php

   class PriceCalculator {


      public static function dispatchTask( $raceId, $taskId ) {

         $dbFunction = new StockExchangeDispatchDbFunction();
         $racerTasks = $dbFunction->findAll( $raceId );

         $priceDelta = 0;
         $min = 9999999;
         $max = 0;

         foreach ( $racerTasks as $racerTask ) {
            if ( $racerTask->taskFk == $taskId ) {
               $racerTask->counter++;
               $priceDelta = $racerTask->price - ( $racerTask->price / 2 ); 
               $racerTask->price /= 2;
            }
            if ( $min > $racerTask->counter ) {
               $min = $racerTask->counter;
            }
            if ( $max < $racerTask->counter ) {
               $max = $racerTask->counter;
            }
         }
         
         $max++;
         $totalDifference = 0;
         foreach ( $racerTasks as $racerTask ) {
            $totalDifference += $max - $racerTask->counter;
         }

         foreach ( $racerTasks as $racerTask ) {
            $racerTask->price += round( $priceDelta * ( $max - $racerTask->counter) / $totalDifference, 0, PHP_ROUND_HALF_DOWN );
            $dbFunction->update( $racerTask );
         }
      }

   }


?>
