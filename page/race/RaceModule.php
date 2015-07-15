<?php

   class RaceModule implements Module {

      private $pages;

      public function RaceModule() {
         $this->pages = array(
            new ModulePage("raceList", "Race List", array(Role::ADMIN, Role::RACE_MASTER), null, false, true ), 
            
            new ModulePage("taskList", "Configure Race", array(Role::ADMIN, Role::RACE_MASTER), array(Role::ADMIN, Role::RACE_MASTER), false, CommonDbFunction::userHasRace(), array("race/Task") ),
            new ModulePage("deliveryList", "Configure Task", array(Role::ADMIN, Role::RACE_MASTER), array(Role::ADMIN, Role::RACE_MASTER), false, false, array("race/Delivery", "race/Task", "race/DeliveryCondition") ),
            
            new ModulePage("raceEdit", "Edit Race", array(Role::ADMIN, Role::RACE_MASTER), array(Role::ADMIN, Role::RACE_MASTER), true, false, array("racerTask/RacerTask", "user/User") ),
            new ModulePage("taskEdit", "Edit Task", array(Role::ADMIN, Role::RACE_MASTER), array(Role::ADMIN, Role::RACE_MASTER), true, false, array("race/Task", "checkpoint/Checkpoint") ),
            new ModulePage("taskDelete", "Delete Task", array(Role::ADMIN, Role::RACE_MASTER), array(Role::ADMIN, Role::RACE_MASTER), true, false, array("race/Task", "race/Delivery") ),
            new ModulePage("deliveryEdit", "Edit Delivery", array(Role::ADMIN, Role::RACE_MASTER), array(Role::ADMIN, Role::RACE_MASTER), 
                           true, false, array("race/Delivery", "checkpoint/Checkpoint", "parcel/Parcel", "race/Task", "race/DeliveryCondition" ) ),
            new ModulePage("deliveryDelete", "Delete Delivery", array(Role::ADMIN, Role::RACE_MASTER), array(Role::ADMIN, Role::RACE_MASTER), true, false, array("race/Delivery", "race/Task", "race/DeliveryCondition" ) ),
            new ModulePage("deliveryConditionAdd", "Add Delivery Condition", array(Role::ADMIN, Role::RACE_MASTER), array(Role::ADMIN, Role::RACE_MASTER), false, false, array("race/DeliveryCondition", "race/Delivery", "race/Task") ),
            new ModulePage("deliveryConditionDelete", "Delete Delivery Condition", array(Role::ADMIN, Role::RACE_MASTER), array(Role::ADMIN, Role::RACE_MASTER), 
                           false, false, array("race/DeliveryCondition", "race/Delivery", "race/Task") ),
         );
      }

      public function getPages() {
         return $this->pages;
      }

   }


?>
