<?php
   
   require( "core/include.php" );

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
   require( Configuration::MODULE_FOLDER . $moduleName . "/" . ucfirst ( $moduleName ) .  "DbFunction.php" );
   require( Configuration::MODULE_FOLDER . $moduleName . "/action/" . $className . ".php" );
   $action = new $className;
   $nextPage = $action->commit( $_POST );
   
   $parameter = "";
  
   if ( $nextPage->isBothSet() ) {
      $parameter = "module=" . $nextPage->getModule() . "&page=" . $nextPage->getPage(); 
   }

?>


<head>
   <meta http-equiv="refresh" content="0; URL=index.php?<?php print( $parameter ); ?>" />
</head>
