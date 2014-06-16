
   <?php
      $checkpoint= null;
      if ( isset( $_GET['id'] ) ) {
         $dbFunction = new CheckpointDbFunction();
         $checkpoint = $dbFunction->findById( $_GET['id'] );
         $dbFunction->close();
         print( "<input type='hidden' name='checkpointId' value='" . $checkpoint->checkpointId ."' />" );
      } else {
         print( "<input type='hidden' name='raceFk' value='" . CommonDbFunction::getUser()->raceFk  ."' />" );
      }
   ?>
  
   <table>
      <?php print( CommonPageFunction::getInputField("name", $checkpoint, "Name") ) ?>
      <?php print( CommonPageFunction::getCheckbox("manned", $checkpoint, "Manned") ) ?>
   </table>
   
