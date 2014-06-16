
<table>
   <th>Name</th>
   <th>Manned</th>
   <th>Edit</th>
   <?php
      
      $dbFunction = new CheckpointDbFunction();
      $checkpoints = $dbFunction->findAll( CommonDbFunction::getUser()->raceFk );
      $dbFunction->close();

      foreach ( $checkpoints as $checkpoint ) {
      print ("
         <tr>
            <td>" . $checkpoint->name . "</td>
            <td>" . ( $checkpoint->manned ? "X" : "-" ). "</td>
            <td>" . CommonPageFunction::getLink("checkpoint", "checkpointEdit", $checkpoint->checkpointId, "edit") . "</td>
         </tr>
      ");
      }

   ?>
<table>

<?php print( CommonPageFunction::getLink("checkpoint", "checkpointEdit", null, "New Checkpoint" ) );
 
