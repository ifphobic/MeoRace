<?php
   
   abstract class AbstractDbFunction {

      private $connection;

      protected function AbstractDbFunction() {
         
         $this->connection = new PDO("mysql:host=" . Configuration::DB_HOST . ";dbname=" . Configuration::DB_NAME, Configuration::DB_USER, Configuration::DB_PASSWORD);
         $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }

      protected function queryArray( $query, $parameters ) {

         $statement = $this->query( $query, $parameters );
         return $statement->fetchAll( PDO::FETCH_OBJ );   
      
      }
      
      protected function queryColumn( $query, $parameters ) {

         $statement = $this->query( $query, $parameters );
         return $statement->fetchAll( PDO::FETCH_COLUMN );   
      
      }


      protected function query( $query, $parameters ) {
        
         //print($query);
         
         $statement = $this->connection->prepare( $query );

         if ( !$statement ) {
            throw new Exception( "Prepare failed: (" . $this->mysqli->errno . ") " . $this->mysqli->error );
         }
         
         $index = 1;
         foreach ( $parameters as $parameter ) {
            $statement->bindParam( $index++, $parameter->value, $parameter->type );
         }
         $result = $statement->execute();

         if ( $result ) {
            return $statement;
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
