<?php
   $user = CommonDbFunction::getUser();
   $userId = null;
   if ( $user != null ) {
      $userId = $user->userId;
   }
   $dbFunction = new RaceDbFunction();
   
   $races = $dbFunction->findAll( $userId );
   $dbFunction->close();

   if ( $user == null ) {
      Page::printFormStart("race", "raceChoose");
   }
?>
<table>
   <th>Name</th>
   <th>Status</th>
   <th> </th>
<?php
      foreach ( $races as $race ) {
         print ("
            <tr>
               <td>" . $race->name . "</td>
               <td>" . $race->status . "</td>
         ");
         if ( $user != null && ( $user->role == Role::RACE_MASTER || $user->role == Role::ADMIN ) ) {
            print (" <td>" . CommonPageFunction::getLink( "race", "raceEdit", $race->raceId, "edit") . "</td>");
         } else {
            print (" <td><a href='login.php?raceId=" . $race->raceId. "'>choose</a></td>");
         }
         print (" </tr> ");
      }
      

   ?>
<table>

<?php 

 if ( $user != null && ( $user->role == Role::RACE_MASTER || $user->role == Role::ADMIN ) ) {
   print( CommonPageFunction::getLink( "race", "raceEdit", null, "New Race" ) );
 } else {
   print("</form>");
 }

?>
