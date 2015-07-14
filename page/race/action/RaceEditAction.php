<?php

   class RaceEditAction extends AbstractEditAction implements Action {

      public function commit( $content ) {
         if ( isset( $content['raceId'] ) && $content['status'] == "finished" ) {
            $dbFunction = new RacerTaskDbFunction();
            $dbFunction->stopAllNegativePriced( $content['raceId'] );
            $dbFunction->close();
         }
         return $this->genericCommit("race", "race", "raceEdit", $content);
      }
   
   }

?>
