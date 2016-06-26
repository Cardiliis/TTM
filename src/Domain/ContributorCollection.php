<?php

 namespace TeamTimeManager\Domain;

 use TeamTimeManager\Domain;

 Class ContributorCollection implements \IteratorAggregate, \Countable, Collection
 {
   private
   $contributors;

   public function __construct()
   {
      $this->contributors = array();
   }

   public function add(Contributor $contributor)
   {
      $this->contributors[$contributor->getLogin()] = $contributor;

      return $this;
   }

   public function getIterator()
       {

           return new \ArrayIterator($this->contributors);
       }

   /**
   * @return Contributor
   */

   public function getByLogin($login)
   {
      if(isset($this->contributors[$login]))
      {

         return $this->contributors[$login];
      }
      throw new \RuntimeException("Contributor $login not found");
   }

   public function count()
   {
      return iterator_count($this);
   }

 }
