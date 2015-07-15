
   <?php
      $user = null;
      if ( isset( $_GET['id'] ) ) {
         $userFunction = new UserDbFunction();
         $user = $userFunction->findById( $_GET['id'] );
         $userFunction->close();
         print( "<input type='hidden' name='userId' value='" . $user->userId ."' />" );
      }
      $currentUser = CommonDbFunction::getUser(); 
      $dbFunktion = new RaceDbFunction();
      $races = $dbFunktion->findAll( $currentUser->userId );
      $dbFunktion->close();
         
      $dbFunktion = new CheckpointDbFunction();
      $checkpoints = $dbFunktion->findAll( $currentUser->raceFk );
      $dbFunktion->close();
   ?>
  
   <table>
      <?php print( CommonPageFunction::getInputField("user", $user, "User") ) ?>
      <?php 
         if ( !isset( $_GET['id'] ) ) { ?>
            <tr><td>Passwort:</td><td><input name="password" type="password" /></td></tr>
      <?php 
         }
         if ($user == null || CommonDbFunction::getUser()->userId != $_GET['id'] ) {
            print( CommonPageFunction::getCombobox("role", $user, "Role", Role::getAllRoles( Role::isAdmin( $currentUser ) ) ) );
         } else {
            print( "<input type='hidden' name='role' value='" . $user->role ."' />" );
         }
         print( CommonPageFunction::getCombobox("raceFk", $user, "Race", $races, "raceId", Role::isAdmin( $currentUser ) ) );
         print( CommonPageFunction::getCombobox("checkpointFk", $user, "Checkpoint",  $checkpoints, "checkpointId", true ) );
      
      ?>
   </table>
   
