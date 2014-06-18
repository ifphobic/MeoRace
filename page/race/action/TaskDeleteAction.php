<?php

   class TaskDeleteAction implements Action {

      public function commit( $content ) {
         $dbFunction = new TaskDbFunction ();
         $dbFunction->delete( $content['taskId'] );
         $dbFunction->close();
         return new NextPage( "race", "taskList", array( "id" => $content['raceId'] ) );
      }
   
   }


