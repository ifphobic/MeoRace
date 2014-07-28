<?php

   $racerId = $_GET['id'];
   $taskId = $_GET['taskId'];

   $dbFunction = new TaskDbFunction();
   $task = $dbFunction->findById( $taskId );
   $dbFunction->close();
   $dbFunction = new RacerDbFunction();
   $racer = $dbFunction->findById( $racerId );
   $dbFunction->close();


   print( "Assign Task " . $task->name . "<br>to Racer " . $racer->racerNumber . " " . $racer->name );
   print( "<input type='hidden' name='taskId' value='$taskId' />" );
   print( "<input type='hidden' name='racerId' value='$racerId' />" );
?>
