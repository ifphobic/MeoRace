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
</div>



   <input type="hidden" name="racerDeliveryId" value="<?php Page::printValue($racerDelivery, "racerDeliveryId") ?>" />
   <input type="hidden" name="racerTaskId" value="<?php Page::printValue($racerDelivery, "racerTaskFk") ?>" />
   <input type="hidden" name="isDropoff" value="<?php print( $_GET['isDropoff'] ) ?>" />
   <input type="hidden" name="manned" value="<?php print( $_GET['manned'] ) ?>" />
   
