<?php

   class TaskEditAction extends AbstractEditAction implements Action {

      public function commit( $content ) {
         return $this->genericCommit("race", "task", "taskList", $content, "task");
      }
   
   }

?>
