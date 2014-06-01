<?php

   $dbFunction = new RaceDbFunction();
   $race = $dbFunction->findById( $GLOBALS['MeoRace']['user']->raceFk );
   $dbFunction->close();
   print( "<b>Race: " . $race->name . "</b> (" . CommonPageFunction::getLink("race", "raceEdit", $GLOBALS['MeoRace']['user']->raceFk, "edit" ) . ")<br>" );
   print( "Status: " . $race->status . "<br><br>" );
   
   $dbFunction = new TaskDbFunction();
   $tasks = $dbFunction->findAll( $GLOBALS['MeoRace']['user']->raceFk );
   $dbFunction->close();
?>                     

<table>
   <th>Name</th>
   <th>MaxDuration</th>
   <th>Price</th>
   <th>Description</th>

<?php
   foreach ( $tasks as $task ) {
      print("
         <tr>
            <td>" . $task->name . "</td>
            <td>" . $task->maxDuration. "</td>
            <td>" . $task->currentPrice . "</td>
            <td>" . $task->description. "</td>
            <td>" . CommonPageFunction::getLink("race", "taskEdit", $task->taskId, "edit") . "</td>
         </tr>
      ");
   }
?>   


</table>

<?php print( CommonPageFunction::getLink("race", "taskEdit", null, "New Task" ) );
 
