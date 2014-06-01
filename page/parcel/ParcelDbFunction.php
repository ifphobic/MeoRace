<?php

   class ParcelDbFunction extends AbstractDbFunction implements ListDbFunction {

      public function ParcelDbFunction() {
         $this->AbstractDbFunction();
      }


      public function findAll( $raceId ) {
         
         $query = "select * from Parcel where raceFk = ? ";
         $result = $this->query($query, array( new Parameter( Parameter::INTEGER, $raceId ) ) );
         
         $parcels = array();
         for ( $i = 0; $i < $result->num_rows; $i++ ) {
            $parcels[] = $result->fetch_object();
         }
         return $parcels;
      }
         
      public function findById( $parcelId ) {
         
         $query = "select * from Parcel where parcelId = ?";
         $result = $this->query($query, array( new Parameter( Parameter::INTEGER, $parcelId ) ) );
         if ( $result->num_rows != 0 ) {
            return $result->fetch_object();
         } else {
            return null;
         }
      }

      public function insert( $parcel ) {
         $query = "insert into Parcel (name, description, raceFk ) values (?, ?, ?)";
         $parameter = array( 
            new Parameter( Parameter::STRING, $parcel['name'] ), 
            new Parameter( Parameter::STRING, $parcel['description'] ), 
            new Parameter( Parameter::STRING, $parcel['raceFk'] ) 
         );
         $this->query($query, $parameter);
      }

      public function update( $parcel ) {
         $query = "update Parcel set name = ?, description = ? where parcelId = ?";
         $parameter = array( 
            new Parameter( Parameter::STRING, $parcel['name'] ), 
            new Parameter( Parameter::STRING, $parcel['description'] ),
            new Parameter( Parameter::INTEGER, $parcel['parcelId'] )
         );
         $this->query($query, $parameter);
      }

   }

?>
