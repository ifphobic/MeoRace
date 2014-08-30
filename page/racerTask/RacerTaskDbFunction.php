<?php

   class RacerTaskDbFunction extends AbstractDbFunction {

      public function RacerTaskDbFunction() {
         $this->AbstractDbFunction();
      }


      public function findAll( $raceId ) {
         
//         $query = "select * from RacerTask where raceFk = ? ";
//         $result = $this->queryArray($query, array( new Parameter( PDO::PARAM_INT, $raceId ) ) );
//         return $result; 
      }
      
      public function findRacerTaskById($racerTaskId) {
         $query  = "select rt.racerTaskId, TIME_TO_SEC(TIMEDIFF( rt.endTime, rt.startTime ) ) as taskTime, ";
         $query .= "TIME_TO_SEC(TIMEDIFF( now(), rt.startTime ) ) as currentTime, ";
         $query .= "rt.price, t.maxDuration, t.raceFk, ";
         $query .= "t.name as taskName, t.description as taskDescription ";
         $query .= "from RacerTask rt ";
         $query .= "left outer join Task t on rt.taskFk = t.taskId  ";
         $query .= "where racerTaskId = ? ";
         $result = $this->queryArray($query, array( new Parameter( PDO::PARAM_INT, $racerTaskId ) ) );
         return $result[0]; 
      }

      public function findRacerDeliveryById( $racerDeliveryId ) {
         
         $query  = "select rd.racerDeliveryId, rd.racerTaskFk, p.name as parcel, p.description as description, p.image from RacerDelivery rd ";
         $query .= "join Delivery d on rd.deliveryFk = d.deliveryId ";
         $query .= "join Parcel p on d.parcelFk = p.parcelId ";
         $query .= "where racerDeliveryId = ?";
         $result = $this->queryArray($query, array( new Parameter( PDO::PARAM_INT, $racerDeliveryId ) ) );
         return $result[0]; 
      }

      public function doAction( $racerDeliveryId, $dropoff, $manned ) {
         $query = "update RacerDelivery set ";
         if ( !$dropoff || !$manned ) {
            $query .= "pickupTime = now() ";
         }
         if ( !$manned ) {
            $query .= " , ";
         }

         if ( $dropoff ) {
            $query .= "dropoffTime = now() ";
         }  
         $query .= "where racerDeliveryId = ?";
         $this->query($query, array( new Parameter( PDO::PARAM_INT, $racerDeliveryId ) ) );
      }

      public function startRacerTask( $racerTaskId ) {
         $query = "update RacerTask set startTime = now() where racerTaskId = ?";
         $this->query($query, array( new Parameter( PDO::PARAM_INT, $racerTaskId ) ) );
      }


      public function stopRacerTask( $racerTaskId ) {
         $query  = "select count(1) from RacerDelivery ";
         $query .= "where dropoffTime is null and racerTaskFk = ? ";
         $result = $this->queryColumn($query, array( new Parameter( PDO::PARAM_INT, $racerTaskId ) ) );
         if ( $result[0] == 0 ) {
            $query = "update RacerTask set endTime = now() where racerTaskId = ?";
            $this->query($query, array( new Parameter( PDO::PARAM_INT, $racerTaskId ) ) );
         }
      }

      public function determineActions( $racerId, $checkpointId ) {
         
         $query  = "select rd.racerDeliveryId, pickupC.name as pickup, dropoffC.name as dropoff, p.name as parcel, p.image, ";
         $query .= "      (rd.pickupTime is not null or !pickupC.manned ) as isDropoff, pickupC.manned, t.name as task ";
         $query .= "   from RacerDelivery rd ";
         $query .= "   join RacerTask rt on rd.racerTaskFk = rt.racerTaskId ";
         $query .= "   join Task t on rt.taskFK = t.taskId ";
         $query .= "   join Delivery d on rd.deliveryFk = d.deliveryId ";
         $query .= "   join Checkpoint pickupC on d.pickupFk = pickupC.checkpointId ";
         $query .= "   join Checkpoint dropoffC on d.dropoffFk = dropoffC.checkpointId ";
         $query .= "   join Parcel p on d.parcelFk = p.parcelId ";
         $query .= "   where rt.racerFk = ? ";
         $query .= "    and not exists ( ";
         $query .= "       select * from DeliveryCondition dc ";
         $query .= "          join RacerDelivery previousRd on dc.previousDeliveryFk = previousRd.deliveryFk ";
         $query .= "          where dc.deliveryFk = d.deliveryId and previousRd.racerTaskFk = rt.racerTaskId and previousRd.dropoffTime is null ) ";
         $query .= "    and ( ( rd.pickupTime is null and d.pickupFk = ? ) ";
         $query .= "      or ( (rd.pickupTime is not null or not pickupC.manned ) and rd.dropoffTime is null and d.dropoffFk = ? ) ) ";
         $query .= "   order by isDropoff desc ";
         error_log($query);
         $parameter = array(
            new Parameter( PDO::PARAM_INT, $racerId ),
            new Parameter( PDO::PARAM_INT, $checkpointId ),
            new Parameter( PDO::PARAM_INT, $checkpointId ),
         );
         $result = $this->queryArray($query, $parameter);
         return $result;
      }

      public function dispatch( $racerId, $taskId, $price ) {
         $query = "insert into RacerTask ( racerFk, taskFk, price ) values ( ?, ?, ? )";
         $parameter = array( 
            new Parameter( PDO::PARAM_INT, $racerId ), 
            new Parameter( PDO::PARAM_INT, $taskId ),
            new Parameter( PDO::PARAM_INT, $price )
         );
         $this->query($query, $parameter);

         $racerTaskId = $this->getLastId();

         $query = "insert into RacerDelivery ( deliveryFk, racerTaskFk) select deliveryId, ? from Delivery where taskFk = ?";
         $parameter = array( 
            new Parameter( PDO::PARAM_INT, $racerTaskId ), 
            new Parameter( PDO::PARAM_INT, $taskId ),
         );
         $this->query($query, $parameter);
         return $racerTaskId;
      }
   }

?>
