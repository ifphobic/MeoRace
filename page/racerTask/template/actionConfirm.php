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
         <p class='description'>" . $racerDelivery->parcel . " Parcel-Description</p>
   ");
?>
      </div>
      <div class='right_info'>
         <div class='new_button'>Confirm</div>
      </div>
   </div><!-- top info wrapper -->
    </div>
    
    <div class="bottom_info_wrapper bottom_rider_tasks">
      <p class="racer_checkpointlist_heading">Full Manifest</p>

     <table>
         <tr>
           <th class="task_restrictions"></th>
           <th class="task_number"></th>
           <th class="task_pickup"></th>
           <th class="task_parcel"></th>
           <th class="task_drop"></th>
           <th class="task_status"></th>
         </tr>
         <tr class="no_action">
           <td class="task_restrictions"></td>
           <td class="task_number">1</td>
           <td class="task_pickup">
            <p class="title">C1</p>
            <p class="description">14:48</p>
           </td>
           <td class="task_parcel">P2</td>
           <td class="task_drop">
            <p class="title">C3</p>
            <p class="description">14:52</p>
           </td>
           <td class="task_status task_completed"></td>
         </tr>
         
         <tr class="no_action">
           <td class="task_restrictions"></td>
           <td class="task_number">3</td>
           <td class="task_pickup">
            <p class="title">C2</p>
            <p class="description">14:54</p>
           </td>
           <td class="task_parcel">P1</td>
           <td class="task_drop">
            <p class="title">C3</p>
            <p class="description">14:55</p>
           </td>
           <td class="task_status task_completed"></td>
         </tr>
         
         <tr class="no_action">
           <td class="task_restrictions">1,2</td>
           <td class="task_number">3</td>
           <td class="task_pickup">
            <p class="title">C3</p>
            <p class="description">14:57</p>
           </td>
           <td class="task_parcel"><div class="indicator_pos">P1</div></td>
           <td class="task_drop">
            <p class="title">C1</p>
            <p class="description">--:--</p>
           </td>
           <td class="task_status task_pickedup"></td>
         </tr>
         
         <tr class="no_action">
           <td class="task_restrictions">1,2</td>
           <td class="task_number">3</td>
           <td class="task_pickup">
            <p class="title">C3</p>
            <p class="description">14:57</p>
           </td>
           <td class="task_parcel"><div class="indicator_pos">P1</div></td>
           <td class="task_drop">
            <p class="title"><div class="indicator_current">C1</div></p>
            <p class="description">--:--</p>
           </td>
           <td class="task_status task_assigned"></td>
         </tr>
     </table>
   </div> <!-- bottom_content_wrapper xxx --> 
</div> <!-- bottom_info_wrapper xxx -->




   <input type="hidden" name="racerDeliveryId" value="<?php Page::printValue($racerDelivery, "racerDeliveryId") ?>" />
   <input type="hidden" name="racerTaskId" value="<?php Page::printValue($racerDelivery, "racerTaskFk") ?>" />
   <input type="hidden" name="isDropoff" value="<?php print( $_GET['isDropoff'] ) ?>" />
   <input type="hidden" name="manned" value="<?php print( $_GET['manned'] ) ?>" />
   
