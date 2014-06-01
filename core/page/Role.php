<?php

   class Role {
      

      const NO_ROLE = "NO_ROLE";
      const ADMIN = "admin";
      const RACE_MASTER = "race master";
      const REGISTRATION = "registration";
       
      public static function getAllRoles( ) {
         return array( self::ADMIN, self::RACE_MASTER, self::REGISTRATION );
      }

   }

?>
