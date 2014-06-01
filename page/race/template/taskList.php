<?php

   $dbFunction = new RaceDbFunction();
   $race = $dbFunction->findById( $GLOBALS['MeoRace']['user']->raceFk );
   $dbFunction->close();
   print( "<b>Race: " . $race->name . "</b> (" . CommonPageFunction::getLink("race", "raceEdit", $GLOBALS['MeoRace']['user']->raceFk, "edit" ) . ")<br>" );
   print( "Status: " . $race->status . "<br><br>" );
?>                     


<?php print( CommonPageFunction::getLink("racer", "racerEdit", null, "New Racer" ) );
 
