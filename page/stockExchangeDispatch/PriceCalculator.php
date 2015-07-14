<?php

   class PriceCalculator {


      public static function dispatchTask( $raceId, $checkpointId, $taskId ) {

         $dbFunction = new StockExchangeDispatchDbFunction();
         $racerTasks = $dbFunction->findAll( $raceId, $checkpointId );

         $priceDelta = 0;
         $min = 9999999;
         $max = 0;
         
         $noFixPrice = array();
         foreach ( $racerTasks as $racerTask ) {
            if ( !$racerTask->fixPrice ) {
               if ( $racerTask->taskFk == $taskId ) {
                  $racerTask->counter++;
                  $priceDelta = $racerTask->price / 3; 
                  $racerTask->price -= $priceDelta;
               }
               $min = min( $min, $racerTask->counter );
               $max = max( $max, $racerTask->counter );
               $noFixPrice[] = $racerTask;
            } else if ( $racerTask->taskFk == $taskId ) {
               return;
            }
         }
        
         $max++;
         $totalDifference = 0;
         foreach ( $noFixPrice as $racerTask ) {
            $totalDifference += $max - $racerTask->counter;
         }

         foreach ( $noFixPrice as $racerTask ) {
            $racerTask->price += $priceDelta * ( $max - $racerTask->counter) / $totalDifference ;
            $dbFunction->update( $racerTask );
         }
      }

   }


?>
