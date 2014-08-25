<?php

   include 'core/SimpleImage.php';

   class AbstractEditAction {

      protected function genericCommit( $moduleName, $key, $pageName, $content, $subModule = null, $parameter = array() ) {
         if ( $subModule == null ) {
            $classname = ucfirst( $moduleName ) . "DbFunction";
         } else {
            $classname = ucfirst( $subModule ) . "DbFunction";
         }
         $dbFunction = new $classname;

         if ( isSet( $content[$key. 'Id'] ) ) {
            $newFile = $this->saveImage( $key, $content[$key. 'Id'] );
            if ( $newFile != null ) {
               $content['image'] = $newFile;
            }

            $dbFunction->update( $content );
            $parameter = array_merge(array("id" => $content[$key. 'Id'] ),  $parameter);
         } else {
            $dbFunction->insert( $content );
            $id = $dbFunction->getLastId();
            
            $newFile = $this->saveImage( $key, $id );
            if ( $newFile != null ) {
               $content[ $key.'Id'] = $id;
               $content['image'] = $newFile;
               $dbFunction->update( $content );
            }

         }
         $dbFunction->close();
         return new NextPage( $moduleName, $pageName, $parameter );

      }

      protected function saveImage( $subfolder, $id ) {

         if ( !isset($_FILES) || !isset($_FILES['image']) || !file_exists( $_FILES['image']['tmp_name'] ) ) {
            return null;
         }

         $base = "$subfolder/$id";
         $position = strrpos( $_FILES['image']['name'], ".");
         if ( $position !== false ) {
            $extension = substr( $_FILES['image']['name'], $position );
         }
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
