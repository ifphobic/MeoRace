<?php

   class TaskDbFunction extends AbstractDbFunction implements ListDbFunction {

      public function TaskDbFunction() {
         $this->AbstractDbFunction();
      }


      public function findAll( $raceFk ) {
         
         $query = "select * from Task where raceFk = ? order by taskId";
         $result = $this->queryArray($query, array(new Parameter( PDO::PARAM_INT, $raceFk ) ) );
         return $result; 
      }
         
      public function findById( $taskId ) {
         
         $query = "select * from Task where taskId = ?";
         $result = $this->queryArray($query, array( new Parameter( PDO::PARAM_INT, $taskId ) ) );
         return $result[0];
      }

      public function insert( $task ) {
         $query = "insert into Task (name, maxDuration, price, description, raceFk, dispatchCheckpointFk, fixPrice ) values (?, ?, ?, ?, ?, ?, ?)";
         $parameter = array( 
            new Parameter( PDO::PARAM_STR, $task['name'] ), 
            new Parameter( PDO::PARAM_INT, $task['maxDuration'] ), 
            new Parameter( PDO::PARAM_INT, $task['price'] ), 
            new Parameter( PDO::PARAM_STR, $task['description'] ), 
            new Parameter( PDO::PARAM_INT, $task['raceFk'] ), 
            new Parameter( PDO::PARAM_INT, $task['dispatchCheckpointFk'] ), 
            new Parameter( PDO::PARAM_STR, $task['fixPrice'] ), 
         );
         $this->query($query, $parameter);
      }

      public function delete( $taskId ) {
         $dbFunction = new DeliveryDbFunction();
         $deliveries = $dbFunction->findAll( $taskId );
         foreach ( $deliveries as $delivery ) {
            $dbFunction->delete( $delivery->deliveryId);
         }
         $dbFunction->close();
         $query = "delete from Task where taskId = ?";
         $parameter = array( 
            new Parameter( PDO::PARAM_INT, $taskId ), 
         );
         $this->query($query, $parameter);
      }

      public function update( $task) {
         $query = "update Task set name = ?, maxDuration = ?, price = ?, description = ?, dispatchCheckpointFk = ?, fixPrice = ?  where taskId = ?";
         $parameter = array( 
            new Parameter( PDO::PARAM_STR, $task['name'] ), 
            new Parameter( PDO::PARAM_INT, $task['maxDuration'] ), 
            new Parameter( PDO::PARAM_INT, $task['price'] ), 
            new Parameter( PDO::PARAM_STR, $task['description'] ), 
            new Parameter( PDO::PARAM_INT, $task['dispatchCheckpointFk'] ), 
            new Parameter( PDO::PARAM_STR, $task['fixPrice'] ), 
            new Parameter( PDO::PARAM_INT, $task['taskId'] ),
         );
         $this->query($query, $parameter);
      }

   }

?>
