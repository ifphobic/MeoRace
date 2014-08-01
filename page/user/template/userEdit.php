
   <?php
      $user = null;
      if ( isset( $_GET['id'] ) ) {
         $userFunction = new UserDbFunction();
         $user = $userFunction->findById( $_GET['id'] );
         $userFunction->close();
         print( "<input type='hidden' name='userId' value='" . $user->userId ."' />" );
      }
      $dbFunktion = new RaceDbFunction();
      $races = $dbFunktion->findAll( null );
      $dbFunktion->close();
         
      $currentUser = CommonDbFunction::getUser(); 
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
         if ( Role::isAdmin( $currentUser ) ) {
            print( CommonPageFunction::getCombobox("role", $user, "Role", Role::getAllRoles( true ) ) );
            print( CommonPageFunction::getCombobox("raceFk", $user, "Race", $races, "raceId") );
         } else {
            print( CommonPageFunction::getCombobox("role", $user, "Role", Role::getAllRoles( false ) ) );
            print( "<input type='hidden' name='raceFk' value='" . $currentUser->raceFk . "' />");
         }
         print( CommonPageFunction::getCombobox("checkpointFk", $user, "Checkpoint",  $checkpoints, "checkpointId", true ) );
      
      ?>
   </table>
   
