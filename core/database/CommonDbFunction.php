<?php


   class CommonDbFunction extends AbstractDbFunction {
     
      private static $currentUser;

      public function CommonDbFunction() {
         $this->AbstractDbFunction();
      }


      public function determineCurrentUser() {

         $query = "select  u.user, u.role, u.raceFk, r.name as raceName from User u join Session s on u.userId = s.userFk left outer join Race r on u.raceFk = r.raceId where sessionId = ?";
         $result = $this->query($query, array( new Parameter( Parameter::STRING, $_COOKIE['sessionId']  ) ) );
         if ( $result->num_rows == 1 ) {
            CommonDbFunction::$currentUser = $result->fetch_object();
            return CommonDbFunction::$currentUser;
         } 
         return null;
      }


      public static function getUser() {
         return CommonDbFunction::$currentUser;
      }

      public function logout( $sessionId ) {
         $query = "select *  from Session";// where sessionId = ?";
         $this->query($query, null );
         //$this->query($query, array( new Parameter( Parameter::STRING, $sessionId ) ) );
         setcookie ("sessionId", "", time() - 3600);
      }

  }
      

?>
