<?php

   class LoginDbFunction extends AbstractDbFunction implements ListDbFunction {

      public function LoginDbFunction() {
         $this->AbstractDbFunction();
      }


      public function findAll( $unused ) {
         
         $query = "select u.userId, u.user, u.role, r.name as raceName from User u left outer join Race r on u.raceFk = r.raceId";
         $result = $this->query($query, null );
         
         $users = array();
         for ( $i = 0; $i < $result->num_rows; $i++ ) {
            $users[] = $result->fetch_object();
         }
         return $users;
      }
         
      public function findById( $userId ) {
         
         $query = "select * from User where userId = ?";
         $result = $this->query($query, array( new Parameter( Parameter::INTEGER, $userId ) ) );
         if ( $result->num_rows == 1 ) {
            return $result->fetch_object();
         } else if ( $result->num_rows > 1) {
            throw new Exception("More than one User ($userId) in Db!");
         } else {
            return null;
         }
      }

      public function findUser( $userName ) {
         
         $query = "select * from User where user = ?";
         $result = $this->query($query, array( new Parameter( Parameter::STRING, $userName ) ) );
         if ( $result->num_rows == 1 ) {
            return $result->fetch_object();
         } else if ( $result->num_rows > 1) {
            throw new Exception("More than one User ($username) in Db!");
         } else {
            return null;
         }
      }

      public function insert( $user ) {
         $query = "insert into User (user, password, role, raceFk ) values (?, ?, ?, ?)";
         $parameter = array( 
            new Parameter( Parameter::STRING, $user['user'] ), 
            new Parameter( Parameter::STRING, hash ( "sha256" , $user['password']) ),
            new Parameter( Parameter::STRING, $user['role'] ),
            new Parameter( Parameter::INTEGER, $user['raceFk'] )
         );
         $this->query($query, $parameter);
      }

      public function update( $user ) {
         $query = "update User set user = ?, role = ?, raceFk = ? where userId = ?";
         $parameter = array( 
            new Parameter( Parameter::STRING, $user['user'] ), 
            new Parameter( Parameter::STRING, $user['role'] ),
            new Parameter( Parameter::INTEGER, $user['raceFk'] ),
            new Parameter( Parameter::INTEGER, $user['userId'] )
         );
         $this->query($query, $parameter);
      }

      public function insertSession( $user ) {
         
         $sessionId = $this->generateSessionId();
         $query = "insert into Session ( sessionId, userFk, loginTime, lastActive) values ( ?, ?, now(), now() )";
         $this->query($query, array( new Parameter( Parameter::STRING, $sessionId ), new Parameter( Parameter::INTEGER, $user->userId ) ) );
         setcookie("sessionId", $sessionId, time()+3600); 
         return $sessionId;
      }
      
      private function generateSessionId() {
      
         $sessionId = "";
         for ( $i = 0; $i < 42; $i++ ) {
            $char = mt_rand( 0, 61 );
            if ( $char < 10 ) {
               $sessionId .= chr( $char + 48 );
            } else if ( $char < 36) {
               $sessionId .= chr( $char + 55 );
            } else {
               $sessionId .= chr( $char + 61 );
            }
         }
         return $sessionId;
      }

   }

?>
