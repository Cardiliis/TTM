<?php

 namespace TeamTimeManager\Domain;

 use TeamTimeManager\Domain\Contributor;

 Class ContributorCollection
 {
   private
     $contributor,

   public function __construct($contributor)
   {
     $this->contributor = $contributor;

   }

   public function getName ()
   {
     return $this->name;

   }

 }
