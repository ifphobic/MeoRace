<?php
   
   require( "core/Configuration.php" );
   require( "core/interface/Action.php" );

   $module = $_POST['module'];
   $page = $_POST['page'];

   $className = ucfirst ( $page ) . "Action";
   require( Configuration::MODULE_FOLDER . $module . "/action/" . $className . ".php" );
   $action = new $className;
   $nextPage = $action->commit();
   
   $parameter = "";
  
   print_r($nextPage);
   if ( $nextPage->isBothSet() ) {
      $parameter = "module=" . $nextPage->getModule() . "&page=" . $nextPage->getPage(); 
   }

?>


<head>
   <meta http-equiv="refresh" content="0; URL=index.php?<?php print( $parameter ); ?>" />
</head>
