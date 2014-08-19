<?php

   class RankingCalculator {

      const DELAY_PENALTY = 0.5;
      const MAX_RELATIVE_DELAY = 0.3;

      public static function evaluate( $racerTasks, $raceFinished ) {

         $rankings = array();

         foreach ( $racerTasks as $racerTask ) {

            if ( !isset( $rankings[ $racerTask->racerId ] ) ) {
               $rankings[ $racerTask->racerId ] = RankingCalculator::createRanking( $racerTask );
            }

            $ranking = $rankings[ $racerTask->racerId ];
            $ranking->score += RankingCalculator::calculateScore( $racerTask, $raceFinished );

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


      public static function calculateScore( $racerTask, $raceFinished ) {
         $score = $racerTask->price;
         if ( $racerTask->taskTime != null ) {
            $score = RankingCalculator::calculateDelyedScore( $racerTask->taskTime, $racerTask );
         } else if ( $raceFinished ) {
            $score = $racerTask->price * -1;
         } else {
            $score = RankingCalculator::calculateDelyedScore( $racerTask->currentTime, $racerTask );
         }
         return $score;
      }

      private static function calculateDelyedScore( $time, $racerTask ) {
         if ( $time <= $racerTask->maxDuration ) {
            return $racerTask->price;
         }

         $delay = $time / $racerTask->maxDuration - 1;
         $timePenalty = $delay / RankingCalculator::MAX_RELATIVE_DELAY;
         $timePenalty = min($timePenalty, 1);
         
         $score = $racerTask->price * RankingCalculator::DELAY_PENALTY;
         $score = $score - ($score * $timePenalty);
         return round( $score );
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
