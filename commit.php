<?php
   
   include( "core/include.php" );

   $moduleName = $_POST['module'];
   $pageName = $_POST['page'];
   $GLOBALS['MeoRace']['tabIndex'] = $_POST['index'] - 1;

   $role = Role::NO_ROLE;
   if ( isset( $_COOKIE['sessionId'] ) ) {
      $commonDbFunction = new CommonDbFunction();
      $role = $commonDbFunction->determineCurrentUser()->role;
      $commonDbFunction->close();
   }

   $modules = ModuleReader::readAllModules( $role );
   //print("module: " . $moduleName . ", page: " . $pageName);
   $page = $modules[ $moduleName ][ $pageName ];
   if ( ! in_array( $role, $page->getRolesCommit() ) ) {
      throw new Exception( "No permission for commit ");
   }


   $className = ucfirst( $pageName ) . "Action";
   include( Configuration::MODULE_FOLDER . $moduleName . "/action/" . $className . ".php" );
   Page::includeDependency( $moduleName, $page );

   $action = new $className;
   $nextPage = $action->commit( $_POST );
   $page = $modules[ $nextPage->getModule() ][ $nextPage->getPage() ];

   Page::printContent( $nextPage->getModule(), $page);

?>
