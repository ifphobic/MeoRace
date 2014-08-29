<?php
   include 'page/ranking/RankingCalculator.php';
   
   $dbFunction = new RankingDbFunction();
   $racerDeliveries = $dbFunction->findById( $_GET['id'] );
   $dbFunction->close();
   
   $racerTask = $racerDeliveries[0];
   $raceFinished = RaceDbFunction::isFinished( $racerTask->raceFk );
   if ( $racerTask->taskTime != null ) {
      $time = $racerTask->taskTime;
      $taskStatusText = "Done";
      $taskStatus = "manifest_completed";
   } else if ( !$raceFinished ) {
      $time = $racerTask->currentTime;
      $taskStatusText = "Open";
      $taskStatus = ( $time <= $racerTask->maxDuration ) ? "manifest_possible" : "manifest_unreachable";
   } else {
      $time = null;
      $taskStatus = "manifest_unreachable";
      $taskStatusText = "Not finished";
   }

   $addition = "";
   if ( $time != null ) {
      $relative = $racerTask->maxDuration - $time;
      if ( $relative >= 0 ) {
         $addition = "Remaining ";
      } else {
         $addition = "Overtime ";
      }
      $addition .= Page::readableDuration( abs( $relative ) );
   }  

?>

<div class="content_tab" id="ranking_taskdetail">

<div class="top_content_wrapper detail">
   <div class="top_info_wrapper"> 
      <div class="left_info">
         <p class="manifest_number <?php print( $taskStatus ) ?>">
         <?php print( $racerTask->taskName ) ?></p>
      </div>
      <div class="middle_info">
         <p class="title"><?php print( $racerTask->taskDescription ) ?></p>
         <p class="description"><?php print( $taskStatusText ) ?></p>
      </div>
      <div class='middle_info racer_ranking_points'>
         <p><?php print($addition); ?></p>
      </div>
      <div class="right_info">
         <p class="manifest_points"><?php print( RankingCalculator::calculateScore( $racerTask, $raceFinished ) . "/" . $racerTask->price ) ?></p>
         <p class="manifest_maxduration"><?php print(Page::readableDuration( $time )) ?></p>
      </div>
   </div> <!-- top info wrapper -->
       </div>  <!-- top content wrapper -->
   

<div class="bottom_content_wrapper">
      

<p class="racer_checkpointlist_heading manifest_detail_heading">Full Manifest</p>

<?php


   $counter = 1;
   $mapping = array();
   foreach ( $racerDeliveries as $delivery ) {
      $delivery->number = $counter++; 
      $mapping[ $delivery->deliveryId ] = $delivery->number;
   }

   foreach ( $racerDeliveries as $delivery ) {
      $conditions =  explode( ",", $delivery->conditions );
      $conditionString = "";
      foreach ( $conditions as $condition ) {
         if ( !empty( $condition ) ) {
            $conditionString .= "," . $mapping[ $condition ];
         }
      }
      if ( !empty( $conditionString ) ) {
         $conditionString = substr( $conditionString, 1 );
         $conditionString = " (Possible after: " . $conditionString . ")";
      }

      if ( $delivery->pickupTime == null ) {
         $status = "task_unreachable";
      } else if ( $delivery->dropoffTime == null ) {
         $status = "task_possible";
      } else {
         $status = "task_completed";
      }
?>

<table>
   <tr>
      <th rowspan="3" class="task_status <?php print( $status ) ?>"></th>
      <th colspan="5" class="task_requirements no_requirements"><?php print( $delivery->number . $conditionString ) ?></th>
   </tr>

   <tr>
      <td class="checkpoint_name_first"><?php print( $delivery->pickupName ) ?></td>
      <td class="goto_arrow">>></td>
      <td class="parcel_name"><div class='parcel_image'><img src="<?php print( Page::getImagePath( $delivery ) ) ?>"></div></td>
      <td class="goto_arrow">>></td>
      <td class="checkpoint_name_second"><?php print( $delivery->dropoffName ) ?></td>
   </tr>

    <tr>
      <td colspan="2"><?php print( $delivery->pickupTime ) ?></td>
      <td></td>
      <td colspan="2" style="text-align: right"><?php print( $delivery->dropoffTime ) ?></td>
   </tr>

</table>


<?php
   }
?>
 </div> <!-- bottom_content_wrapper xxx -->
</div> <!-- top content wrapper -->   
