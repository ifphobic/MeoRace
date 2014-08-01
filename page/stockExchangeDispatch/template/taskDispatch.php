<?php
   $dbFunction = new StockExchangeDispatchDbFunction();
   $raceFk = CommonDbFunction::getUser()->raceFk;
   $tasks = $dbFunction->findAll( $raceFk );
   if ( count( $tasks ) == 0 ) {
      $dbFunction->init( $raceFk );
      $tasks = $dbFunction->findAll( $raceFk );
   }
   $dbFunction->close();

   foreach ( $tasks as $task ) {
      print ( Page::getListItem( $task->name, Page::getOnClickFunction( "stockExchangeDispatch", "racerList", $task->taskFk ), round( $task->price ) . "/" . "max. " . Page::readableDuration( $task->maxDuration ), $task->description ) );

   }

?>
<reload interval="10" />
