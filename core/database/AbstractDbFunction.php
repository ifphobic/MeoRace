<?php

   abstract class AbstractDbFunction {

      private $mysqli;

      protected function AbstractDbFunction() {

         $this->mysqli = new mysqli("localhost", "meoRace", "meoRace", "meoRace");
         if ( $this->mysqli->connect_errno ) {
             throw new Exception( "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error );
         }
      }

      protected function query( $query, $parameters ) {
         
         $statement = $this->mysqli->prepare( $query );
         if ( !$statement ) {
            throw new Exception( "Prepare failed: (" . $this->mysqli->errno . ") " . $this->mysqli->error );
         }
         
         if ( isset( $parameters ) ) {
            $references = array();
            $references[] = "";

            foreach ( $parameters as $key => $value ) {
               $references[0] = $references[0] . $value->type;
               $references[] = &$value->value;
            }
            
            call_user_func_array(array($statement, 'bind_param'), $references );
         }
         $result = $statement->execute();

         if ( $result ) {
            return $statement->get_result();   
         } else {
            throw new Exception( "Execute failed: (" . $statement->errno . ") " . $statement->error );
         }

      }


      public function close() {
         $this->mysqli->close();
      }

   }

   class Parameter {
      
      const STRING = "s";
      const INTEGER = "i";

      public $type;
      public $value;

      public function Parameter( $type, $value ) {
         $this->type = $type;
         $this->value = $value;
      }



   }

?>
