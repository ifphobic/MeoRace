<?php

   class RacerDbFunction extends AbstractDbFunction implements ListDbFunction {

      public function RacerDbFunction() {
         $this->AbstractDbFunction();
      }


      public function findAll( $raceFk ) {
         
         $query = "select * from Racer where raceFk = ? order by racerNumber";
         $result = $this->queryArray($query, array( new Parameter( PDO::PARAM_INT, $raceFk ) ) );
         return $result; 
      }
         
      public function findById( $racerId ) {
         
         $query = "select * from Racer where racerId = ?";
         $result = $this->queryArray($query, array( new Parameter( PDO::PARAM_INT, $racerId ) ) );
         return $result[0];
      }

      public function insert( $racer ) {
         $query = "insert into Racer (racerNumber, name, city, country, email, raceFk, status) values (?, ?, ?, ?, ?, ?, ?)";
         $parameter = array( 
            new Parameter( PDO::PARAM_INT, $racer['racerNumber'] ), 
            new Parameter( PDO::PARAM_STR, $racer['name'] ), 
            new Parameter( PDO::PARAM_STR, $racer['city'] ), 
            new Parameter( PDO::PARAM_STR, $racer['country'] ), 
            new Parameter( PDO::PARAM_STR, $racer['email'] ), 
            new Parameter( PDO::PARAM_INT, $racer['raceFk'] ), 
            new Parameter( PDO::PARAM_STR, $racer['status'] ), 
         );
         $this->query($query, $parameter);
      }

      public function update( $racer) {
         $parameter = array( 
            new Parameter( PDO::PARAM_INT, $racer['racerNumber'] ), 
            new Parameter( PDO::PARAM_STR, $racer['name'] ), 
            new Parameter( PDO::PARAM_STR, $racer['city'] ), 
            new Parameter( PDO::PARAM_STR, $racer['country'] ), 
            new Parameter( PDO::PARAM_STR, $racer['email'] ), 
            new Parameter( PDO::PARAM_STR, $racer['status'] ), 
         );
         $image = "";
         if ( isset( $racer['image'] ) ) {
            $image = " , image = ? ";
            $parameter[] = new Parameter( PDO::PARAM_STR, $racer['image'] );
         }
         $parameter[] = new Parameter( PDO::PARAM_STR, $racer['racerId'] );
         $query = "update Racer set racerNumber = ?, name = ?, city = ?, country = ?, email = ?, status = ? $image where racerId = ?";
         $this->query($query, $parameter);
      }

      public function getFreeRaceNumbers( $raceFk, $racer ) {
         $userNumber = -1;
         if ( isset( $racer ) ) {
            $userNumber = $racer->racerNumber;
         }

         $dbNumbers = array();
         $query = "select racerNumber from Racer where raceFk = ?";
         $dbNumbers = $this->queryColumn($query, array( new Parameter( PDO::PARAM_INT, $raceFk ) ) );

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
