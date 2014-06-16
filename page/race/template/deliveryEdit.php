
   <?php

      $taskId = $_GET['taskId'];
      $delivery = null;
      if ( isset( $_GET['id'] ) ) {
         $dbFunction = new DeliveryDbFunction();
         $delivery = $dbFunction->findById( $_GET['id'] );
         $dbFunction->close();
         print( "<input type='hidden' name='deliveryId' value='" . $delivery->deliveryId ."' />" );
      }
      print( "<input type='hidden' name='taskFk' value='" . $taskId ."' />" );
      
      $raceFk = CommonDbFunction::getUser()->raceFk;
      $dbFunction = new CheckpointDbFunction();
      $checkpoints = $dbFunction->findAll( $raceFk );
      $dbFunction->close();
      $parcels = array( (object) array( "name" => "none", "parcelId" => -1) );
      $dbFunction = new ParcelDbFunction();
      $parcels = array_merge($parcels, $dbFunction->findAll( $raceFk ));
      $dbFunction->close();

   ?>
  
   <table>
      <?php print( CommonPageFunction::getCombobox( "parcelFk", $delivery, "Parcel", $parcels, "parcelId" ) ) ?>
      <?php print( CommonPageFunction::getCombobox( "pickupFk", $delivery, "Pick Up", $checkpoints, "checkpointId" ) ) ?>
      <?php print( CommonPageFunction::getCombobox( "dropoffFk", $delivery, "Drop Off", $checkpoints, "checkpointId" ) ) ?>
   </table>
   
