<?php

namespace TeamTimeManager\Persistence;

interface ContributorRepository
{
   public function find($login);

   public function findAll();

}
