<?php

   class RankingDbFunction extends AbstractDbFunction {

      public function RankingDbFunction() {
         $this->AbstractDbFunction();
      }


      public function findAll( $raceId, $racerId = null ) {

         $query  = "select rt.racerTaskId, TIME_TO_SEC(TIMEDIFF( rt.endTime, rt.startTime ) ) as taskTime, ";
         $query .= "TIME_TO_SEC(TIMEDIFF( now(), rt.startTime ) ) as currentTime, ";
         $query .= "rt.price, t.maxDuration, r.racerId, r.racerNumber, r.name, r.city, r.country, r.status, r.image, t.raceFk, ";
         $query .= "t.name as taskName, t.description as taskDescription ";
         $query .= "from  Racer r ";
         $query .= "left outer join  RacerTask rt on rt.racerFk = r.racerId ";
         $query .= "left outer join Task t on rt.taskFk = t.taskId  ";
         $query .= "where ";
         if ( $racerId == null ) {
            $query .= "r.raceFk ";
            $parameter = array( new Parameter( PDO::PARAM_INT, $raceId ) );
         } else {
            $query .= "r.racerId ";
            $parameter = array( new Parameter( PDO::PARAM_INT, $racerId ) );
         }
         $query .= "= ? ";
         $query .= "order by r.racerId, taskTime, currentTime";

         $result = $this->queryArray($query, $parameter );
         return $result; 
      }
         
      public function findById( $rankingId ) {
         
//         $query = "select * from Ranking where rankingId = ?";
//         $result = $this->queryArray($query, array( new Parameter( PDO::PARAM_INT, $rankingId ) ) );
//         return $result[0]; 
      }

   }

?>
