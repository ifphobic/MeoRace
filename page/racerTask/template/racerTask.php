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
   
<?php
   
   $dbFunction = new RacerTaskDbFunction();
   $checkpointId = CommonDbFunction::getUser()->checkpointFk; 
   $actions = $dbFunction->determineActions( $_GET['id'], $checkpointId );
   $dbFunction->close();

   foreach ( $actions as $action ) {
      print ( Page::getListItem(
         (($action->isDropoff) ? "Dropoff: " : "Pickup: " ) . $action->parcel,  
         Page::getOnClickFunction( "racerTask", "actionConfirm", $action->racerDeliveryId, "isDropoff=" . $action->isDropoff . "&manned=" . $action->manned ),
         ( $action->isDropoff ) ? $action->pickup . "-> " : "-> " . $action->dropoff, "manned: " . $action->manned . ", " . $action->racerDeliveryId
       ) );

   }



?>
 
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

         <tr>
            <td class="task_manifest">M3</td>
				<td class="task_pickup">A</td>
            <td class="task_parcel"><div class="indicator_pos">P1</div></td>
				<td class="task_drop"><div class="indicator_current">C</div></td>
            <td class="task_confirmation drop_parcel checked">DROP</td>
         </tr>
  
         <tr>
            <td class="task_manifest">M1</td>
            <td class="task_pickup"><div class="indicator_current">C</div></td>
            <td class="task_parcel"><div class="indicator_pos">P1</div></td>
				<td class="task_drop">B</td>
            <td class="task_confirmation pickup_parcel checked">PICKUP</td>
         </tr>

         <tr>
            <td class="task_manifest">M2</td>
            <td class="task_pickup">B</td>
            <td class="task_parcel">P1</td>
				<td class="task_drop"><div class="indicator_current">C</div></td>
            <td class="task_confirmation drop_parcel unchecked">BLOCKED</td>
         </tr>
      </table>
    </div> <!-- bottom_content_wrapper xxx -->
    
    <div class="bottom_info_wrapper bottom_rider_tasks">
      <p class="racer_checkpointlist_heading"> Foreign Tasks</p>

      <table>
         <tr>
            <th class="task_manifest"></th>
				<th class="task_pickup"></th>
            <th class="task_parcel"></th>
  				<th class="task_drop"></th>
            <th class="task_confirmation"></th>
         </tr>
         
         <tr class="no_action">
            <td class="task_manifest">M4</td>
            <td class="task_pickup">B</td>
            <td class="task_parcel">P1</td>
				<td class="task_drop">A</td>
            <td class="task_confirmation drop_parcel na">NO MATCH</td>
         </tr>
      </table>
         
    </div> <!-- bottom_content_wrapper xxx -->
   </div> <!-- bottom_info_wrapper xxx --> 
