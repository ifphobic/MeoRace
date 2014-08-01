<?php

   class Role {
      

      const NO_ROLE = "NO_ROLE";
      const ADMIN = "admin";
      const RACE_MASTER = "race master";
      const REGISTRATION = "registration";
      const DISPATCHER = "dispatcher";
      const CHECKPOINT = "checkpoint";
      
      private static $ALL_ROLES = array( self::ADMIN, self::RACE_MASTER, self::REGISTRATION, self::CHECKPOINT, self::NO_ROLE, self::DISPATCHER );
      private static $ALL_ROLES_WITHOUT_ADMIN = array( self::RACE_MASTER, self::REGISTRATION, self::DISPATCHER, self::CHECKPOINT );

       
      public static function getAllRoles( $includeAdmin ) {
         if ( $includeAdmin ) {
            return Role::$ALL_ROLES;
         } else {
            return Role::$ALL_ROLES_WITHOUT_ADMIN;
         }
      }

      public static function isAdmin( $user ) {
         return !isset( $user ) || strcmp( $user->role, Role::ADMIN) == 0;
      }

   }

?>
