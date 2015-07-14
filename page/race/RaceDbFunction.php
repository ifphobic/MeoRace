<?php

   class RaceDbFunction extends AbstractDbFunction implements ListDbFunction {

      public function RaceDbFunction() {
         $this->AbstractDbFunction();
      }


      public function findAll( $unused ) {
         
         $query = "select * from Race order by raceId";
         $result = $this->queryArray($query, array() );
         return $result; 
      }
         
      public function findById( $raceId ) {
         $query = "select * from Race where raceId = ?";
         $result = $this->queryArray($query, array( new Parameter( PDO::PARAM_INT, $raceId ) ) );
         return $result[0]; 
      }

      public function insert( $race ) {
         $query = "insert into Race (name, status ) values (?, ?)";
         $parameter = array( 
            new Parameter( PDO::PARAM_STR, $race['name'] ), 
            new Parameter( PDO::PARAM_STR, $race['status'] ), 
         );
         $this->query($query, $parameter);
      }

      public function update( $race) {
         $query = "update Race set name = ?, status = ? where raceId = ?";
         $parameter = array( 
            new Parameter( PDO::PARAM_STR, $race['name'] ), 
            new Parameter( PDO::PARAM_STR, $race['status'] ),
            new Parameter( PDO::PARAM_INT, $race['raceId'] ),
         );
         $this->query($query, $parameter);
      }

      public static function isPrepare( $raceId ) {
         $dbFunction = new RaceDbFunction();
         $race = $dbFunction->findById( $raceId );
         $dbFunction->close();
         return $race->status == "prepare";
      }

      public static function isFinished( $raceId ) {
         $dbFunction = new RaceDbFunction();
         $race = $dbFunction->findById( $raceId );
         $dbFunction->close();
         return $race->status == "finished";
      }

      public static function printFinished( $raceId )  {
         if ( RaceDbFunction::isFinished( $raceId ) ) {
            print("<h2 style='color: #ff0000;'>Race finished, no more actions possible!</h2>");
            return true;
         }
         return false;
      }
   }
   

?>
