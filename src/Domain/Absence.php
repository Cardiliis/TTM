<?php

 namespace TeamTimeManager\Domain;

 use TeamTimeManager\Domain\Contributor;

 Class Absence
 {
   private
     $contributor,
     $awayPeriodStartDate,
     $awayPeriodEndDate,
     $awayPeriodInHour,

   public function __construct(Contributor $contributor, $awayPeriodStartDate, $awayPeriodEndDate, $awayPeriodInHour)
   {
     $this->contributor = $contributor;
     $this->awayperiodstartdate = $awayPeriodStartDate;
     $this->awayperiodenddate = $awayPeriodEndDate;
     $this->awayperiodinhour = $awayPeriodInHour;
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
