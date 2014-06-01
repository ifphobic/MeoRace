<table>
   <th>Name</th>
   <th>Description</th>
   <th>Edit</th>
   <?php
      
      $dbFunction = new ParcelDbFunction();
      $parcels = $dbFunction->findAll( $GLOBALS['MeoRace']['user']->raceFk );
      $dbFunction->close();

      foreach ( $parcels as $parcel ) {
      print ("
         <tr>
            <td>" . $parcel->name . "</td>
            <td>" . $parcel->description. "</td>
            <td>" . CommonPageFunction::getLink("parcel", "parcelEdit", $parcel->parcelId, "edit") . "</td>
         </tr>
      ");
      }

   ?>
<table>

<?php print( CommonPageFunction::getLink("parcel", "parcelEdit", null, "New Parcel" ) );
 
