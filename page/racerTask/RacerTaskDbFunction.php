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
         
//         $query = "select * from RacerTask where racerTaskId = ?";
//         $result = $this->queryArray($query, array( new Parameter( PDO::PARAM_INT, $racerTaskId ) ) );
//         return $result[0]; 
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

   }

?>
