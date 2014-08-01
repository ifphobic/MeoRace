
<?php
  
   $dbFuction = new RacerTaskDbFunction();
   $racerDelivery = $dbFuction->findById( $_GET['id'] );
   $dbFuction->close();


   if ( $_GET['isDropoff' ] ) {
      print( "<h1>Dropoff</h1>" );
   } else {
      print( "<h1>Pickup</h1>" );
   }

   print( "Parcel: " . $racerDelivery->parcel );
?>

   <input type="hidden" name="racerDeliveryId" value="<?php Page::printValue($racerDelivery, "racerDeliveryId") ?>" />
   <input type="hidden" name="isDropoff" value="<?php print( $_GET['isDropoff'] ) ?>" />
   <input type="hidden" name="manned" value="<?php print( $_GET['manned'] ) ?>" />
   
