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

      foreach ( $races as $race ) { ?>
            <li class="jb_listitem" onclick="location.href='login.php?raceId=<?php echo $race->raceId; ?>'">
              <div class="race_icon item-<?php echo $race->raceId; ?>">
              <span class="date month">August</span>
              <span class="date day">25</span>
              <span class="date year">2014</span>
              </div>

              <div class="list_content">
               <span class="list_title"><?php echo $race->name; ?></span>
               <span class="list_subtitle"><?php echo $race->status; ?></span>
              </div>

      <?php
         if ( $user != null && ( $user->role == Role::RACE_MASTER || $user->role == Role::ADMIN ) ) {
            print (" <div class='race_edit'>" . CommonPageFunction::getLink( "race", "raceEdit", $race->raceId, "edit") . "</div>");
         }
         print ("</li> ");
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
