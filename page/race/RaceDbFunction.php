<?php

   class RaceDbFunction extends AbstractDbFunction implements ListDbFunction {

      public function RaceDbFunction() {
         $this->AbstractDbFunction();
      }


      public function findAll( $unused ) {
         
         $query = "select * from Race ";
         $result = $this->query($query, null );
         
         $races = array();
         for ( $i = 0; $i < $result->num_rows; $i++ ) {
            $races[] = $result->fetch_object();
         }
         return $races;
      }
         
      public function findById( $raceId ) {
         
         $query = "select * from Race where raceId = ?";
         $result = $this->query($query, array( new Parameter( Parameter::INTEGER, $raceId ) ) );
         if ( $result->num_rows != 0 ) {
            return $result->fetch_object();
         } else {
            return null;
         }
      }

      public function insert( $race ) {
         $query = "insert into Race (name, status ) values (?, ?)";
         $parameter = array( 
            new Parameter( Parameter::STRING, $race['name'] ), 
            new Parameter( Parameter::STRING, $race['status'] ), 
         );
         $this->query($query, $parameter);
      }

      public function update( $race) {
         $query = "update Race set name = ?, status = ? where raceId = ?";
         $parameter = array( 
            new Parameter( Parameter::STRING, $race['name'] ), 
            new Parameter( Parameter::STRING, $race['status'] ),
            new Parameter( Parameter::INTEGER, $race['raceId'] ),
         );
         $this->query($query, $parameter);
      }

   }

?>
