
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
   ?>
  
   <table>
      <?php print( CommonPageFunction::getInputField("user", $user, "User") ) ?>
      <?php 
         if ( !isset( $_GET['id'] ) ) { ?>
            <tr><td>Passwort:</td><td><input name="password" type="password" /></td></tr>
      <?php 
         }
         
         if ( Role::isAdmin( $GLOBALS['MeoRace']['user'] ) ) {
            print( CommonPageFunction::getCombobox("role", $user, "Role", Role::getAllRoles( true ) ) );
            print( CommonPageFunction::getCombobox("raceFk", $user, "RaceId", $races, "raceId") );
         } else {
            print( CommonPageFunction::getCombobox("role", $user, "Role", Role::getAllRoles( false ) ) );
            print( "<input type='hidden' name='raceFk' value='" . $GLOBALS['MeoRace']['user']->raceFk . "' />");
         }
      
      ?>
   </table>
   
