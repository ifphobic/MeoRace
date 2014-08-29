<?php

   $user = CommonDbFunction::getUser();
   $dbFunction = new RaceDbFunction();
   $race = $dbFunction->findById( $user->raceFk );
   $dbFunction->close();
   
   $content = Page::getContent();
   $taskId = $content["id"] ;
   $dbFunction = new TaskDbFunction();
   $task = $dbFunction->findById( $taskId );
   $dbFunction->close();
?>
<b>Task: <?php print($task->name) ?></b><br>
<b>Description: <?php print($task->description) ?></b><br>
<b>maxDuration: <?php print(Page::readableDuration($task->maxDuration)) ?></b>
<b> Price: <?php print($task->price) ?></b>

<div class='new_button' onclick='<?php print(Page::getOnClickFunction( "race", "taskEdit", $taskId, "edit" ) ) ?> '>Edit Task</div>

<?php if ( array_key_exists( "deleteTask", $_GET ) && $_GET['deleteTask'] == $task->taskId ) {
         Page::printFormStart("race", "taskDelete");
         print("<input type='hidden' name='raceId' value='" . $race->raceId . "' />");
         print("<input type='hidden' name='taskId' value='" . $task->taskId . "' />");
         Page::printFormEnd( "confirm delete" );
      } else {
         print( CommonPageFunction::getLink("race", "deliveryList", $race->raceId, "delete", "deleteTask=" . $task->taskId, 0 ) );
      } ?>

<?php   
   $dbFunction = new DeliveryDbFunction();
   $deliveries = $dbFunction->findAll( $taskId );
   $dbFunction->close();
   $dbFunction = new DeliveryConditionDbFunction();
   $conditions = $dbFunction->findAll( $taskId );
   $dbFunction->close();


   function printDelivery( $delivery, $deliveries, $conditions, $taskId, $get ) {
      
      print("<tr><td>");
      $previous = DeliveryDbFunction::getPrevious( $delivery, $deliveries, $conditions );
      foreach ( $previous as $next ) {
         if ( array_key_exists( "deleteCondition", $get ) && $get['deleteCondition'] == $next->deliveryConditionId ) {
            Page::printFormStart("race", "deliveryConditionDelete");
            print("<input type='hidden' name='taskId' value='$taskId' />");
            print("<input type='hidden' name='deliveryConditionId' value='" . $next->deliveryConditionId . "' />");
            Page::printFormEnd("delete: " . $next->name);
         } else {
            print( CommonPageFunction::getLink("race", "deliveryList", $taskId, $next->name, "deleteCondition=" . $next->deliveryConditionId, 0 ) );
         }
         print(", ");
      }

      $filtered = DeliveryDbFunction::filterCurrent( $deliveries, $delivery, $conditions );
      if ( array_key_exists( "addPrevious", $get ) && $get['addPrevious'] == $delivery->deliveryId ) {
         Page::printFormStart("race", "deliveryConditionAdd");
         print("<input type='hidden' name='taskId' value='$taskId' />");
         print("<input type='hidden' name='deliveryFk' value='" . $delivery->deliveryId . "' />");
         print( CommonPageFunction::getComboBox( "previousDeliveryFk", null, null, $filtered, "deliveryId" ) );
         Page::printFormEnd();
      } else if ( count( $filtered ) > 0 ) {
         print( CommonPageFunction::getLink("race", "deliveryList", $taskId, "add", "addPrevious=" . $delivery->deliveryId, 0 ) );
      }

      print("
            </td>
            <td>" . $delivery->name . "</td>
            <td>" . $delivery->pickupName . "</td>
            <td>=></td>
            <td>" . $delivery->parcelName . "</td>
            <td>=></td>
            <td>" . $delivery->dropoffName . "</td>
            <td>" . CommonPageFunction::getLink("race", "deliveryEdit", $delivery->deliveryId, "edit", "taskId=$taskId") . "</td>
            <td>
      ");
      if ( array_key_exists( "deleteDelivery", $get ) && $get['deleteDelivery'] == $delivery->deliveryId ) {
         Page::printFormStart("race", "deliveryDelete");
         print("<input type='hidden' name='taskId' value='$taskId' />");
         print("<input type='hidden' name='deliveryId' value='" . $delivery->deliveryId . "' />");
         Page::printFormEnd("confirm delete");
      } else {
         print( CommonPageFunction::getLink("race", "deliveryList", $taskId, "delete", "deleteDelivery=" . $delivery->deliveryId, 0 ) );
      }
      print("</td></tr>");
   }

   function groupDeliveries( $deliveries, $conditions ) {
      $doneDeliveries = array();
      $possibleDeliveries = DeliveryDbFunction::getPossibleDeliveries( $deliveries, $conditions, $doneDeliveries );
      $deliveryNumber = 1;
      $result = array();
      while ( count( $possibleDeliveries ) > 0 ) {
         foreach( $possibleDeliveries as $delivery ) {
            $delivery->name = $deliveryNumber++;
         }
         $result[] = $possibleDeliveries;
         $doneDeliveries = array_merge( $doneDeliveries, $possibleDeliveries);
         $possibleDeliveries = DeliveryDbFunction::getPossibleDeliveries( $deliveries, $conditions, $doneDeliveries );
      }
      if ( count( $deliveries ) != count( $doneDeliveries ) ) {
         $impossibleDeliveries = DeliveryDbFunction::getImpossibleDeliveries( $deliveries, $doneDeliveries );
         foreach( $impossibleDeliveries as $delivery ) {
            $delivery->name = $deliveryNumber++;
         }
         $result[] = $impossibleDeliveries;
      } else {
         $result[] = null;
      }
      return $result;
   }
?>                     

<h1>Deliveries</h1>
<table>
   <th>Previous</th>
   <th>Number</th>
   <th>Pick Up</th>
   <th></th>
   <th>Parcel</th>
   <th></th>
   <th>Drop Off</th>

<?php
   $groupedDeliveries = groupDeliveries( $deliveries, $conditions ); 
   for ( $i = 0; $i < count( $groupedDeliveries ) - 1; $i++ ) {
      foreach ( $groupedDeliveries[$i] as $delivery ) {
         printDelivery( $delivery, $deliveries, $conditions, $taskId, $_GET );
      }
      print("<tr><td colspan='9'><hr/></td></tr>");
   }
   

   if ( $groupedDeliveries[ count( $groupedDeliveries) - 1 ] != null ) {
      print("<tr><td colspan='9'><br><h2>Not reachable</h2></td></tr>");
      foreach ( $groupedDeliveries[ count( $groupedDeliveries) - 1 ] as $delivery ) {
         printDelivery( $delivery, $deliveries, $conditions, $taskId, $_GET );
      }
   }

?>   


</table>

<div class='new_button' onclick='<?php print(Page::getOnClickFunction( "race", "deliveryEdit", null, "New Delivery", "taskId=$taskId" ) ) ?> '>+ New Delivery</div>
 
