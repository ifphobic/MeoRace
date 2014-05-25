<?php


class ModulePage {

   const NO_ROLE = "NO_ROLE";
   const ALL_ROLES = "ALL_ROLES";


   private $page;
   private $title;
   private $roles;
   private $form;


   public function ModulePage ($page, $title, $roles, $form = false) {
      $this->page = $page;
      $this->title = $title;
      $this->roles = $roles;
      $this->form = $form;
   }

   public function getPage() {
      return $this->page;
   }

   public function getTitle() {
      return $this->title;
   }

   public function getRoles() {
      return $this->roles;
   }

   public function isForm() {
      return $this->form;
   }

}

?>
