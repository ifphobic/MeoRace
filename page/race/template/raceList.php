<table>
   <th>Name</th>
   <th>Status</th>
   <th>Edit</th>
   <?php
   
      $dbFunction = new RaceDbFunction();
      $races = $dbFunction->findAll( null );
      $dbFunction->close();

      foreach ( $races as $race ) {
      print ("
         <tr>
            <td>" . $race->name . "</td>
            <td>" . $race->status . "</td>
            <td>" . CommonPageFunction::getLink( "race", "raceEdit", $race->raceId, "edit") . "</td>
         </tr>
      ");
      }

   ?>
<table>

<?php print( CommonPageFunction::getLink( "race", "raceEdit", null, "New Race" ) );
 
