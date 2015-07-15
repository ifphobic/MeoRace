<?php

   class UserDbFunction extends AbstractDbFunction implements ListDbFunction {

      public function UserDbFunction() {
         $this->AbstractDbFunction();
      }


      public function findAll( $raceId ) {
         
         $query  = "select u.userId, u.user, u.role, u.checkpointFk, r.name as raceName, c.name as checkpoint ";
         $query .= "from User u ";
         $query .= "left outer join Race r on u.raceFk = r.raceId ";
         $query .= "left outer join Checkpoint c on u.checkpointFk = c.checkpointId ";
         $parameter = array();
         if ( isset( $raceId ) ) {
            $query .= " where u.raceFk = ? and u.role <> 'admin' ";
            $parameter[] = new Parameter( PDO::PARAM_INT, $raceId );
         }
         $result = $this->queryArray($query, $parameter );
         return $result;
      }
         
      public function findById( $userId ) {
         
         $query = "select * from User where userId = ?";
         $result = $this->queryArray( $query, array( new Parameter( PDO::PARAM_INT, $userId ) ) );
         return $result[0];
      }

      public function findUser( $userName ) {
         
         $query = "select u.* from User u left outer join Checkpoint c on u.checkpointFk = c.checkpointId  where user = ?";
         $result = $this->queryArray($query, array( new Parameter( PDO::PARAM_STR, $userName ) ) );
         if ( count( $result ) > 0 ) {
            return $result[0];
         }
         return null;
      }

      public function insert( $user ) {
         $query = "insert into User (user, password, role, raceFk, checkpointFk ) values (?, ?, ?, ?, ?)";
         $parameter = array( 
            new Parameter( PDO::PARAM_STR, $user['user'] ), 
            new Parameter( PDO::PARAM_STR, hash ( "sha256" , $user['password']) ),
            new Parameter( PDO::PARAM_STR, $user['role'] ),
            new Parameter( PDO::PARAM_INT, $user['raceFk'] ),
            new Parameter( PDO::PARAM_INT, $user['checkpointFk'] )
         );
         $this->query($query, $parameter);
      }

      public function update( $user ) {
         $query = "update User set user = ?, role = ?, raceFk = ?, checkpointFk = ? where userId = ?";
         $parameter = array( 
            new Parameter( PDO::PARAM_STR, $user['user'] ), 
            new Parameter( PDO::PARAM_STR, $user['role'] ),
            new Parameter( PDO::PARAM_INT, $user['raceFk'] ),
            new Parameter( PDO::PARAM_INT, $user['checkpointFk'] ),
            new Parameter( PDO::PARAM_INT, $user['userId'] )
         );
         $this->query($query, $parameter);
      }

      public function updateRace( $userId, $raceId ) {
         $query = "update User set raceFk = ? where userId = ?";
         $parameter = array( 
            new Parameter( PDO::PARAM_INT, $raceId ),
            new Parameter( PDO::PARAM_INT, $userId )
         );
         $this->query($query, $parameter);
      }

      public function insertSession( $user ) {
         
         $sessionId = $this->generateSessionId();
         $query = "insert into Session ( sessionId, userFk, loginTime, lastActive) values ( ?, ?, now(), now() )";
         $this->query($query, array( new Parameter( PDO::PARAM_STR, $sessionId ), new Parameter( PDO::PARAM_INT, $user->userId ) ) );
         setcookie("sessionId", $sessionId, time() + 36000); 
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
