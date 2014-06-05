<?php


   class ModuleReader {
   

      public static function readAllLinks( $role ) {
   
         $moduleNames = self::readModuleNames( Configuration::MODULE_FOLDER );
         $modules = array();
         foreach ( $moduleNames as $moduleName ) {
            $className = ucfirst ( $moduleName ) . "Module";
            include( Configuration::MODULE_FOLDER . $moduleName . "/" . $className . ".php");
            $module = new $className;
            $selected = array();
            $pages = $module->getPages();
            foreach ( $pages as $page ) {
               $roles = $page->getRolesPage();
               if ( in_array( $role, $roles ) ) {
                  $selected[ $page->getPage() ] = $page; 
               }
            }
            if ( !empty( $selected ) ) {
               $modules[ $moduleName ] = $selected;
            }
         }

         return $modules;
      }


      private static function readModuleNames( $path ) {
         $folders = new DirectoryIterator( $path );
         $result = array();
         foreach ( $folders as $folder ) {
             if ( $folder->isDir() && !$folder->isDot() ) {
               $moduleName = $folder->getFilename();
               array_push( $result, $moduleName );
             }
         }
         return $result;

      }

   }
?>
