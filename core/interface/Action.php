<?php
   
   interface Action {

      public function commit( $content );

   }


   class NextPage {

      private $module;
      private $page;
      private $parameter;
      private $content;

      public function NextPage( $module, $page, $parameter = null, $content = null ) {
         $this->module = $module;
         $this->page = $page;
         $this->parameter = $parameter;
         $this->content = $content;
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

      public function setParameter($parameter) {
         $this->parameter = $parameter;
      }

      public function getContent() {
         return $this->content;
      }

   }

?>
