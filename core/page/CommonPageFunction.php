<?php

   class CommonPageFunction {
      
      public static function getLink( $module, $page, $id, $text, $parameter = null, $tabOffset = 1 ) {
         $link = "<a href='javascript:" . Page::getOnClickFunction( $module, $page, $id, $parameter, $tabOffset ) . "'>";
         $link .= "$text</a>";

         return $link;
      }

      public static function getLable( $key, $object, $text) {
         $result = "<tr><td>$text:</td><td>" . ( isset( $object ) ? $object->$key : " " ) ."</td></tr>";
         return $result;
      }

      public static function getInputField( $key, $object, $text) {
         $result = "<tr><td>$text:</td><td><input name='$key' value='" . ( isset( $object ) ? $object->$key : "" ) ."' /></td></tr>";
         return $result;
      }

      public static function getCheckbox( $key, $object, $text) {
         $result = "<tr><td>$text:</td><td><input type='checkbox' name='$key' value='1' " . ( ( isset( $object ) && $object->$key == 1) ? "checked" : "" ) . " /></td></tr>";
         return $result;
      }

      public static function getCombobox($key, $object, $text, $options, $optionKey = null, $addNone = false ) {
         $result = "";
         if ( $text != null ) {
            $result = "<tr><td>$text</td><td>";
         }
         $result .= "<select name='$key' size='1' >";
         
         if ( $addNone ) {
            $result .= "<option value='' " . ( ( isset( $object ) && strcmp( "", $object->$key)  == 0) ? "selected" : "" ). " > </option>";
         }

         foreach ( $options as $option ) {
            if ( isset( $optionKey ) ) {
               $value = $option->$optionKey;
               $name = $option->name;
            } else {
               $value = $option;
               $name = $option;
            }
            $result .= "<option value='" . $value . "' " . ( ( isset( $object ) && strcmp( $value, $object->$key)  == 0) ? "selected" : "" ). " >$name</option>";
         }
         $result .= "</select>";
         if ( $text != null ) {
            $result .= "</td></tr>";
         }
         return $result;
         
      }
   
   }

?>
