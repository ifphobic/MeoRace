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
<ul>
<?php
      foreach ( $races as $race ) {
         print ("
            <li class='jb_listitem'>
              <div class='race_icon'>
              <span class='date month'>August</span>
              <span class='date day'>25</span>
              <span class='date year'>2014</span></div>
               <div class='list_content'>
               <span class='list_title'>" . $race->name . "</span>
               <span class='list_subtitle'>" . $race->status . "</span>
               </div>
         ");
         if ( $user != null && ( $user->role == Role::RACE_MASTER || $user->role == Role::ADMIN ) ) {
            print (" <td>" . CommonPageFunction::getLink( "race", "raceEdit", $race->raceId, "edit") . "</td>");
         } else {
            print (" <td><a href='login.php?raceId=" . $race->raceId. "'>choose</a></td>");
         }
         print (" </li> ");
      }


   ?>
<ul>

<?php

 if ( $user != null && ( $user->role == Role::RACE_MASTER || $user->role == Role::ADMIN ) ) {
   print( CommonPageFunction::getLink( "race", "raceEdit", null, "New Race" ) );
 } else {
   print("</form>");
 }

?>
