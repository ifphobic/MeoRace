<?php

   class StockExchangeDispatchDbFunction extends AbstractDbFunction {

      public function StockExchangeDispatchDbFunction() {
         $this->AbstractDbFunction();
      }


      public function findAll( $raceId ) {
         
         $query = "select sed.*, t.name, t.description, t.maxDuration from StockExchangeDispatch sed join Task t on sed.taskFk = t.taskId where sed.raceFk = ? ";
         $result = $this->queryArray($query, array( new Parameter( PDO::PARAM_INT, $raceId ) ) );
         return $result; 
      }
         
      public function findById( $taskId ) {
         
         $query = "select * from StockExchangeDispatch where taskId = ?";
         $result = $this->queryArray($query, array( new Parameter( PDO::PARAM_INT, $taskId ) ) );
         return $result[0]; 
      }

      public function update( $racerTask ) {
         $query = "update StockExchangeDispatch set price = ?, counter = ? where  taskFk = ?";
         $parameter = array( 
            new Parameter( PDO::PARAM_STR, $racerTask->price ), 
            new Parameter( PDO::PARAM_INT, $racerTask->counter ),
            new Parameter( PDO::PARAM_INT, $racerTask->taskFk )
         );
         $this->query($query, $parameter);
      }

      public function init( $raceId ) {
         $query  = "insert into StockExchangeDispatch ";
         $query .= "(taskFk, raceFk, price, lastUpdate, counter) ";
         $query .= "select t.taskId, t.raceFk, t.price, now(), 0 ";
         $query .= "from Task t left outer join StockExchangeDispatch sed on t.taskId = sed.taskFk ";
         $query .= "where sed.taskFk is null and t.raseFk = ?";
         $parameter = array( new Parameter( PDO::PARAM_STR, $raceId ));
         $this->query($query, $parameter);
      }

   }

?>
