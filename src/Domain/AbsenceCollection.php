<?php

 namespace TeamTimeManager\Domain;

 use TeamTimeManager\Domain\Absence;

 Class AbsenceCollection
 {
   private
     $contributor,
     $awayperiodstartdate,
     $awayperiodenddate,
     $awayperiodinhour,

   public function __construct($name, $awayperiodstartdate, $awayperiodenddate, $awayperiodinhour)
   {
     $this->contributor = $contributor;
     $this->awayperiodstartdate = $awayperiodstartdate;
     $this->awayperiodenddate = $awayperiodstartdate;
     $this->awayperiodinhour = $awayperiodinhour;
   }

   public function getName ()
   {
     return $this->name;
   }

 }
