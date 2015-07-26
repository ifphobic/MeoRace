<?php
   
   include( "core/include.php" );

   $moduleName = $_POST['module'];
   $pageName = $_POST['page'];
   $GLOBALS['MeoRace']['tabIndex'] = $_POST['index'] - 1;
   $GLOBALS['MeoRace']['content'] = $_POST;

   $role = Role::NO_ROLE;
   if ( isset( $_COOKIE['sessionId'] ) ) {
      $commonDbFunction = new CommonDbFunction();
      $role = $commonDbFunction->determineCurrentUser()->role;
      $commonDbFunction->close();
   }

   $modules = ModuleReader::readAllModules( $role );
//   error_log("module: " . $moduleName . ", page: " . $pageName);
   $page = $modules[ $moduleName ][ $pageName ];
   if ( ! in_array( $role, $page->getRolesCommit() ) ) {
      throw new Exception( "No permission for commit ");
   }


   $className = ucfirst( $pageName ) . "Action";
   include( Configuration::MODULE_FOLDER . $moduleName . "/action/" . $className . ".php" );
   Page::includeDependency( $moduleName, $page );

   $action = new $className;
   $nextPage = $action->commit( $_POST );
   
   ob_clean();
   if ( $nextPage != null ) {
      $page = $modules[ $nextPage->getModule() ][ $nextPage->getPage() ];
   
      $GLOBALS['MeoRace']['content'] = $nextPage->getParameter();
      //Page::printContent( $nextPage->getModule(), $page);

      $parameter = "module=" . $nextPage->getModule();
      $parameter .= "&page=" . $nextPage->getPage();
      foreach ( $nextPage->getParameter() as $key => $value ) {
         $parameter .= "&" . $key . "=" . $value;
      }
   
      print( $parameter );
   };
?>
