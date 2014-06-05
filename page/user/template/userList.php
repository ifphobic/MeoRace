<table>
   <th>User</th>
   <th>Role</th>
   <th>Race</th>
   <th>Edit</th>
   <?php
   
      $dbFunction = new UserDbFunction();
      $raceFk = null;
      if ( !Role::isAdmin( $GLOBALS['MeoRace']['user'] ) ) {
         $raceFk = $GLOBALS['MeoRace']['user']->raceFk;
      }
      $users = $dbFunction->findAll( $raceFk );
      $dbFunction->close();

      foreach ( $users as $user ) {
      print ("
         <tr>
            <td>" . $user->user . "</td>
            <td>" . $user->role . "</td>
            <td>" . $user->raceName . "</td>
            <td>" . CommonPageFunction::getLink("user", "userEdit", $user->userId, "edit") . "</td>
         </tr>
      ");
      }

   ?>
<table>

<?php print( CommonPageFunction::getLink("user", "userEdit", null, "New User" ) );
 