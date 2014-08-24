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
?>
<div class=listitem onclick='<?php print(Page::getOnClickFunction( $moduleName, $page->page)) ?>'>
   <div class='menu_list <?php print($moduleName) ?>'><?php print($page->title) ?></div>   
</div>
<?php
            //print (  Page::getListItem( $page->title, Page::getOnClickFunction( $moduleName, $page->page) ) );
         }
      }
   }
?>
</div>
 
