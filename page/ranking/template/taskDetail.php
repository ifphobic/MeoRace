<?php
   include 'page/ranking/RankingCalculator.php';
   
   $dbFunction = new RankingDbFunction();
   $racerDeliveries = $dbFunction->findById( $_GET['id'] );
   $dbFunction->close();
   
   $racerTask = $racerDeliveries[0];
   $taskComplete = true;
   $time = $racerTask->taskTime;
   if($racerTask->taskTime == null) {
      $taskComplete = false;
      $time = $racerTask->maxDuration - $racerTask->currentTime;
   }

   $raceFinished = RaceDbFunction::isFinished( $racerTask->raceFk );

?>

<div class="content_tab" id="ranking_taskdetail">

<div class="top_content_wrapper detail">
   <div class="top_info_wrapper"> 
      <div class="left_info">
         <p class="manifest_number <?php $taskComplete ? print("manifest_completed") : print("manifest_possible"); ?>">
         <?php print( $racerTask->taskName ) ?></p>
      </div>
      <div class="middle_info">
         <p class="title"><?php print( $racerTask->taskDescription ) ?></p>
         <p class="description"><?php $taskComplete ? print("Completed") : print("Open"); ?></p>
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
   foreach ( $racerDeliveries as $delivery ) {
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
      <th colspan="6" class="task_requirements no_requirements">Possible after: -</th>
   </tr>

   <tr>
      <td rowspan="2" class="task_number">01</td>
      <td class="checkpoint_name_first"><?php print( $delivery->pickupName ) ?></td>
      <td class="goto_arrow">>></td>
      <td class="parcel_name"><?php print( $delivery->parcelName ) ?></td>
      <td class="goto_arrow">>></td>
      <td class="checkpoint_name_second"><?php print( $delivery->dropoffName ) ?></td>
   </tr>

   <tr>
      <td><?php print( $delivery->pickupTime ) ?></td>
      <td></td>
      <td></td>
      <td></td>
      <td><?php print( $delivery->dropoffTime ) ?></td>
   </tr>

</table>


<?php
   }
?>

<table>
  

  <tr onclick='<?php print( Page::getOnClickFunction( "ranking", "parcelDetail" ) ) ?>'>
<th rowspan="3" class="task_status task_completed"></th>
<th colspan="6" class="task_requirements no_requirements">Possible after: -</th>
</tr>

<tr onclick='<?php print( Page::getOnClickFunction( "ranking", "parcelDetail" ) ) ?>'>
<td rowspan="2" class="task_number">01</td>
<td class="checkpoint_name_first">Beda</td>
<td class="goto_arrow">>></td>
<td class="parcel_name">P1</td>
<td class="goto_arrow">>></td>
<td class="checkpoint_name_second">Amon</td>
</tr>

<tr onclick='<?php print( Page::getOnClickFunction( "ranking", "parcelDetail" ) ) ?>'>
<td>14:30</td>
<td></td>
<td>XXX</td>
<td></td>
<td>14.45</td>
</tr>

</table>

<table>
  

  <tr>
<th rowspan="3" class="task_status task_possible"></th>
<th colspan="6" class="task_requirements requirements">Possible after: 1</th>
</tr>

<tr>
<td rowspan="2" class="task_number">02</td>
<td class="checkpoint_name_first">Beda</td>
<td class="goto_arrow">>></td>
<td class="parcel_name">P1</td>
<td class="goto_arrow">>></td>
<td class="checkpoint_name_second">Amon</td>
</tr>

<tr>
<td>14:30</td>
<td></td>
<td>XXX</td>
<td></td>
<td>14.45</td>
</tr>

</table>


<table>
  

  <tr>
<th rowspan="3" class="task_status task_unreachable"></th>
<th colspan="6" class="task_requirements requirements">Possible after: 1, 2</th>
</tr>


<tr>
<td rowspan="2" class="task_number">03</td>
<td class="checkpoint_name_first">Beda</td>
<td class="goto_arrow">>></td>
<td class="parcel_name">P1</td>
<td class="goto_arrow">>></td>
<td class="checkpoint_name_second">Amon</td>
</tr>

<tr>
<td>14:30</td>
<td></td>
<td>XXX</td>
<td></td>
<td>14.45</td>
</tr>

</table>
  
 </div> <!-- bottom_content_wrapper xxx -->
</div> <!-- top content wrapper -->   
