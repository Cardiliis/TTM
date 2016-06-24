<?php

 namespace Teamtimemanager\Domain;

 use Teamtimemanager\Domain\Contributor as Contributor;

 Class Absence
 {
   private
     $contributor,
     $awayperiodstartdate,
     $awayperiodenddate,
     $awayperiodinhour,

   public function __construct(Contributor $contributor, $awayperiodstartdate, $awayperiodenddate, $awayperiodinhour)
   {
     $this->contributor = $contributor;
     $this->awayperiodstartdate = $awayperiodstartdate;
     $this->awayperiodenddate = $awayperiodstartdate;
     $this->awayperiodinhour = $awayperiodinhour;
   }

   public function getAbsence ()
   {
     return $this->absence;
   }

   public function getAbsenceList ()
   {
     return new AbsenceCollection ($absences);
   }
 }
