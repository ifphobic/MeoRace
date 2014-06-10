<?php

   class DeliveryDbFunction extends AbstractDbFunction implements ListDbFunction {

      public function DeliveryDbFunction() {
         $this->AbstractDbFunction();
      }


      public function findAll( $taskFk ) {
         
         $query =  "select d.*, concat( pickup.name, ' => ', dropoff.name, ' (', p.name, ')') as name, pickup.name as pickupName, dropoff.name as dropoffName, p.name as parcelName ";
         $query .= "from Delivery d ";
         $query .= "join Checkpoint pickup on d.pickupFk = pickup.checkpointId ";
         $query .= "join Checkpoint dropoff on d.dropoffFk = dropoff.checkpointId ";
         $query .= "join Parcel p on d.parcelFk = p.parcelId ";
         $query .= "where taskFk = ?";
         $result = $this->queryArray($query, array( new Parameter( PDO::PARAM_INT, $taskFk ) ) );
         $deliveries = array();
         foreach ($result as $delivery ) {
            $deliveries[$delivery->deliveryId] = $delivery;
         }

         return $deliveries; 
      }
         
      public function findById( $deliveryId ) {
         
         $query = "select * from Delivery where deliveryId = ?";
         $result = $this->queryArray($query, array( new Parameter( PDO::PARAM_INT, $deliveryId ) ) );
         return $result[0];
      }

      public function insert( $delivery ) {
         $query = "insert into Delivery ( taskFk, parcelFk, pickupFk, dropoffFk ) values (?, ?, ?, ?)";
         $parameter = array( 
            new Parameter( PDO::PARAM_INT, $delivery['taskFk'] ), 
            new Parameter( PDO::PARAM_INT, $delivery['parcelFk'] ), 
            new Parameter( PDO::PARAM_INT, $delivery['pickupFk'] ), 
            new Parameter( PDO::PARAM_INT, $delivery['dropoffFk'] ), 
         );
         $this->query($query, $parameter);
      }

      public function update( $delivery) {
         $query = "update Delivery set parcelFk = ?, pickupFk = ?, dropoffFk = ? where deliveryId = ?";
         $parameter = array( 
            new Parameter( PDO::PARAM_INT, $delivery['parcelFk'] ), 
            new Parameter( PDO::PARAM_INT, $delivery['pickupFk'] ), 
            new Parameter( PDO::PARAM_INT, $delivery['dropoffFk'] ), 
            new Parameter( PDO::PARAM_INT, $delivery['deliveryId'] ),
         );
         $this->query($query, $parameter);
      }

      public static function filterCurrent( $deliveries, $current, $conditions ) {
         $existing = array();
         foreach ( $conditions as $condition ) {
            if ( $condition->deliveryFk == $current->deliveryId ) {
               $existing[] = $condition->previousDeliveryFk;
            }
         }
         


         $result = array();
         foreach ( $deliveries as $delivery ) {
            if ( $delivery->deliveryId != $current->deliveryId && !in_array( $delivery->deliveryId, $existing ) ) {
               $result[] = $delivery;
            }
         }
         return $result;
      }

      public static function getPrevious( $currentDelivery, $deliveries, $conditions ) {

         $result = "";
         foreach ( $conditions as $condition ) {
            if ( $condition->deliveryFk == $currentDelivery->deliveryId ) {
               $previous = "deleted";
               if ( array_key_exists( $condition->previousDeliveryFk, $deliveries ) ) {
                  $previous = DeliveryDbFunction::getDeliveryString( $deliveries[$condition->previousDeliveryFk] );
               }
              $result .= $previous . "<br>";
            }
         }
         return $result;
      }

      private static function getDeliveryString( $delivery ) {
         $result = $delivery->pickupName . " => " . $delivery->dropoffName . " (" . $delivery->parcelName . ")";
         return $result;
      }

      public static function getPossibleDeliveries( $deliveries, $conditions, $doneDeliveries ) {

         $doneIds = array();
         foreach ( $doneDeliveries as $done ) {
            $doneIds[] = $done->deliveryId;
         }

         $result = array();
         foreach ( $deliveries as $delivery ) {
            $allConditionsOk = true;
            foreach ( $conditions as $condition ) {
               if ( $delivery->deliveryId == $condition->deliveryFk ) {
                  $allConditionsOk = $allConditionsOk && in_array( $condition->previousDeliveryFk, $doneIds );
               }
         
            }
            
            if ( $allConditionsOk & !in_array( $delivery->deliveryId, $doneIds ) ) {
               $result[] = $delivery;


            }

         }
         return $result;
      }

      public static function getImpossibleDeliveries( $deliveries, $doneDeliveries ) {
         
         $doneIds = array();
         foreach ( $doneDeliveries as $done ) {
            $doneIds[] = $done->deliveryId;
         }

         $result = array();
         foreach ( $deliveries as $delivery ) {
            if ( !in_array( $delivery->deliveryId, $doneIds ) ) {
               $result[] = $delivery;
            }
         }
         return $result;
      }
   }

?>
