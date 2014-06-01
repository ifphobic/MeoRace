<?php

   class RacerDbFunction extends AbstractDbFunction implements ListDbFunction {

      public function RacerDbFunction() {
         $this->AbstractDbFunction();
      }


      public function findAll( $raceFk ) {
         
         $query = "select * from Racer where raceFk = ? order by racerNumber";
         $result = $this->query($query, array( new Parameter( Parameter::INTEGER, $raceFk ) ) );
         
         $racers = array();
         for ( $i = 0; $i < $result->num_rows; $i++ ) {
            $racers[] = $result->fetch_object();
         }
         return $racers;
      }
         
      public function findById( $racerId ) {
         
         $query = "select * from Racer where racerId = ?";
         $result = $this->query($query, array( new Parameter( Parameter::INTEGER, $racerId ) ) );
         if ( $result->num_rows != 0 ) {
            return $result->fetch_object();
         } else {
            return null;
         }
      }

      public function insert( $racer ) {
         $query = "insert into Racer (racerNumber, name, city, country, email, raceFk, status) values (?, ?, ?, ?, ?, ?, ?)";
         $parameter = array( 
            new Parameter( Parameter::INTEGER, $racer['racerNumber'] ), 
            new Parameter( Parameter::STRING, $racer['name'] ), 
            new Parameter( Parameter::STRING, $racer['city'] ), 
            new Parameter( Parameter::STRING, $racer['country'] ), 
            new Parameter( Parameter::STRING, $racer['email'] ), 
            new Parameter( Parameter::INTEGER, $racer['raceFk'] ), 
            new Parameter( Parameter::STRING, $racer['status'] ), 
         );
         $this->query($query, $parameter);
      }

      public function update( $racer) {
         $query = "update Racer set racerNumber = ?, name = ?, city = ?, country = ?, email = ?, status = ? where racerId = ?";
         $parameter = array( 
            new Parameter( Parameter::INTEGER, $racer['racerNumber'] ), 
            new Parameter( Parameter::STRING, $racer['name'] ), 
            new Parameter( Parameter::STRING, $racer['city'] ), 
            new Parameter( Parameter::STRING, $racer['country'] ), 
            new Parameter( Parameter::STRING, $racer['email'] ), 
            new Parameter( Parameter::STRING, $racer['status'] ), 
            new Parameter( Parameter::STRING, $racer['racerId'] ), 
         );
         $this->query($query, $parameter);
      }

      public function getFreeRaceNumbers( $raceFk, $racer ) {
         $userNumber = -1;
         if ( isset( $racer ) ) {
            $userNumber = $racer->racerNumber;
         }

         $dbNumbers = array();
         $query = "select racerNumber from Racer where raceFk = ?";
         $result = $this->query($query, array( new Parameter( Parameter::INTEGER, $raceFk ) ) );
         for ( $i = 0; $i < $result->num_rows; $i++ ) {
            $dbNumbers[] = $result->fetch_row()[0];
         }

         $freeNumbers = array();
         for ( $i = 0; $i < 100; $i++ ) {
            if ( !in_array( $i, $dbNumbers ) || $i == $userNumber ) {
               $freeNumbers[] = $i;
            }
         }
         return $freeNumbers;
      }

   }

?>
