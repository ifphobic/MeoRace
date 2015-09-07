<ul>
   <?php

      $dbFunction = new UserDbFunction();
      $raceFk = null;
      $currentUser = CommonDbFunction::getUser();
      if ( !Role::isAdmin( $currentUser ) ) {
         $raceFk = $currentUser->raceFk;
      }
      $users = $dbFunction->findAll( $raceFk );
      $dbFunction->close();

      foreach ( $users as $user ) {
        $onClick = Page::getOnClickFunction( "user", "userEdit", $user->userId);
      print ("
         <li class='jb_listitem' onclick='$onClick'>
         <div class='list_content'>
         <span class='list_title'>$user->user</span>
         <span class='list_subtitle'>$user->role"
       );
        if($user->checkpoint != null){
          print (" (" . $user->checkpoint . ") ");
        }
      print ("@" . $user->raceName . "</span>
        </li>
      ");
      }

   ?>
</ul>
<div class="new_button" onclick='<?php print(Page::getOnClickFunction( "user", "userEdit", null)); ?>'>
  New User
</div>
