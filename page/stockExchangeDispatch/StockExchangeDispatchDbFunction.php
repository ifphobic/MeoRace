<?php

   class StockExchangeDispatchDbFunction extends AbstractDbFunction {

      public function StockExchangeDispatchDbFunction() {
         $this->AbstractDbFunction();
      }


      public function findAll( $raceId, $racerId ) {
         
         $query  = "select sed.*, t.name, t.description, t.maxDuration, ";
         $query .= "(select count(1) = 0 from RacerTask rt where rt.endTime is null and rt.taskFk = t.taskId and rt.racerFk = ?) as notAssigned ";
         $query .= "from StockExchangeDispatch sed ";
         $query .= "join Task t on sed.taskFk = t.taskId where sed.raceFk = ? order by t.name";
         $result = $this->queryArray($query, array( new Parameter( PDO::PARAM_INT, $racerId ), new Parameter( PDO::PARAM_INT, $raceId ) ) );
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
         $query .= "(taskFk, raceFk, price, counter) ";
         $query .= "select t.taskId, t.raceFk, t.price, 0 ";
         $query .= "from Task t left outer join StockExchangeDispatch sed on t.taskId = sed.taskFk ";
         $query .= "where sed.taskFk is null and t.raceFk = ?";
         $parameter = array( new Parameter( PDO::PARAM_STR, $raceId ));
         $this->query($query, $parameter);
      }

   }

?>
