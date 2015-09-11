<?php

   class UserEditAction extends AbstractEditAction implements Action {

      public function commit( $content ) {
         $user = CommonDbFunction::getUser();
         if ( $content['checkpointFk'] == "" || $user->raceFk != $content['raceFk'] ) {
            $content['checkpointFk'] = null;
         }
         if ( $content['raceFk'] == "" ) {
            $content['raceFk'] = null;
         }
         $result = $this->genericCommit("user", "user", "userEdit", $content);

         $resultContent = $result->getContent();
         if (  $user->raceFk != $content['raceFk'] && $user->userId == $resultContent['userId']  ) {
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
