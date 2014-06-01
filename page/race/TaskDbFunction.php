<?php

   class TaskDbFunction extends AbstractDbFunction implements ListDbFunction {

      public function TaskDbFunction() {
         $this->AbstractDbFunction();
      }


      public function findAll( $unused ) {
         
         $query = "select * from Task ";
         $result = $this->query($query, null );
         
         $tasks = array();
         for ( $i = 0; $i < $result->num_rows; $i++ ) {
            $tasks[] = $result->fetch_object();
         }
         return $tasks;
      }
         
      public function findById( $taskId ) {
         
         $query = "select * from Task where taskId = ?";
         $result = $this->query($query, array( new Parameter( Parameter::INTEGER, $taskId ) ) );
         if ( $result->num_rows != 0 ) {
            return $result->fetch_object();
         } else {
            return null;
         }
      }

      public function insert( $task ) {
         $query = "insert into Task (name, maxDuration, currentPrice, description, raceFk ) values (?, ?, ?, ?, ?)";
         $parameter = array( 
            new Parameter( Parameter::STRING, $task['name'] ), 
            new Parameter( Parameter::INTEGER, $task['maxDuration'] ), 
            new Parameter( Parameter::INTEGER, $task['currentPrice'] ), 
            new Parameter( Parameter::STRING, $task['description'] ), 
            new Parameter( Parameter::INTEGER, $task['raceFk'] ), 
         );
         $this->query($query, $parameter);
      }

      public function update( $task) {
         $query = "update Task set name = ?, maxDuration = ?, currentPrice = ?, description = ? where taskId = ?";
         $parameter = array( 
            new Parameter( Parameter::STRING, $task['name'] ), 
            new Parameter( Parameter::INTEGER, $task['maxDuration'] ), 
            new Parameter( Parameter::INTEGER, $task['currentPrice'] ), 
            new Parameter( Parameter::STRING, $task['description'] ), 
            new Parameter( Parameter::INTEGER, $task['taskId'] ),
         );
         $this->query($query, $parameter);
      }

   }

?>
