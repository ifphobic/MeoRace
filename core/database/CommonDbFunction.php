<?php


   class CommonDbFunction extends AbstractDbFunction {
     
      private static $currentUser;

      public function CommonDbFunction() {
         $this->AbstractDbFunction();
      }


      public function determineCurrentUser() {
         if ( !isset( $_COOKIE['sessionId'] ) ) {
            return null;
         }
         $query = "select  u.userId, u.user, u.role, u.raceFk, u.checkpointFk, r.name as raceName from User u join Session s on u.userId = s.userFk left outer join Race r on u.raceFk = r.raceId where sessionId = ?";
         $result = $this->queryArray($query, array( new Parameter( PDO::PARAM_STR, $_COOKIE['sessionId']  ) ) );
         if ( count( $result ) == 0 ) {
            return null;
         }
         CommonDbFunction::$currentUser = $result[0];
         return CommonDbFunction::$currentUser;
      }


      public static function getUser() {
         return CommonDbFunction::$currentUser;
      }

      public function logout( $sessionId ) {
         $query = "delete from Session where sessionId = ?";
         $this->query($query, array( new Parameter( PDO::PARAM_STR, $sessionId ) ) );
         setcookie ("sessionId", "", time() - 3600);
      }

      public static function userHasRace() {
         return CommonDbFunction::$currentUser != null && CommonDbFunction::$currentUser->raceFk != null;
      }
      
      public static function userHasCheckpoint() {
         return CommonDbFunction::$currentUser != null && CommonDbFunction::$currentUser->checkpointFk != null;
      }
  }
      

?>
