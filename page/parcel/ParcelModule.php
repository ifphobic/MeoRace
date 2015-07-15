<?php

   class ParcelModule implements Module {

      private $pages;

      public function ParcelModule() {
         $this->pages = array(
            new ModulePage("parcelList", "Parcel List", array(Role::RACE_MASTER, Role::ADMIN), null, false, CommonDbFunction::userHasRace() ), 
            new ModulePage("parcelEdit", "Edit Parcel", array(Role::RACE_MASTER, Role::ADMIN), array(Role::RACE_MASTER, Role::ADMIN), true, false )
         );
      }

      public function getPages() {
         return $this->pages;
      }

   }


?>
