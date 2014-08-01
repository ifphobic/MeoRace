<?php

   class RacerTaskDbFunction extends AbstractDbFunction implements ListDbFunction {

      public function RacerTaskDbFunction() {
         $this->AbstractDbFunction();
      }


      public function findAll( $raceId ) {
         
//         $query = "select * from RacerTask where raceFk = ? ";
//         $result = $this->queryArray($query, array( new Parameter( PDO::PARAM_INT, $raceId ) ) );
//         return $result; 
      }
         
      public function findById( $racerTaskId ) {
         
         $query = "select * from RacerTask where racerTaskId = ?";
         $result = $this->queryArray($query, array( new Parameter( PDO::PARAM_INT, $racerTaskId ) ) );
         return $result[0]; 
      }

      public function insert( $racerTask ) {
//         $query = "insert into RacerTask (name, description, raceFk ) values (?, ?, ?)";
//         $parameter = array( 
//            new Parameter( PDO::PARAM_STR, $racerTask['name'] ), 
//            new Parameter( PDO::PARAM_STR, $racerTask['description'] ), 
//            new Parameter( PDO::PARAM_STR, $racerTask['raceFk'] ) 
//         );
//         $this->query($query, $parameter);
      }

      public function update( $racerTask ) {
//         $query = "update RacerTask set name = ?, description = ? where racerTaskId = ?";
//         $parameter = array( 
//            new Parameter( PDO::PARAM_STR, $racerTask['name'] ), 
//            new Parameter( PDO::PARAM_STR, $racerTask['description'] ),
//            new Parameter( PDO::PARAM_INT, $racerTask['racerTaskId'] )
//         );
//         $this->query($query, $parameter);
      }

      public function determineActions( $racerId, $checkpointId ) {
         
         $query  = "select rd.racerDeliveryId, pickupC.name as pickup, dropoffC.name as dropoff, p.name as parcel, ";
         $query .= "      (rd.pickupTime is not null or pickupC.manned ) as isDropoff, pickupC.manned ";
         $query .= "   from RacerDelivery rd ";
         $query .= "   join RacerTask rt on rd.racerTaskFk = rt.racerTaskId ";
         $query .= "   join Delivery d on rd.deliveryFk = d.deliveryId ";
         $query .= "   join Checkpoint pickupC on d.pickupFk = pickupC.checkpointId ";
         $query .= "   join Checkpoint dropoffC on d.dropoffFk = dropoffC.checkpointId ";
         $query .= "   join Parcel p on d.parcelFk = p.parcelId ";
         $query .= "   where rt.racerFk = ? and ( ( rd.pickupTime is null and d.pickupFk = ? ) ";
         $query .= "      or ( (rd.pickupTime is not null or not pickupC.manned ) and rd.dropoffTime is null and d.dropoffFk = ? ) ) ";
         $query .= "   order by isDropoff ";

         $parameter = array(
            new Parameter( PDO::PARAM_INT, $racerId ),
            new Parameter( PDO::PARAM_INT, $checkpointId ),
            new Parameter( PDO::PARAM_INT, $checkpointId ),
         );
         return $this->queryArray($query, $parameter);
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
      }
   }

?>
