
   <?php
      $parcel= null;
      if ( isset( $_GET['id'] ) ) {
         $dbFunction = new ParcelDbFunction();
         $parcel = $dbFunction->findById( $_GET['id'] );
         $dbFunction->close();
         print( "<input type='hidden' name='parcelId' value='" . $parcel->parcelId ."' />" );
      } else {
         print( "<input type='hidden' name='raceFk' value='" . CommonDbFunction::getUser()->raceFk  ."' />" );
      }
   ?>
  
   <table>
      <?php print( CommonPageFunction::getInputField("name", $parcel, "Name") ) ?>
      <?php print( CommonPageFunction::getInputField("description", $parcel, "Description") ) ?>
   </table>
   
