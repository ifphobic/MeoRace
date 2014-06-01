
   <?php
      $user = null;
      if ( isset( $_GET['id'] ) ) {
         $loginFunction = new LoginDbFunction();
         $user = $loginFunction->findById( $_GET['id'] );
         $loginFunction->close();
         print( "<input type='hidden' name='userId' value='" . $user->userId ."' />" );
      }
      $dbFunktion = new RaceDbFunction();
      $races = $dbFunktion->findAll( null );
      $dbFunktion->close();
   ?>
  
   <table>
      <?php print( CommonPageFunction::getInputField("user", $user, "User") ) ?>
      <?php if ( !isset( $_GET['id'] ) ) { ?>
      <tr><td>Passwort:</td><td><input name="password" type="password" /></td></tr>
      <?php } ?>
      <?php print( CommonPageFunction::getCombobox("role", $user, "Role", Role::getAllRoles() )) ?>
      <?php print( CommonPageFunction::getCombobox("raceFk", $user, "RaceId", $races, "raceId") ) ?>
      </tr>
   </table>
   
