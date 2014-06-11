<?php

   class DeliveryDbFunction extends AbstractDbFunction implements ListDbFunction {

      public function DeliveryDbFunction() {
         $this->AbstractDbFunction();
      }


      public function findAll( $taskFk ) {
         
         $query =  "select d.*, pickup.name as pickupName, dropoff.name as dropoffName, p.name as parcelName, -1 as name ";
         $query .= "from Delivery d ";
         $query .= "join Checkpoint pickup on d.pickupFk = pickup.checkpointId ";
         $query .= "join Checkpoint dropoff on d.dropoffFk = dropoff.checkpointId ";
         $query .= "left outer join Parcel p on d.parcelFk = p.parcelId ";
         $query .= "where taskFk = ? order by deliveryId";
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
         $query = "insert into Delivery ( taskFk, pickupFk, dropoffFk, parcelFk ) values (?, ?, ?, ?)";
         $parameter = array( 
            new Parameter( PDO::PARAM_INT, $delivery['taskFk'] ), 
            new Parameter( PDO::PARAM_INT, $delivery['pickupFk'] ), 
            new Parameter( PDO::PARAM_INT, $delivery['dropoffFk'] ), 
         );
         if ( $delivery['parcelFk'] != -1 ) {
            $parameter[]  = new Parameter( PDO::PARAM_INT, $delivery['parcelFk'] );
         } else {
            $parameter[]  = new Parameter( PDO::PARAM_NULL, null );
         }
         $this->query($query, $parameter);
      }

      public function update( $delivery) {
         $query = "update Delivery set pickupFk = ?, dropoffFk = ?, parcelFk = ? where deliveryId = ?";
         $parameter = array( 
            new Parameter( PDO::PARAM_INT, $delivery['pickupFk'] ), 
            new Parameter( PDO::PARAM_INT, $delivery['dropoffFk'] ), 
         );
         if ( $delivery['parcelFk'] != -1 ) {
            $parameter[] = new Parameter( PDO::PARAM_INT, $delivery['parcelFk'] );
         } else {
            $parameter[] = new Parameter( PDO::PARAM_NULL, null );
         }
         $parameter[] = new Parameter( PDO::PARAM_INT, $delivery['deliveryId'] );
         $this->query($query, $parameter);
      }

      public function delete( $deliveryId ) {
         $query = "delete from DeliveryCondition where deliveryFk = ? or previousDeliveryFk = ?";
         $parameter = array( 
            new Parameter( PDO::PARAM_INT, $deliveryId ), 
            new Parameter( PDO::PARAM_INT, $deliveryId ), 
         );
         $this->query($query, $parameter);
         
         $query = "delete from Delivery where deliveryId = ?";
         $parameter = array( 
            new Parameter( PDO::PARAM_INT, $deliveryId ), 
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

         $result = array();
         foreach ( $conditions as $condition ) {
            if ( $condition->deliveryFk == $currentDelivery->deliveryId ) {
              $name = $deliveries[$condition->previousDeliveryFk]->name;
              $result[] = new Condition( $name, $condition->deliveryConditionId );
            }
         }
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

   class Condition {
      public $name;
      public $deliveryConditionId;

      public function Condition( $name, $deliveryConditionId) {
         $this->name = $name;
         $this->deliveryConditionId = $deliveryConditionId;
      }

   }
?>
