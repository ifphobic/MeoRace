<?php

   require("core/page/ModuleReader.php");
   require("core/page/ModulePage.php");
   require("core/Configuration.php");
   require("core/page/Page.php");
   require("core/interface/Module.php");
 

   $modules = ModuleReader::readAllLinks(ModulePage::NO_ROLE);
   
   if ( isset( $GET['module'] ) ) {
      $moduleName = $GET['module'];
      $pageName = $GET['page'];
   } else {
      $moduleName = array_keys( $modules )[0];
   }

   if ( !isset( $pageName ) ) {
      $pageName = array_keys( $modules[ $moduleName ] )[0];
   }
   
   $page = $modules[ $moduleName ][ $pageName ];


   Page::printHeader( $page );
   Page::printNavigation($modules);

   Page::printContent( $moduleName, $page );

   Page::printFooter();



?>
