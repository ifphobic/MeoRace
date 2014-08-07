<?php

   include 'core/SimpleImage.php';

   class RacerEditAction extends AbstractEditAction implements Action {

      public function commit( $content ) {

         $dbFunction = new RacerDbFunction;
         if ( isSet( $content[ 'racerId'] ) ) {
            $newFile = $this->saveImage( $content['racerId'] );
            if ( $newFile != null ) {
               $content['image'] = $newFile;
            }
            $dbFunction->update( $content );
            $parameter = array("id" => $content['racerId'] );
         } else {
            $dbFunction->insert( $content );
            $parameter = array( );
            $racerId = $dbFunction->getLastId();
         }
         $dbFunction->close();
         return new NextPage( "racer", "racerEdit", $parameter );
      }
   
      private function saveImage( $racerId ) {
         
         if ( ! isset($_FILES) || !file_exists( $_FILES['image']['tmp_name'] ) ) {
            return null;
         }
         
         $base = "racer/$racerId";
         $position = strrpos( $_FILES['image']['name'], ".");
         if ( $position !== false ) {
            $extension = substr( $_FILES['image']['name'], $position );
         }
         $counter = 0;
         while ( file_exists( $this->createFilename( $base, $counter, $extension, true ) ) ) {
            $counter++;
         }

         $image = new SimpleImage();
         $image->load( $_FILES['image']['tmp_name'] );
         $image->resizeToWidth( 300 );
         $image->save( $this->createFilename( $base, $counter, $extension, true ) );
         return $this->createFilename( $base, $counter, $extension, false );

      }

      private function createFilename( $base, $counter, $extension, $absolut ) {
         $filename = $base . "-" . $counter . $extension;
         if ( !$absolut ) {
            return $filename;
         }
         return Configuration::IMAGE_UPLOAD_FOLDER. $filename;
      }

   }

?>
