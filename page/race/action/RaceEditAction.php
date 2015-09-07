<?php

   class RaceEditAction extends AbstractEditAction implements Action {

      public function commit( $content ) {
         if ( isset( $content['raceId'] ) && $content['status'] == "finished" ) {
            $dbFunction = new RacerTaskDbFunction();
            $dbFunction->stopAllNegativePriced( $content['raceId'] );
            $dbFunction->close();
         }
         
         if ( $content['raceDate'] == "" ) {
            $content['raceDate'] = null;
         }

         $result = $this->genericCommit("race", "race", "raceEdit", $content);
         if ( !isset( $content['raceId'] ) ) {
            $userId = CommonDbFunction::getUser()->userId;
            $raceId = $result->getContent()['raceId'];
            
            $dbFunction = new RaceDbFunction();
            $dbFunction->insertUserRace( $userId, $raceId );
            $dbFunction->close();
            
            $dbFunction = new UserDbFunction();
            $dbFunction->updateRace( $userId, $raceId );
            $dbFunction->close();

            $parameter = $result->getParameter();
            $dbFunction = new CommonDbFunction();
            $parameter['newRace'] = rawurlencode( $dbFunction->determineCurrentUser()->raceName );
            $dbFunction->close();
            $result->setParameter( $parameter );
         }
         return $result;
      }
   
   }

?>
