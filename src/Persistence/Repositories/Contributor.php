<?php

namespace TeamTimeManager\Persistence\Repositories;

class Contributor implements ContributorRepository
{
   public function __construct()
   {

   }

   public function find($login)
    {
      return new Contributor ($contributor)
    }

   public function findAll()
   {
      return new ContributorCollection($contributors)
   }

}
