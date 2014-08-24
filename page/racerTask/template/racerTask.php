<?php
   $racer = null;
  
   $dbFunction = new RacerDbFunction();
   $racer = $dbFunction->findById( $_GET['id'] );
   $raceId = $racer->raceFk;
   
   $dbFunction->close();
?>

<div class="content_tab" id="racertask_racertask">

<div class="top_content_wrapper""> <!-- Wrapper for the top content like search, selected rider, selected parcel and so on-->
   <div class="top_info_wrapper top_info_rider"> <!-- Second top wrapper: Put in here the search input form, selected rider, selected parcel and so on.  -->
      <div class='left_info'>
         <img src='<?php print( Page::getImagePath( $racer ) ) ?>' alt='strom praesi'>
      </div> 
      <div class='middle_info'>
         <p class='title'><?php print( $racer->name ) ?></p>
         <p class='description'><?php print( Page::printValue($racer, array( "city", "country" ), ", ") ) ?></p>
      </div>
      <div class='middle_info racer_ranking_points'>
         <p>
            <span class='racer_ranking'>1</span>
            <span class='racer_points'>120</span>
         </p>
      </div>
      <div class='right_info'>
         <p class='rider_number'><?php print( $racer->racerNumber ) ?></p>
      </div>
   </div><!-- top info wrapper -->
</div> <!-- top content wrapper -->

<div class="bottom_content_wrapper">

<p class="racer_checkpointlist_heading">Possible Actions</p>

   <table>
   <tr class="tableheader">
	  <th class="task_number"></th>
	  <th class="checkpoint_name_first"></th>
	  <th class="goto_arrow"></th>
	  <th class="parcel_name"></th>
	  <th class="goto_arrow"></th>
	  <th class="checkpoint_name_second"></th>
	  <th class="drilldown"></th>
	</tr>

         
<?php
   
   $dbFunction = new RacerTaskDbFunction();
   $checkpointId = CommonDbFunction::getUser()->checkpointFk; 
   $actions = $dbFunction->determineActions( $_GET['id'], $checkpointId );
   $dbFunction->close();

   foreach ( $actions as $action ) {
      print("<tr onclick='" . Page::getOnClickFunction( "racerTask", "actionConfirm", $action->racerDeliveryId, "isDropoff=" . $action->isDropoff . "&manned=" . $action->manned . "&racerId=" . $racer->racerId ) . "'>
            <td class='task_number'><div class='task_number_bubble'><span class='task_number_number'>". $action->task . "</span></div></td>
	    <td class='checkpoint_name_first'>". (($action->isDropoff) ? "<div>" : "<div class='indicator_current'>" ) . $action->pickup . "</div></td>
            <td class='goto_arrow'></td>
	    <td class='parcel_name'><img src='http://www.worldwide-parcelservices.co.uk/custom/upload/images/parcel.jpg' height=25px width=25px;>
        <div class='indicator_pos'><span class='parcel_number_number'>" . $action->parcel . "</span></div></td>
	    <td class='goto_arrow'></td>
	    <td class='checkpoint_name_second'> " . (($action->isDropoff) ? "<div class='indicator_current'>" : "<div>" ) . $action->dropoff . "</div></td>
            <td class='drilldown'>" . (($action->isDropoff) ? "Dropoff" : "Pickup" ) . "</td>
         </tr>");
   }
?>
    </table>
   </div> <!-- bottom_content_wrapper xxx -->
</div>
