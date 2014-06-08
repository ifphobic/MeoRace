<?php

   class DeliveryConditionDbFunction extends AbstractDbFunction implements ListDbFunction {

      public function DeliveryConditionDbFunction() {
         $this->AbstractDbFunction();
      }


      public function findAll( $taskFk ) {
         $query = "select dc.* from DeliveryCondition dc ";
         $query .= "join Delivery current on dc.deliveryFk = current.deliveryId ";
         $query .= "where current.taskFk = ?";
         $result = $this->queryArray($query, array( new Parameter( PDO::PARAM_INT, $taskFk ) ) );
         return $result;
      }
        
      public function insert( $deliveryCondition ) {
//         print_r($deliveryCondition);
         $query = "insert into DeliveryCondition ( deliveryFk, previousDeliveryFk ) values (?, ?)";
         $parameter = array( 
            new Parameter( PDO::PARAM_INT, $deliveryCondition['deliveryFk'] ), 
            new Parameter( PDO::PARAM_INT, $deliveryCondition['previousDeliveryFk'] ), 
         );
         $this->query($query, $parameter);
      }

      public function update( $unused ) {
         throw new Exception("DeliveryDbFunction::update not implemented!");
      }

      public function findById( $unused ) {
         throw new Exception("DeliveryDbFunction::findById not implemented!");
      }

   }

?>
