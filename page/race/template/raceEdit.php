
   <?php
      $race = null;
      if ( isset( $_GET['id'] ) ) {
         $dbFunction = new RaceDbFunction();
         $race = $dbFunction->findById( $_GET['id'] );
         $dbFunction->close();
         print( "<input type='hidden' name='raceId' value='" . $race->raceId ."' />" );
      }
   ?>
  
   <table>
      <?php print( CommonPageFunction::getInputField( "name", $race, "Name") ) ?>
      <?php print( CommonPageFunction::getInputField( "raceDate", $race, "Date") ) ?>
      <?php print( CommonPageFunction::getCombobox( "status", $race, "Status", array("prepare", "running", "finished")) ) ?>
   </table>
   
