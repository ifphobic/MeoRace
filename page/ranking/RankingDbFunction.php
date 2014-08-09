<?php

   class RankingDbFunction extends AbstractDbFunction {

      public function RankingDbFunction() {
         $this->AbstractDbFunction();
      }


      public function findAll( $raceId ) {

         $query  = "select TIME_TO_SEC(TIMEDIFF( rt.endTime, rt. startTime ) ) as taskTime, rt.price, t.maxDuration, r.racerId, r.racerNumber, r.name, r.city, r.country, r.status, r.image ";
         $query .= "from  Racer r ";
         $query .= "left outer join  RacerTask rt on rt.racerFk = r.racerId ";
         $query .= "left outer join Task t on rt.taskFk = t.taskId  ";
         $query .= "where r.raceFk = ? and ( rt.racerTaskId is null or rt.endTime is not null ) ";
         $query .= "order by r.racerId ";

         $result = $this->queryArray($query, array( new Parameter( PDO::PARAM_INT, $raceId ) ) );
         return $result; 
      }
         
      public function findById( $rankingId ) {
         
//         $query = "select * from Ranking where rankingId = ?";
//         $result = $this->queryArray($query, array( new Parameter( PDO::PARAM_INT, $rankingId ) ) );
//         return $result[0]; 
      }

   }

?>
