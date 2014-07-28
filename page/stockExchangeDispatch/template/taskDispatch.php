<?php
   
   $dbFunction = new TaskDbFunction();
   $tasks = $dbFunction->findAll( CommonDbFunction::getUser()->raceFk );
   $dbFunction->close();

   foreach ( $tasks as $task ) {
      print ( Page::getListItem( $task->name, Page::getParameter( "stockExchangeDispatch", "racerDispatch", $task->taskId ), $task->currentPrice . "/" . "max. " . Page::readableDuration( $task->maxDuration ), $task->description ) );

   }

?>
<reload interval="1" />
