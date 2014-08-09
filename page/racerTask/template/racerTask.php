<?php
   $racer = null;
   $dbFunction = new RacerDbFunction();
   if ( isset( $_GET['id'] ) ) {
      $racer = $dbFunction->findById( $_GET['id'] );
      $raceId = $racer->raceFk;
   } else {
      $raceId = CommonDbFunction::getUser()->raceFk;
   }
   $dbFunction->close();
?>

<div class="content_tab" id="racertask_racertask">

<div class="top_content_wrapper""> <!-- Wrapper for the top content like search, selected rider, selected parcel and so on-->
   <div class="top_info_wrapper top_info_rider"> <!-- Second top wrapper: Put in here the search input form, selected rider, selected parcel and so on.  -->
      <div class='left_info'>
         <img src='" . Page::getImagePath( $racer ) . "' alt='strom praesi'>
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
      print('<tr onclick="' . Page::getOnClickFunction( "racerTask", "actionConfirm", $action->racerDeliveryId, "isDropoff=" . $action->isDropoff . "&manned=" . $action->manned ) . '">
            <td class="task_number">' . $action->task . '</td>
	    <td class="checkpoint_name_first">' . (($action->isDropoff) ? "<div>" : "<div class='indicator_current'>" ) . $action->pickup . '</div></td>
            <td class="goto_arrow">>></td>
	    <td class="parcel_name"><div class="indicator_pos">' . $action->parcel . '</div></td>
	    <td class="goto_arrow">>></td>
	    <td class="checkpoint_name_second"> ' . (($action->isDropoff) ? "<div class='indicator_current'>" : "<div>" ) . $action->dropoff . '</div></td>
            <td class="drilldown">' . (($action->isDropoff) ? "Dropoff" : "Pickup" ) . '</td>
         </tr>');
   }
?>
    </table>
    </div> <!-- bottom_content_wrapper xxx -->
    
    
        <!-- @philip: put a list with all open manifest (even from other checkpoints) in here -->
    
      <p class="racer_checkpointlist_heading">Open Manifests</p>
       <ul>
    <li>

  <div class="left_info">
      <p class="manifest_number">12</p>
      </div> 
       
      <div class="middle_info">
      <p class="title">Tolles Manifest</p>
	  <p class="description">Rock'n'Roll</p>
	 
      </div>
      
      <div class="right_info">
      <p class="manifest_points">100</p>
      <p class="manifest_maxduration">00:02:10</p>
      </div>
      
    </li>
      </ul>
 
 <ul>
    <li>

  <div class="left_info">
      <p class="manifest_number">14</p>
      </div> 
       
      <div class="middle_info">
      <p class="title">Tolles Manifest</p>
	  <p class="description">Rock'n'Roll</p>
	 
      </div>
      
      <div class="right_info">
      <p class="manifest_points">100</p>
      <p class="manifest_maxduration">00:02:10</p>
      </div>
    </li>
      </ul>
 
 
 
 <ul>
    <li>

  <div class="left_info">
      <p class="manifest_number">19</p>
      </div> 
       
      <div class="middle_info">
      <p class="title">Tolles Manifest</p>
	  <p class="description">Rock'n'Roll</p>
	 
      </div>
      
      <div class="right_info">
      <p class="manifest_points">100</p>
      <p class="manifest_maxduration">00:02:10</p>
      </div>
    </li>
      </ul>
 
 
 
 
 <ul>
    <li>

  <div class="left_info">
      <p class="manifest_number">01</p>
      </div> 
       
      <div class="middle_info">
      <p class="title">Tolles Manifest</p>
	  <p class="description">Rock'n'Roll</p>
	 
      </div>
      
      <div class="right_info">
      <p class="manifest_points">100</p>
      <p class="manifest_maxduration">00:02:10</p>
      </div>
    </li>
      </ul>
      
      
     
    </div> <!-- bottom_content_wrapper xxx -->
    
</div>
