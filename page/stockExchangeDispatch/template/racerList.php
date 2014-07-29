<?php
   
   $dbFunction = new RacerDbFunction();
   $racers = $dbFunction->findAll( CommonDbFunction::getUser()->raceFk );
   $dbFunction->close();

   foreach ( $racers as $racer ) {
      print ( Page::getListItem( 
         $racer->racerNumber . "" . $racer->name, 
         Page::getParameter( "stockExchangeDispatch", "racerDispatch", $racer->racerId, "taskId=" . $_GET['id'] ) 
      ) );

   }

?>