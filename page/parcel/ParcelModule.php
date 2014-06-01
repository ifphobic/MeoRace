<?php

   class ParcelModule implements Module {

      private $pages;

      public function ParcelModule() {
         $this->pages = array(
            new ModulePage("parcelList", "Parcel List", array(Role::RACE_MASTER), null, false, true ), 
            new ModulePage("parcelEdit", "Edit Parcel", array(Role::RACE_MASTER), array(Role::RACE_MASTER), true, false )
         );
      }

      public function getPages() {
         return $this->pages;
      }

   }


?>
