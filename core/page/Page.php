<?php

   class Page {

      public static function getTabIndex() {
         return $GLOBALS['MeoRace']['tabIndex'];
      }

      public static function getContent() {
         return $GLOBALS['MeoRace']['content'];
      }

      public static function includeDependency( $moduleName, $page ) {
         include( Configuration::MODULE_FOLDER . $moduleName . "/" . ucfirst( $moduleName )  . "DbFunction.php" );
         foreach ( $page->getDependencies()  as $dependency ) {
            include( Configuration::MODULE_FOLDER . $dependency . "DbFunction.php" );
         }
      }

      public static function printContent( $moduleName, $page) {
         $form = $page->isForm();
         if ( $form ) {
            Page::printFormStart( $moduleName, $page->page );
         }
         include( Configuration::MODULE_FOLDER . $moduleName . "/template/" . $page->getPage() . ".php" );
         if ( $form ) {
            Page::printFormEnd( );
         }
      }

      public static function printFormStart( $moduleName, $pageName ) {
            print ( "<form method='post' id='myForm' onSubmit='return postHttpRequest()' style='display:inline' action='ddd'>" );
            print ( "   <input name='module' value='$moduleName' type='hidden' />");
            print ( "   <input name='page' value='" . $pageName . "' type='hidden' />");
            print ( "   <input name='index' value='" . Page::getTabIndex() . "' type='hidden' />");
      }

      public static function printFormEnd( $buttonText = "save" ) {
            print ( "  <input type='submit' value='$buttonText' />" );
            print ( "</form>" );
      }


      public static function getParameter( $moduleName, $pageName = null, $id = null, $parameters = null ) {
         $parameter = "module=" . $moduleName;
         if ( $pageName != null ) {
            $parameter .= "&page=" . $pageName;
         }
         if ( $id != null ) {
            $parameter .= "&id=" . $id;
         }
         if ( $parameters != null ) {
            $parameter .= "&" . $parameters;
         }
         return $parameter;
      }

      public static function getListItem( $title, $parameter, $firstLine = "", $secondLine = "") {
         $result = " 
            <div class=listitem onclick='drilldown( " . (Page::getTabIndex()  + 1) . ", \"$parameter\" )'>
               <div class=li_head>$title</div>
               <div class=li_content>
                  <span class=li_firstline>$firstLine</span><br>
                  <span class=li_secondline>$secondLine</span>
               </div>
             </div>
         ";
         return $result;
      }

   }


?>


