
<?php
   
   $dbFunction = new RacerTaskDbFunction();
   $checkpointId = CommonDbFunction::getUser()->checkpointFk; 
   $actions = $dbFunction->determineActions( $_GET['id'], $checkpointId );
   $dbFunction->close();

   foreach ( $actions as $action ) {
      print ( Page::getListItem(
         $action->parcel,  
         Page::getOnClickFunction( "racerTask", "confirmAction", $action->racerDeliveryId, "isDropoff=" . $action->isDropoff . "&manned=" . $action->manned ),
         ( $action->isDropoff ) ? $action->pickup . "-> " : "-> " . $action->dropoff 
       ) );

   }



?>
 
 racerTask
  <!-- 

   hier bitte html fuer die seite wenn ein fahrer zum checkpoint kommt.
   das soll die zweite sein. die erste seite wird eine racerliste und man springt nach der auswahl eines racers auf diese seite

   inhalt: was kann der fahrer aktuell an diesem checkpoint erledigen (mit moeglichkeit zur auswahl der aktion)

  -->
