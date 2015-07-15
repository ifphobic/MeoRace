<table>
   <th>Name</th>
   <th>Status</th>
   <th>Edit</th>
   <?php
      $user = CommonDbFunction::getUser();
      $dbFunction = new RaceDbFunction();
      $races = $dbFunction->findAll( $user->userId );
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

<?php 
 if ( $user->role == Role::RACE_MASTER ) {
   print( CommonPageFunction::getLink( "race", "raceEdit", null, "New Race" ) );
 }

?>
