<?php

namespace TeamTimeManager\Persistence\Repositories;

use TeamTimeManager\Domain;

class Contributor implements ContributorRepository
{
   private $contributorCollection;

   Public function __construct()
   {
       $this->contributorCollection = new Domain\ContributorCollection();

       $this->initializeStub();
   }

   public function find($login)
   {
      return $this->contributorCollection->getByLogin($login);
   }

   public function findAll()
   {
      return $this->contributorCollection->getContributorList();
   }

   private function initializeStub()
   {
       $contributors = array(
           'poney', 'My', 'Little'
           'burger', 'Big', 'Tasty'
           'auger', 'Francois', 'Auger'

       );

       foreach($contributors as $contributor)
       {
           $this->contributorCollection->add(new Contributor($login, $firstName, $lastName));
       }
   }

}
