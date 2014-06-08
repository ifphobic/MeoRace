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
   foreach ( $deliveries as $delivery ) {

      print("<tr><td>");
      print( DeliveryDbFunction::getPrevious( $delivery, $deliveries, $conditions ) );
      $filtered = DeliveryDbFunction::filterCurrent( $deliveries, $delivery, $conditions );
      if ( array_key_exists( "addPrevious", $_GET ) && $_GET['addPrevious'] == $delivery->deliveryId ) {
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
            <td>" . CommonPageFunction::getLink("race", "deliveryEdit", $delivery->deliveryId, "edit") . "</td>
         </tr>
      ");
   }
?>   


</table>

<?php print( CommonPageFunction::getLink("race", "deliveryEdit", null, "New Delivery", "taskId=$taskId" ) );
 
