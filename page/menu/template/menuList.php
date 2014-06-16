<div class=list>
<?php
   $user = CommonDbFunction::getUser();         

   print(" Logged in as: " . $user->user );
   print(" (" . $user->role . "/" . $user->raceName . ") " );
   
   $modules = ModuleReader::readAllModules( $user->role );   

   foreach ( array_keys( $modules ) as $moduleName ) {
      $module = $modules[ $moduleName ];
      foreach ( $module as $page ) {
         if ( $page->isNavigation() ) {
            print (  Page::getListItem( $_GET['index'], $page->title, Page::getParameter( $moduleName, $page->page) ) );
         }
      }
   }
?>
</div>
 
