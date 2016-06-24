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
     $isChecked,
     $isValidated,


   public function __construct(Contributor $contributor, $awayPeriodStartDate, $awayPeriodEndDate, $awayPeriodInHour, $isChecked, $isValidated)
   {
     $this->contributor = $contributor;
     $this->awayPeriodStartDate = $awayPeriodStartDate;
     $this->awayPeriodEndDate = $awayPeriodEndDate;
     $this->awayPeriodInHour = $awayPeriodInHour;
     $this->isChecked = $isChecked;
     $this->isValidated = $isValidated;
   }

   public function getAbsence ()
   {
     return $this->absence;
   }

   public function getAbsenceList ()
   {
     return new AbsenceCollection ($absences);
   }

   public function IsChecked ()
   {
     return $this->isChecked;
   }

   public function IsValidated ()
   {
     return $this->isValidated;
   }

 }
