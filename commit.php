<?php
   
   include( "core/include.php" );

   $moduleName = $_POST['module'];
   $pageName = $_POST['page'];

   $role = Role::NO_ROLE;
   if ( isset( $_COOKIE['sessionId'] ) ) {
      $commonDbFunction = new CommonDbFunction();
      $role = $commonDbFunction->determineCurrentUser()->role;
      $commonDbFunction->close();
   }

   $modules = ModuleReader::readAllLinks( $role );
   $page = $modules[ $moduleName ][ $pageName ];
   if ( ! in_array( $role, $page->getRolesCommit() ) ) {
      throw new Exception( "No permission for commit ");
   }


   $className = ucfirst( $pageName ) . "Action";
   include( Configuration::MODULE_FOLDER . $moduleName . "/" . ucfirst( $moduleName ) .  "DbFunction.php" );
   include( Configuration::MODULE_FOLDER . $moduleName . "/action/" . $className . ".php" );
   foreach ( $page->getDependencies()  as $dependency ) {
      include( Configuration::MODULE_FOLDER . $dependency . "DbFunction.php" );
   }

   $action = new $className;
   $nextPage = $action->commit( $_POST );
   
   $parameter = "";
   
   if ( $nextPage->getModule() != null ) {
      $parameter = "module=" . $nextPage->getModule();
      if ( $nextPage->getPage() != null ) {
         $parameter .= "&page=" . $nextPage->getPage(); 
      }
   }

?>


<head>
   <meta http-equiv="refresh" content="0; URL=index.php?<?php print( $parameter ); ?>" />
</head>
