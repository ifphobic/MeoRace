<?php

   class ParcelDbFunction extends AbstractDbFunction implements ListDbFunction {

      public function ParcelDbFunction() {
         $this->AbstractDbFunction();
      }


      public function findAll( $raceId ) {
         
         $query = "select * from Parcel where raceFk = ? ";
         $result = $this->queryArray($query, array( new Parameter( PDO::PARAM_INT, $raceId ) ) );
         return $result; 
      }
         
      public function findById( $parcelId ) {
         
         $query = "select * from Parcel where parcelId = ?";
         $result = $this->queryArray($query, array( new Parameter( PDO::PARAM_INT, $parcelId ) ) );
         return $result[0]; 
      }

      public function insert( $parcel ) {
         $query = "insert into Parcel (name, description, raceFk ) values (?, ?, ?)";
         $parameter = array( 
            new Parameter( PDO::PARAM_STR, $parcel['name'] ), 
            new Parameter( PDO::PARAM_STR, $parcel['description'] ), 
            new Parameter( PDO::PARAM_STR, $parcel['raceFk'] ) 
         );
         $this->query($query, $parameter);
      }

      public function update( $parcel ) {
         $parameter = array( 
            new Parameter( PDO::PARAM_STR, $parcel['name'] ), 
            new Parameter( PDO::PARAM_STR, $parcel['description'] ),
         );
         
         $image = "";
         if ( isset( $parcel['image'] ) ) {
            $image = " , image = ? ";
            $parameter[] = new Parameter( PDO::PARAM_STR, $parcel['image'] );
         }
         $query = "update Parcel set name = ?, description = ? $image where parcelId = ?";
         $parameter[] = new Parameter( PDO::PARAM_INT, $parcel['parcelId'] );
         $this->query($query, $parameter);
      }

   }

?>
