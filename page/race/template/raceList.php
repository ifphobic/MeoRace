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
      if ( $user != null && ( $user->role == Role::RACE_MASTER || $user->role == Role::ADMIN ) ) {
         $onClick = Page::getOnClickFunction( "race", "raceEdit", $race->raceId );
      } else {
         $onClick = 'location.href="login.php?raceId=' . $race->raceId .'"';
      }

      $day = "";
      $month = "";
      $year = "";
      if ($race->raceDate != null ) {
         $date = strtotime($race->raceDate);
         $day = date('d', $date);
         $month = date('F', $date);
         $year = date('Y', $date);
      }


      print("
         <li class='jb_listitem' onclick='$onClick'>

         <div class='race_icon item-$race->raceId'>
           <span class='date month'>$month</span>
           <span class='date day'>$day</span>
           <span class='date year'>$year</span>
         </div>

         <div class='list_content'>
           <span class='list_title'>$race->name</span>
           <span class='list_subtitle'>$race->status</span>
           <span class='list_navigation'></span>
         </div>

         </li>
      ");
   }

   ?>

</ul>

<?php

 if ( $user != null && ( $user->role == Role::RACE_MASTER || $user->role == Role::ADMIN ) ) {
   $onClick = Page::getOnClickFunction( "race", "raceEdit", null);
   print ("<div class='new_button' onclick='$onClick'>New Race</div>");
 } else {
   print("</form>");
 }

?>
