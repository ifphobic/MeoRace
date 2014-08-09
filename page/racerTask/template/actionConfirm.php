<div class="content_tab" id="actionconfirm_racertask">


<div class="top_content_wrapper""> <!-- Wrapper for the top content like search, selected rider, selected parcel and so on-->
   <div class="top_info_wrapper"> <!-- Second top wrapper: Put in here the search input form, selected rider, selected parcel and so on.  -->
      <div class="left_info">
         <p class="manifest_number">12</p>
      </div> 
      <div class="middle_info">
         <p class="manifest_name">Manifest12</p>
         <p class="manifest_description">Rock'n'Roll</p>
      </div>
      <div class="right_info">
         <p class="manifest_points">100</p>
         <p class="manifest_maxduration">00:02:10</p>
      </div>
   </div> <!-- top info wrapper -->
   
   
</div> <!-- top content wrapper -->     
    
<div class="bottom_content_wrapper">
    <div class="bottom_info_wrapper bottom_rider_tasks">
      
      <p class="racer_checkpointlist_heading">Current Action</p>
   <div class="top_info_wrapper top_info_rider"> <!-- Second top wrapper: Put in here the search input form, selected rider, selected parcel and so on.  -->
      <div class='left_info'>
<?php
  
   $dbFuction = new RacerTaskDbFunction();
   $racerDelivery = $dbFuction->findRacerDeliveryById( $_GET['id'] );
   $dbFuction->close();
   print( $racerDelivery->parcel );
   print("</div> 
      <div class='middle_info'>
         <p class='title'>");
   if ( $_GET['isDropoff' ] ) {
      print( "Dropoff" );
   } else {
      print( "Pickup" );
   }
   print("</p>
         <p class='description'>" . $racerDelivery->description . "</p>
   ");
?>
      </div>
      <div class='right_info'>
         <p class="confirm"></p>
      </div>
   </div><!-- top info wrapper -->
    </div>
    
    <div class="bottom_info_wrapper bottom_rider_tasks">
      <p class="racer_checkpointlist_heading">Full Manifest</p>

     <table>
  

  <tr>
<th rowspan="3" class="task_status task_completed"></th>
<th colspan="6" class="task_requirements no_requirements">Possible after: -</th>
</tr>

</tr>

<tr>
<td rowspan="2" class="task_number">01</td>
<td class="checkpoint_name_first">Beda</td>
<td class="goto_arrow">>></td>
<td class="parcel_name">P1</td>
<td class="goto_arrow">>></td>
<td class="checkpoint_name_second">Amon</td>
</tr>

<tr>
<td>14:30</td>
<td></td>
<td></td>
<td></td>
<td>14.45</td>
</tr>

</table>

<table>
  

  <tr>
<th rowspan="3" class="task_status task_possible"></th>
<th colspan="6" class="task_requirements requirements">Possible after: 1</th>
</tr>

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
<td></td>
<td></td>
<td>14.45</td>
</tr>

</table>


<table>
  

  <tr>
<th rowspan="3" class="task_status task_unreachable"></th>
<th colspan="6" class="task_requirements requirements">Possible after: 1, 2</th>
</tr>

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
<td></td>
<td></td>
<td>14.45</td>
</tr>

</table>
   </div> <!-- bottom_content_wrapper xxx --> 
</div>



   <input type="hidden" name="racerDeliveryId" value="<?php Page::printValue($racerDelivery, "racerDeliveryId") ?>" />
   <input type="hidden" name="racerTaskId" value="<?php Page::printValue($racerDelivery, "racerTaskFk") ?>" />
   <input type="hidden" name="isDropoff" value="<?php print( $_GET['isDropoff'] ) ?>" />
   <input type="hidden" name="manned" value="<?php print( $_GET['manned'] ) ?>" />
   
