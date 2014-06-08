<?php

   class CheckpointDbFunction extends AbstractDbFunction implements ListDbFunction {

      public function CheckpointDbFunction() {
         $this->AbstractDbFunction();
      }


      public function findAll( $raceId ) {
         
         $query = "select * from Checkpoint where raceFk = ? ";
         $result = $this->queryArray($query, array( new Parameter( PDO::PARAM_INT, $raceId ) ) );
         return $result;
      }
         
      public function findById( $checkpointId ) {
         
         $query = "select * from Checkpoint where checkpointId = ?";
         $result = $this->queryArray($query, array( new Parameter( PDO::PARAM_INT, $checkpointId ) ) );
         return $result[0];
      }

      public function insert( $checkpoint ) {
         $query = "insert into Checkpoint (name, manned, raceFk ) values (?, ?, ?)";
         $parameter = array( 
            new Parameter( PDO::PARAM_STR, $checkpoint['name'] ), 
            new Parameter( PDO::PARAM_STR, $checkpoint['manned'] ), 
            new Parameter( PDO::PARAM_STR, $checkpoint['raceFk'] ) 
         );
         $this->query($query, $parameter);
      }

      public function update( $checkpoint ) {
         $query = "update Checkpoint set name = ?, manned = ? where checkpointId = ?";
         $parameter = array( 
            new Parameter( PDO::PARAM_STR, $checkpoint['name'] ), 
            new Parameter( PDO::PARAM_STR, $checkpoint['manned'] ),
            new Parameter( PDO::PARAM_INT, $checkpoint['checkpointId'] )
         );
         $this->query($query, $parameter);
      }

   }

?>
