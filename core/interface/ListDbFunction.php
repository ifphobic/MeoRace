<?php

   interface ListDbFunction {

      public function findAll( $raceId );

      public function findById( $id );

      public function insert( $array );
      
      public function update( $array );

   }

?>
