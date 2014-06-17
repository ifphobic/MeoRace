<div class=list>
<?php
   $user = CommonDbFunction::getUser();         
   $role = Role::NO_ROLE;
   if ( $user != null ) {
      print(" Logged in as: " . $user->user );
      print(" (" . $user->role . "/" . $user->raceName . ") " );
      $role = $user->role;
   }
   
   $modules = ModuleReader::readAllModules( $role );   

   foreach ( array_keys( $modules ) as $moduleName ) {
      $module = $modules[ $moduleName ];
      foreach ( $module as $page ) {
         if ( $page->isNavigation() ) {
            print (  Page::getListItem( $page->title, Page::getParameter( $moduleName, $page->page) ) );
         }
      }
   }
?>
</div>
 
