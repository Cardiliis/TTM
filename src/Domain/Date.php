<?php

namespace TeamTimeManager\Domain;

class Date
{
    private
        $datetime;

    public function __construct(\DateTimeImmutable $datetime)
    {
        $this->datetime = $datetime;
    }

    public function getHoursToReach(Date $next)
    {
        $diff = $this->datetime->diff($next->datetime);

        return $diff->format('%h') + ($diff->format('%d') * 24) + ($diff->format('%i') / 60.0);
    }

    public function format($format)
    {
        return $this->datetime->format($format);
    }

    public function equals(Date $date)
    {
        return $this->datetime == $date->datetime;
    }

    public function before(Date $date)
    {
        return $this->datetime < $date->datetime;
    }

    public function beforeOrEqual(Date $date)
    {
        return $this->before($date) || $this->equals($date);
    }

    public function setTime($hour, $minute)
    {
        $copy = clone $this;
        $copy->datetime = $this->datetime->setTime($hour, $minute);

        return $copy;
    }

    public function modify($modify)
    {
        $copy = clone $this;
        $copy->datetime = $this->datetime->modify($modify);

        return $copy;
    }

    public function getNextBoundary()
    {
        foreach($this->getWorkHours() as $startTime => $endTime)
        {
            list($startHour, $startMinute) = explode(':', $startTime);
            $startDate = $this->setTime($startHour, $startMinute);
            if($this->before($startDate))
            {
                return $startDate;
            }

            list($endHour, $endMinute) = explode(':', $endTime);
            $endDate = $this->setTime($endHour, $endMinute);
            if($this->before($endDate))
            {
                return $endDate;
            }
        }

        return $this->modify("tomorrow")->getNextBoundary();
    }

    public function isAtWork()
    {
        foreach($this->getWorkHours() as $startTime => $endTime)
        {
            list($startHour, $startMinute) = explode(':', $startTime);
            list($endHour, $endMinute) = explode(':', $endTime);

            $startDate = $this->setTime($startHour, $startMinute);
            $endDate = $this->setTime($endHour, $endMinute);
            if($startDate->beforeOrEqual($this) && $this->before($endDate))
            {
                return true;
            }
        }

        return false;
    }

    private function getEasterDatetime($year)
    {
        $march21 = new \DateTimeImmutable("$year-03-21");
        $nbDaysBetween21MarchAndPaques = easter_days($year);

        return $march21->add(new \DateInterval("P{$nbDaysBetween21MarchAndPaques}D"));
    }

    private function isHoliday()
    {
        $annee = $this->format('Y');
        $easterSunday = $this->getEasterDatetime($annee);

        $holidays = [
            "Jour de l'an" => '01-01',
            "Fête du travail" => '05-01',
            "8 Mai 1945" => '05-08',
            "Fête nationnale" => '07-14',
            "Assomption" => '08-15',
            "La Toussaint" => '11-01',
            "Armistice" => '11-11',
            "Noël" => '12-25',
            "Lundi de Pâques" => $easterSunday->modify("+1 day")->format('m-d'),
            "Jeudi de l'Ascencion" => $easterSunday->modify("+39 day")->format('m-d'),
            "Lundi de Pentecôte" => $easterSunday->modify("+50 day")->format('m-d'),
        ];

        return in_array($this->format('m-d'), $holidays);
    }

    private function getWorkHours()
    {
        if($this->isHoliday())
        {
            return [];
        }

        $openingHours = [
            'Mon' => ['08:30' => '13:00', '14:00' => '17:30'],
            'Tue' => ['08:30' => '13:00', '14:00' => '17:30'],
            'Wed' => ['08:30' => '13:00', '14:00' => '17:30'],
            'Thu' => ['08:30' => '13:00', '14:00' => '17:30'],
            'Fri' => ['08:30' => '13:00', '14:00' => '16:30'],
        ];

        return isset($openingHours[$this->format('D')]) ? $openingHours[$this->format('D')] : [];
    }
}
