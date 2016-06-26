<?php

 namespace TeamTimeManager\Domain;

 Class Contributor
 {
   private
     $login,
     $firstName,
     $lastName,

   public function __construct($login, $firstName, $lastName)
   {
     $this->login = $login;
     $this->firstName = $firstName;
     $this->lastName = $lastName;
   }

   public function getLogin()
   {
     return $this->login;
   }

    public function getFirstName()
    {
      return $this->firstName;
    }

    public function getLastName()
    {
      return $this->lastName;
    }

    public function getContributor()
    {
      return new Contributor($contributor);
    }

    public function getContributorList()
    {
      return new ContributorCollection($contributors);
    }
 }
