<?php

 namespace TeamTimeManager\Domain;

 use TeamTimeManager\Domain\Absence;

 Class AbsenceCollection implements \IteratorAggregate, Collection
 {
   private
     absences;

     public function __construct()
     {
       $this->absences = array();

     }

     public function add(Absence $absence)
     {
        $this->absences[$absence->getLogin()] = $absence;
        return $this;
     }

     public function getIterator()
         {
             return new \ArrayIterator($this->absences);
         }

     /**
     * @return Absence
     */

     public function getByContributor($login)
     {
        if(isset($this->absences->contributor[$login]))
        {
           return $this->absences->contributor[$login];
        }
        throw new \RuntimeException("Absence for contributor $login not found");
     }

     public function count()
     {
        return iterator_count($this);
     }

 }
