<?php

   class AbstractEditAction {

      protected function genericCommit( $moduleName, $key, $pageName, $content, $subModule = null, $parameter = array() ) {
         if ( $subModule == null ) {
            $classname = ucfirst( $moduleName ) . "DbFunction";
         } else {
            $classname = ucfirst( $subModule ) . "DbFunction";
         }
         $dbFunction = new $classname;

         if ( isSet( $content[$key. 'Id'] ) ) {
            $dbFunction->update( $content );
            $parameter = array_merge(array("id" => $content[$key. 'Id'] ),  $parameter);
         } else {
            $dbFunction->insert( $content );
         }
         $dbFunction->close();
         return new NextPage( $moduleName, $pageName, $parameter );

      }


   }


?>
