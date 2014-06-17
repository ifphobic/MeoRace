<table>
   <th>Number</th>
   <th>Name</th>
   <th>City</th>
   <th>Country</th>
   <th>Mail</th>
   <th>Status</th>
   <th>Edit</th>
   <?php
   
      $dbFunction = new RacerDbFunction();
      $racers = $dbFunction->findAll( CommonDbFunction::getUser()->raceFk );
      $dbFunction->close();

      foreach ( $racers as $racer ) {
      print ("
         <tr>
            <td>" . $racer->racerNumber . "</td>
            <td>" . $racer->name . "</td>
            <td>" . $racer->city . "</td>
            <td>" . $racer->country . "</td>
            <td>" . $racer->email . "</td>
            <td>" . $racer->status . "</td>
            <td>" . CommonPageFunction::getLink( "racer", "racerEdit", $racer->racerId, "edit") . "</td>
         </tr>
      ");
      }

   ?>
<table>

<?php print( CommonPageFunction::getLink( "racer", "racerEdit", null, "New Racer" ) );
 
