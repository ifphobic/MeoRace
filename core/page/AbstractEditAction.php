<?php

   class AbstractEditAction {

      protected function genericCommit( $moduleName, $key, $pageName, $content) {
         $classname = ucfirst( $moduleName ) . "DbFunction";
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
