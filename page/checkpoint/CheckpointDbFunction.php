<?php

   class CheckpointDbFunction extends AbstractDbFunction implements ListDbFunction {

      public function CheckpointDbFunction() {
         $this->AbstractDbFunction();
      }


      public function findAll( $raceId ) {
         
         $query = "select * from Checkpoint where raceFk = ? ";
         $result = $this->query($query, array( new Parameter( Parameter::INTEGER, $raceId ) ) );
         
         $checkpoint = array();
         for ( $i = 0; $i < $result->num_rows; $i++ ) {
            $checkpoint[] = $result->fetch_object();
         }
         return $checkpoint;
      }
         
      public function findById( $checkpointId ) {
         
         $query = "select * from Checkpoint where checkpointId = ?";
         $result = $this->query($query, array( new Parameter( Parameter::INTEGER, $checkpointId ) ) );
         if ( $result->num_rows != 0 ) {
            return $result->fetch_object();
         } else {
            return null;
         }
      }

      public function insert( $checkpoint ) {
         $query = "insert into Checkpoint (name, manned, raceFk ) values (?, ?, ?)";
         $parameter = array( 
            new Parameter( Parameter::STRING, $checkpoint['name'] ), 
            new Parameter( Parameter::STRING, $checkpoint['manned'] ), 
            new Parameter( Parameter::STRING, $checkpoint['raceFk'] ) 
         );
         $this->query($query, $parameter);
      }

      public function update( $checkpoint ) {
         $query = "update Checkpoint set name = ?, manned = ? where checkpointId = ?";
         $parameter = array( 
            new Parameter( Parameter::STRING, $checkpoint['name'] ), 
            new Parameter( Parameter::STRING, $checkpoint['manned'] ),
            new Parameter( Parameter::INTEGER, $checkpoint['checkpointId'] )
         );
         $this->query($query, $parameter);
      }

   }

?>
