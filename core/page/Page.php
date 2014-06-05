<?php

   class Page {


      public static function printHeader($page) {

         print("
            <html>
               <head>
                  <title>" . $page->getTitle() . "</title>
               </head>
               <body>
         ");
      }

      public static function printNavigation($modules) {
         foreach ( array_keys( $modules ) as $moduleName ) {
            $module = $modules[ $moduleName ];
            foreach ( $module as $page ) {
               if ( $page->isNavigation() ) {
                  print ( self::getLink( $moduleName, $page ) . " | " );
               }
            }
         }

         $user = CommonDbFunction::getUser();
         if ( isset( $user ) ) {
            print(" Logged in as: " . $user->user );
            print(" (" . $user->role . "/" . $user->raceName . ") " );

         }
         print( "<a href='index.php?logout=1'>Logout</a>" );
         print("<br><br>");
      }

      public static function printContent($moduleName, $page) {
         if ( $page->isForm() ) {
            print ( "<form method='post' action='commit.php' >" );
            print ( "   <input name='module' value='$moduleName' type='hidden' />");
            print ( "   <input name='page' value='" . $page->getPage() . "' type='hidden' />");
         }
       
         include( Configuration::MODULE_FOLDER . $moduleName . "/" . ucfirst( $moduleName )  . "DbFunction.php" );
            foreach ( $page->getDependencies()  as $dependency ) {
            include( Configuration::MODULE_FOLDER . $dependency . "DbFunction.php" );
         }

         include( Configuration::MODULE_FOLDER . $moduleName . "/template/" . $page->getPage() . ".php" );
         
         if ( $page->isForm() ) {
            print ( "  <input type='submit' />" );
            print ( "</form>" );
         }
      }

      public static function printFooter() {
      
         print("
               </body>
            </html>
         ");
      }

      public static function getLink($moduleName, $page) {
         
         $parameter = "module=$moduleName&page=" . $page->getPage();
         $link = "<a href='index.php?$parameter'>" . $page->getTitle() . "</a>";
         return $link;
      }

   }


?>


