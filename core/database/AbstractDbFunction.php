<?php
   
   abstract class AbstractDbFunction {

      private $connection;

      protected function AbstractDbFunction() {
         
         $this->connection = new PDO("mysql:host=" . Configuration::DB_HOST . ";dbname=" . Configuration::DB_NAME, Configuration::DB_USER, Configuration::DB_PASSWORD);
         $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }

      protected function query( $query, $parameters ) {
         
         
         $statement = $this->connection->prepare( $query );

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
         $this->connection = null;
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
