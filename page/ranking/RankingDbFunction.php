<?php

   class RankingDbFunction extends AbstractDbFunction implements ListDbFunction {

      public function RankingDbFunction() {
         $this->AbstractDbFunction();
      }


      public function findAll( $raceId ) {
         
//         $query = "select * from Ranking where raceFk = ? ";
//         $result = $this->queryArray($query, array( new Parameter( PDO::PARAM_INT, $raceId ) ) );
//         return $result; 
      }
         
      public function findById( $rankingId ) {
         
//         $query = "select * from Ranking where rankingId = ?";
//         $result = $this->queryArray($query, array( new Parameter( PDO::PARAM_INT, $rankingId ) ) );
//         return $result[0]; 
      }

      public function insert( $ranking ) {
//         $query = "insert into Ranking (name, description, raceFk ) values (?, ?, ?)";
//         $parameter = array( 
//            new Parameter( PDO::PARAM_STR, $ranking['name'] ), 
//            new Parameter( PDO::PARAM_STR, $ranking['description'] ), 
//            new Parameter( PDO::PARAM_STR, $ranking['raceFk'] ) 
//         );
//         $this->query($query, $parameter);
      }

      public function update( $ranking ) {
//         $query = "update Ranking set name = ?, description = ? where rankingId = ?";
//         $parameter = array( 
//            new Parameter( PDO::PARAM_STR, $ranking['name'] ), 
//            new Parameter( PDO::PARAM_STR, $ranking['description'] ),
//            new Parameter( PDO::PARAM_INT, $ranking['rankingId'] )
//         );
//         $this->query($query, $parameter);
      }

   }

?>
