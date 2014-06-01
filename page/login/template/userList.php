<table>
   <th>User</th>
   <th>Role</th>
   <th>Race</th>
   <th>Edit</th>
   <?php
   
      $loginFunction = new LoginDbFunction();
      $users = $loginFunction->findAll( null );
      $loginFunction->close();

      foreach ( $users as $user ) {
      print ("
         <tr>
            <td>" . $user->user . "</td>
            <td>" . $user->role . "</td>
            <td>" . $user->raceName . "</td>
            <td>" . CommonPageFunction::getLink("login", "userEdit", $user->userId, "edit") . "</td>
         </tr>
      ");
      }

   ?>
<table>

<?php print( CommonPageFunction::getLink("login", "userEdit", null, "New User" ) );
 
