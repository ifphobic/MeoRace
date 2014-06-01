<?php


class ModulePage {

   private $page;
   private $title;
   private $rolesPage;
   private $rolesCommit;
   private $form;
   private $navigation;
   private $depencenies;


   public function ModulePage ( $page, $title, $rolesPage, $rolesCommit, $form, $navigation, $depencenies = array() ) {
      $this->page = $page;
      $this->title = $title;
      $this->rolesPage = $rolesPage;
      $this->rolesCommit = $rolesCommit;
      $this->form = $form;
      $this->navigation = $navigation;
      $this->depencenies = $depencenies;
   }

   public function getPage() {
      return $this->page;
   }

   public function getTitle() {
      return $this->title;
   }

   public function getRolesPage() {
      return $this->rolesPage;
   }

   public function getRolesCommit() {
      return $this->rolesCommit;
   }

   public function isForm() {
      return $this->form;
   }

   public function isNavigation() {
      return $this->navigation;
   }

   public function getDependencies() {
      return $this->depencenies;
   }

}

?>
