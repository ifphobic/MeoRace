<?php

   class RankingCalculator {



      public static function evaluate( $racerTasks ) {

         $rankings = array();

         foreach ( $racerTasks as $racerTask ) {

            if ( !isset( $rankings[ $racerTask->racerId ] ) ) {
               $rankings[ $racerTask->racerId ] = RankingCalculator::createRanking( $racerTask );
            }
            $ranking = $rankings[ $racerTask->racerId ];

            if ( $racerTask->taskTime != null ) {
               if ( $racerTask->taskTime > $racerTask->maxDuration ) {
                  $racerTask->price = round( $racerTask->price / 2 );
               }
               $ranking->score += $racerTask->price;
            }

         }

         usort( $rankings, function( $a, $b ) { return $a->score < $b->score; } );

         $counter = 1;
         $lastRanking = 1;
         $lastScore = 0;
         foreach ( $rankings as $ranking ) {
            
            if ( $lastScore != $ranking->score ) {
               $ranking->ranking = $counter;
               $lastRanking = $counter;
               $lastScore =  $ranking->score;
            } else {
               $ranking->ranking = $lastRanking;
            }

            $counter++;
         }

         return $rankings;
      }

      private static function createRanking( $racerTask ) {
         $ranking = new StdClass();
         $ranking->score = 0;
         $ranking->racerId =  $racerTask->racerId;
         $ranking->racerNumber =  $racerTask->racerNumber;
         $ranking->name =  $racerTask->name;
         $ranking->city =  $racerTask->city;
         $ranking->country =  $racerTask->country;
         $ranking->status =  $racerTask->status;
         $ranking->image =  $racerTask->image;
         return $ranking;
      }
   
   }


?>
