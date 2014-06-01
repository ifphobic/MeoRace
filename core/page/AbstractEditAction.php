<?php

   class AbstractEditAction {

      protected function genericCommit( $moduleName, $key, $pageName, $content, $subModule = null ) {
         if ( $subModule == null ) {
            $classname = ucfirst( $moduleName ) . "DbFunction";
         } else {
            $classname = ucfirst( $subModule ) . "DbFunction";
         }
         $dbFunction = new $classname;

         if ( isSet( $content[$key. 'Id'] ) ) {
            $dbFunction->update( $content );
         } else {
            $dbFunction->insert( $content );
         }
         $dbFunction->close();
         return new NextPage( $moduleName, $pageName );

      }


   }


?>
