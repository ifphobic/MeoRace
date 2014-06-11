<?php

   include("core/include.php");

   $role = Role::NO_ROLE;
   $commonDbFunction = new CommonDbFunction();
   if ( isset($_COOKIE['sessionId'] ) ) {
      if ( !isset ( $_GET['logout'] ) ) {
         $user = $commonDbFunction->determineCurrentUser();
         if ( isset( $user ) ) {
            $role = $user->role;
            $GLOBALS['MeoRace']['user'] = $user;
         }
      } else {
         $commonDbFunction->logOut( $_COOKIE['sessionId'] );
      }
   }

   
   if ( isset( $_GET['module'] ) ) {
      $moduleName = $_GET['module'];
      if ( isset( $_GET['page'] ) ) {
         $pageName = $_GET['page'];
      }
   } 
   
   $commonDbFunction->close();
   
   $modules = ModuleReader::readAllLinks( $role );

   if ( !isset( $moduleName ) || ! array_key_exists($moduleName, $modules ) ) {
      $moduleName = array_keys( $modules );
      $moduleName = $moduleName[0];
      unset( $pageName );
   }

   if ( !isset( $pageName ) ) {
      $pageName = array_keys( $modules[ $moduleName ] );
      $pageName = $pageName[0];
   }

   $page = $modules[ $moduleName ][ $pageName ];


   Page::printHeader( $page );
   Page::printNavigation($modules);

   Page::printContent( $moduleName, $page );

   Page::printFooter();



?>
