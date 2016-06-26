<?php

namespace TeamTimeManager\Persistence\Repositories;

use TeamTimeManager\Domain;

class Contributor implements ContributorRepository
{
   private ContributorCollection $contributorCollection;

   public function find($login)
   {
      return new Contributor ($contributor)
   }

   public function findAll()
   {

      return $contributorCollection
   }

}
