<?php
   
   interface Action {

      public function commit( $content );

   }


   class NextPage {

      private $module;
      private $page;

      public function NextPage( $module, $page ) {
         $this->module = $module;
         $this->page = $page;
      }

      public function getModule() {
         return $this->module;
      }

      public function getPage() {
         return $this->page;
      }

      public function isBothSet() {
         return isset( $this->module ) && isset( $this->module );
      }

   }

?>
