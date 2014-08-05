<?php
   $racer = null;
   $dbFunction = new RacerTaskDbFunction();
   if ( isset( $_GET['id'] ) ) {
      $racer = $dbFunction->findById( $_GET['id'] );
      $raceId = $racer->raceFk;
   } else {
      $raceId = CommonDbFunction::getUser()->raceFk;
   }
   $dbFunction->close();
?>

<div class="top_content_wrapper""> <!-- Wrapper for the top content like search, selected rider, selected parcel and so on-->
   <div class="top_info_wrapper top_info_rider"> <!-- Second top wrapper: Put in here the search input form, selected rider, selected parcel and so on.  -->
      <div class='left_info'>
         <img src='http://static.wixstatic.com/media/87f473_013e75dfc64446ea98841a8f4c96056a.jpg_srz_321_273_75_22_0.50_1.20_0.00_jpg_srz' alt='strom praesi'>
      </div> 
      <div class='middle_info'>
         <p class='title'><?php Page::printValue( $racer, "name" ) ?></p>
         <p class='description'><?php Page::printValue($racer, array( "city", "country" ), ", ") ?></p>
      </div>
      <div class='right_info'>
         <p class='rider_number'><?php Page::printValue( $racer, "racerNumber" ) ?></p>
      </div>
   </div><!-- top info wrapper -->
</div> <!-- top content wrapper -->

<div class="bottom_content_wrapper">
   
   <div class="bottom_info_wrapper bottom_rider_tasks">

<p class="racer_checkpointlist_heading">Tasks Checkpoint C</p>

      <table>
         <tr>
            <th class="task_manifest"></th>
				<th class="task_pickup"></th>
            <th class="task_parcel"></th>
  				<th class="task_drop"></th>
            <th class="task_confirmation"></th>
         </tr>
         
<?php
   
   $dbFunction = new RacerTaskDbFunction();
   $checkpointId = CommonDbFunction::getUser()->checkpointFk; 
   $actions = $dbFunction->determineActions( $_GET['id'], $checkpointId );
   $dbFunction->close();

   foreach ( $actions as $action ) {
      print('<tr onclick="' . Page::getOnClickFunction( "racerTask", "actionConfirm", $action->racerDeliveryId, "isDropoff=" . $action->isDropoff . "&manned=" . $action->manned ) . '">
            <td class="task_manifest">' . $action->task . '</td>
				<td class="task_pickup">' . (($action->isDropoff) ? "<div>" : "<div class='indicator_current'>" ) . $action->pickup . '</div> ></td>
            <td class="task_parcel"><div class="indicator_pos">' . $action->parcel . '</div></td>
				<td class="task_drop">> ' . (($action->isDropoff) ? "<div class='indicator_current'>" : "<div>" ) . $action->dropoff . '</div></td>
            <td class="">' . (($action->isDropoff) ? "Dropoff" : "Pickup" ) . '</td>
         </tr>');
   }
?>

      </table>
    </div> <!-- bottom_content_wrapper xxx -->
    
    <div class="bottom_info_wrapper bottom_rider_tasks">
      <p class="racer_checkpointlist_heading">Open Manifests</p>
         <!-- @philip: put a list with all open manifest (even from other checkpoints) in here -->
    </div> <!-- bottom_content_wrapper xxx -->
   </div> <!-- bottom_info_wrapper xxx --> 
