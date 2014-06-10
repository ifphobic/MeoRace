<?php

   $taskId = $_GET{'id'};
   $dbFunction = new TaskDbFunction();
   $task = $dbFunction->findById( $taskId );
   $dbFunction->close();
   print( "<b>Task: " . $task->name . "</b> (" 
      . CommonPageFunction::getLink("race", "taskEdit", $taskId, "edit" ) . ", " 
      . CommonPageFunction::getLink("race", "taskList", $GLOBALS['MeoRace']['user']->raceFk, "configure race" ) . ")<br><br><br>" );
   
   $dbFunction = new DeliveryDbFunction();
   $deliveries = $dbFunction->findAll( $taskId );
   $dbFunction->close();
   $dbFunction = new DeliveryConditionDbFunction();
   $conditions = $dbFunction->findAll( $taskId );
   $dbFunction->close();


   function printDelivery( $delivery, $deliveries, $conditions, $taskId, $get ) {

      print("<tr><td>");
      print( DeliveryDbFunction::getPrevious( $delivery, $deliveries, $conditions ) );
      $filtered = DeliveryDbFunction::filterCurrent( $deliveries, $delivery, $conditions );
      if ( array_key_exists( "addPrevious", $get ) && $get['addPrevious'] == $delivery->deliveryId ) {
         Page::printFormStart("race", "deliveryConditionAdd");
         print("<input type='hidden' name='taskId' value='$taskId' />");
         print("<input type='hidden' name='deliveryFk' value='" . $delivery->deliveryId . "' />");
         print( CommonPageFunction::getComboBox( "previousDeliveryFk", null, null, $filtered, "deliveryId" ) );
         Page::printFormEnd();
      } else if ( count( $filtered ) > 0 ) {
         print( CommonPageFunction::getLink("race", "deliveryList", $taskId, "add", "addPrevious=" . $delivery->deliveryId ) );
      }

      print("
            </td>
            <td>" . $delivery->pickupName . "</td>
            <td>=></td>
            <td>" . $delivery->dropoffName . "</td>
            <td> (" . $delivery->parcelName . ")</td>
            <td>" . CommonPageFunction::getLink("race", "deliveryEdit", $delivery->deliveryId, "edit", "taskId=$taskId") . "</td>
         </tr>
      ");

   }
?>                     

<h1>Deliveries</h1>
<table>
   <th>Previous</th>
   <th>Pick Up</th>
   <th></th>
   <th>Drop Off</th>
   <th>Parcel</th>
   <th></th>

<?php
   
   $doneDeliveries = array();
   $possibleDeliveries = DeliveryDbFunction::getPossibleDeliveries( $deliveries, $conditions, $doneDeliveries );
   while ( count( $possibleDeliveries ) > 0 ) {
      foreach ( $possibleDeliveries as $delivery ) {
         printDelivery( $delivery, $deliveries, $conditions, $taskId, $_GET );
      }

      $doneDeliveries = array_merge( $doneDeliveries, $possibleDeliveries);
      $possibleDeliveries = DeliveryDbFunction::getPossibleDeliveries( $deliveries, $conditions, $doneDeliveries );
      print("<tr><td colspan='6'><hr/></td></tr>");
   }

   if ( count( $deliveries ) != count( $doneDeliveries ) ) {
      print("<tr><td colspan='6'><br><h2>Not reachable</h2></td></tr>");
      $impossibleDeliveries = DeliveryDbFunction::getImpossibleDeliveries( $deliveries, $doneDeliveries ); 
      foreach ( $impossibleDeliveries as $delivery ) {
         printDelivery( $delivery, $deliveries, $conditions, $taskId, $_GET );
      }
   }

?>   


</table>

<?php print( CommonPageFunction::getLink("race", "deliveryEdit", null, "New Delivery", "taskId=$taskId" ) );
 
