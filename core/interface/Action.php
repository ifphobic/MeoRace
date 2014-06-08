<?php
   
   interface Action {

      public function commit( $content );

   }


   class NextPage {

      private $module;
      private $page;
      private $parameter;

      public function NextPage( $module, $page, $parameter = null ) {
         $this->module = $module;
         $this->page = $page;
         $this->parameter= $parameter;
      }

      public function getModule() {
         return $this->module;
      }

      public function getPage() {
         return $this->page;
      }

      public function getParameter() {
         return $this->parameter;
      }


   }

?>
