<?php

 namespace TeamTimeManager\Domain;

 use TeamTimeManager\Domain\Contributor;

 Class ContributorCollection
 {
   private
     $contributor,
     $awayPeriodStartDate,
     $awayPeriodEndDate,
     $awayPeriodInHour,

   public function __construct($name, $awayPeriodStartDate, $awayPeriodEndDate, $awayPeriodInHour)
   {
     $this->contributor = $contributor;
     $this->awayPeriodStartDate = $awayPeriodStartDate;
     $this->awayPeriodEndDate = $awayPeriodEndDate;
     $this->awayPeriodInHour = $awayPeriodInHour;
   }

   public function getName ()
   {
     return $this->name;
   }

 }
