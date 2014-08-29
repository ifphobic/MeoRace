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
         
      public function findById( $racerTaskId ) {
         $query  = "select DATE_FORMAT(rd.pickupTime, '%H:%i:%s') as pickupTime, DATE_FORMAT(rd.dropoffTime, '%H:%i:%s') as dropoffTime, ";
         $query .= "TIME_TO_SEC(TIMEDIFF( rt.endTime, rt.startTime)) as taskTime, TIME_TO_SEC(TIMEDIFF( now(), rt.startTime)) as currentTime, rt.price, ";
         $query .= "t.maxDuration, t.raceFk, t.name as taskName, t.description as taskDescription, ";
         $query .= "d.deliveryId, ";
         $query .= "(select group_concat(previousDeliveryFk) from DeliveryCondition dc where dc.deliveryFk = d.deliveryId ) as conditions, ";
         $query .= "pickupC.name as pickupName, dropoffC.name as dropoffName, ";
         $query .= "p.name as parcelName, p.image ";
         $query .= "from RacerDelivery rd ";
         $query .= "join RacerTask rt on rd.racerTaskFk = rt.racerTaskId ";
         $query .= "join Task t on rt.taskFk = t.taskId ";
         $query .= "join Delivery d on rd.DeliveryFk = d.deliveryId ";
         $query .= "join Checkpoint pickupC on d.pickupFk = pickupC.checkpointId ";
         $query .= "join Checkpoint dropoffC on d.dropoffFk = dropoffC.checkpointId ";
         $query .= "join Parcel p on d.parcelFk = p.parcelId ";
         $query .= "where rd.racerTaskFk = ? ";
         $query .= "order by isnull(pickupTime), pickupTime, isnull(dropOffTime), dropOffTime, d.deliveryId ";
         $result = $this->queryArray($query, array( new Parameter( PDO::PARAM_INT, $racerTaskId ) ) );
         return $result;
      }

   }

?>
