
   <?php
      $racer = null;
      $dbFunction = new RacerDbFunction();
      if ( isset( $_GET['id'] ) ) {
         $racer = $dbFunction->findById( $_GET['id'] );
         print( "<input type='hidden' name='racerId' value='" . $racer->racerId ."' />" );
         $raceId = $racer->raceFk;
      } else {
         print( "<input type='hidden' name='raceFk' value='" . $GLOBALS['MeoRace']['user']->raceFk  ."' />" );
         $raceId = $GLOBALS['MeoRace']['user']->raceFk;
      }
      $freeRaceNumbers = $dbFunction->getFreeRaceNumbers( $raceId, $racer );
      $dbFunction->close();
   ?>
  
   <table>
      <?php print( CommonPageFunction::getCombobox("racerNumber", $racer, "Number", $freeRaceNumbers ) ) ?>
      <?php print( CommonPageFunction::getInputField("name", $racer, "Name") ) ?>
      <?php print( CommonPageFunction::getInputField("city", $racer, "City") ) ?>
      <?php print( CommonPageFunction::getInputField("country", $racer, "Country") ) ?>
      <?php print( CommonPageFunction::getInputField("email", $racer, "Mail") ) ?>
      <?php print( CommonPageFunction::getCombobox("status", $racer, "Status", array( "registered", "active" )) ) ?>
   </table>
   
