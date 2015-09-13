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
         $query = "select  u.userId, u.user, u.role, COALESCE(u.raceFk, s.raceFk) as raceFk, u.checkpointFk, COALESCE(ru.name, rs.name) as raceName ";
         $query .= "from User u join Session s on u.userId = s.userFk ";
         $query .= "left outer join Race ru on u.raceFk = ru.raceId ";
         $query .= "left outer join Race rs on s.raceFk = rs.raceId ";
         $query .= "where sessionId = ?";
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

      public static function userIsNoRole() {
         return CommonDbFunction::$currentUser != null && CommonDbFunction::$currentUser->role == Role::NO_ROLE;
      }
  }


?>
