
   <?php
      $task = null;
      if ( isset( $_GET['id'] ) ) {
         $dbFunction = new TaskDbFunction();
         $task = $dbFunction->findById( $_GET['id'] );
         $dbFunction->close();
         print( "<input type='hidden' name='taskId' value='" . $task->taskId ."' />" );
      } else {
         print( "<input type='hidden' name='raceFk' value='" . CommonDbFunction::getUser()->raceFk  ."' />" );
      }

      $currentUser = CommonDbFunction::getUser();
      $dbFunktion = new CheckpointDbFunction();
      $checkpoints = $dbFunktion->findAll( $currentUser->raceFk );
      $dbFunktion->close();
       
   ?>
  
   <table>
      <?php print( CommonPageFunction::getInputField( "name", $task, "Name") ) ?>
      <?php print( CommonPageFunction::getInputField( "maxDuration", $task, "Max. Duration") ) ?>
      <?php print( CommonPageFunction::getInputField( "price", $task, "Price") ) ?>
      <?php print( CommonPageFunction::getInputField( "description", $task, "Description") ) ?>
      <?php print( CommonPageFunction::getCombobox("dispatchCheckpointFk", $task, "Checkpoint", $checkpoints, "checkpointId", true) ) ?>
      <?php print( CommonPageFunction::getCheckbox("fixPrice", $task, "Fix Price") ) ?>
   </table>
   
