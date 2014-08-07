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
         print("<div class='headspacer'></div>");
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
            print ( "<form method='post' id='myForm' onSubmit='return postData()' style='display:inline' action='ddd'>" );
            print ( "   <input name='module' value='$moduleName' type='hidden' />");
            print ( "   <input name='page' value='" . $pageName . "' type='hidden' />");
            print ( "   <input name='index' value='" . Page::getTabIndex() . "' type='hidden' />");
      }

      public static function printFormEnd( $buttonText = "save" ) {
            print ( "  <input type='submit' value='$buttonText' />" );
            print ( "</form>" );
      }

      public static function printValue( $object, $fields, $delimiter = " ") {
         if ( $object == null ) {
            return;
         }
         if ( ! is_array( $fields ) ) {
            $fields = array( $fields);
         }

         $result = "";
         foreach ( $fields as $field ) {
            $result .= $object->$field . $delimiter;
         }
         $result = substr( $result, 0, -1 * strlen( $delimiter ) );
         print( $result );
      }

      public static function getImagePath( $object ) {

         if ($object == null || empty( $object->image ) ) {
            return Configuration::IMAGE_UPLOAD_FOLDER. "none.jpg"; 
         }  

         return Configuration::IMAGE_UPLOAD_FOLDER. $object->image;

      }


      public static function getOnClickFunction( $moduleName, $pageName = null, $id = null, $parameters = null, $tabOffset = 1 ) {
         
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

         $result = "showPage( " . ( Page::getTabIndex()  + $tabOffset ) . ", \"$parameter\", true )";
         return $result;
      }

      public static function getListItem( $title, $onClickFunction, $firstLine = "", $secondLine = "") {
         $result = " 
            <div class=listitem onclick='" . $onClickFunction . "'>
               <div class=li_head>$title</div>
               <div class=li_content>
                  <span class=li_firstline>$firstLine</span><br>
                  <span class=li_secondline>$secondLine</span>
               </div>
             </div>
         ";
         return $result;
      }


      public static function readableDuration( $seconds ) {

         $hours = intval( $seconds / 3600 );
         $seconds -= $hours * 3600;
         $minutes = intval( $seconds / 60 );
         $seconds -= $minutes * 60;

         $result = sprintf( "%02d:%02d:%02d", $hours, $minutes, $seconds);
         return $result; 
      }
   }

?>


