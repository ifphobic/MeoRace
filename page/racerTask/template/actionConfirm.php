<?php

   if ( RaceDbFunction::printFinished( CommonDbFunction::getUser()->raceFk) ) {
      exit;
   }

   $racer = null;
   $dbFunction = new RacerDbFunction();
   $racer = $dbFunction->findById( $_GET['racerId'] );
   $raceId = $racer->raceFk;
   $dbFunction->close();
?>

<div class="content_tab confirm" id="racertask_racertask">

<div class="top_content_wrapper detail">
   <div class="top_info_wrapper">
      <div class='left_info'>
         <img src='<?php print( Page::getImagePath( $racer ) ) ?>' alt='strom praesi'>
      </div> 
      <div class='middle_info'>
         <p class='title'><?php Page::printValue( $racer, "name" ) ?></p>
         <p class='description'><?php Page::printValue($racer, array( "city", "country" ), ", ") ?></p>
      </div>
      <div class='middle_info racer_ranking_points'>
         <p>
            <span class='racer_ranking'>1</span>
            <span class='racer_points'>120</span>
         </p>
      </div>
      <div class='right_info'>
         <p class='rider_number'><?php Page::printValue( $racer, "racerNumber" ) ?></p>
      </div>
   </div><!-- top info wrapper -->
</div> <!-- top content wrapper -->
    
<div class="bottom_content_wrapper">
      
<?php
  
   $dbFuction = new RacerTaskDbFunction();
   $racerDelivery = $dbFuction->findRacerDeliveryById( $_GET['id'] );
   $dbFuction->close();
   print("<p class='racer_checkpointlist_heading'>");
   if ( $_GET['isDropoff' ] ) {
      print( "Dropoff" );
   } else {
      print( "Pickup" );
   }
   print("</p>
	<ul>
	<li>
   <div class='listwrapper'>
      <div class='left_info parcel_name'><img src='" . Page::getImagePath( $racerDelivery ) . "'>
         </div> 
      <div class='middle_info'>
         <p class='title'>");
   print( $racerDelivery->parcel );
   print("</p>
         <p class='description'>" . $racerDelivery->description . "</p>
   ");
?>
      </div>
   </li>
	</ul>
    </div> 
</div>



   <input type="hidden" name="racerDeliveryId" value="<?php Page::printValue($racerDelivery, "racerDeliveryId") ?>" />
   <input type="hidden" name="racerTaskId" value="<?php Page::printValue($racerDelivery, "racerTaskFk") ?>" />
   <input type="hidden" name="isDropoff" value="<?php print( $_GET['isDropoff'] ) ?>" />
   <input type="hidden" name="manned" value="<?php print( $_GET['manned'] ) ?>" />
   
