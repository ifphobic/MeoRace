<?php

   class MenuModule implements Module {

      private $pages;

      public function MenuModule() {
         $this->pages = array(
            new ModulePage("menuList", "Menu List", Role::getAllRoles(true), null, false, false ), 
         );
      }

      public function getPages() {
         return $this->pages;
      }

   }


?>
