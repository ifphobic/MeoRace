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
         foreach ( $modules as $module ) {
            foreach ( $module as $page ) {
               print ($page->getTitle());
            }

         }
         print("<br>");
      }

      public static function printContent($moduleName, $page) {
         if ( $page->isForm() ) {
            print ( "<form method='post' action='commit.php' >" );
            print ( "   <input name='module' value='$moduleName' type='hidden' />");
            print ( "   <input name='page' value='" . $page->getPage() . "' type='hidden' />");
         }
         
        readfile( Configuration::MODULE_FOLDER . $moduleName . "/template/" . $page->getPage() . ".php" );
         
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


   }


?>


