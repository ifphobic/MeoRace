<div class=list>
<?php
   $user = CommonDbFunction::getUser();         
   $role = Role::NO_ROLE;
   if ( $user != null ) {
      $role = $user->role;
   }
   
   $modules = ModuleReader::readAllModules( $role );   

   foreach ( array_keys( $modules ) as $moduleName ) {
      $module = $modules[ $moduleName ];
      foreach ( $module as $page ) {
         if ( $page->isNavigation() ) {
            print (  Page::getListItem( $page->title, Page::getOnClickFunction( $moduleName, $page->page) ) );
         }
      }
   }
?>
</div>
 
