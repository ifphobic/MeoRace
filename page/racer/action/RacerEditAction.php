<?php

   include 'core/SimpleImage.php';

   class RacerEditAction extends AbstractEditAction implements Action {

      public function commit( $content ) {

         $dbFunction = new RacerDbFunction;
         if ( isSet( $content[ 'racerId'] ) ) {
            $newFile = $this->saveImage( "racer", $content['racerId'] );
            if ( $newFile != null ) {
               $content['image'] = $newFile;
            }
            $dbFunction->update( $content );
            $parameter = array("id" => $content['racerId'] );
         } else {
            $dbFunction->insert( $content );
            $parameter = array( );
            $racerId = $dbFunction->getLastId();
            
            $newFile = $this->saveImage( "racer", $racerId );
            if ( $newFile != null ) {
               $content[ 'racerId'] = $racerId;
               $content['image'] = $newFile;
               $dbFunction->update( $content );
            }
            
         }
         $dbFunction->close();
         return new NextPage( "racer", "racerEdit", $parameter );
      }
   }

?>
