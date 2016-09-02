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

    public function getNextBoundary()
    {
        foreach($this->getWorkHours() as $startTime => $endTime)
        {
            list($startHour,  $startMinute) = explode(":", $startTime);
            list($endHour,  $endMinute) = explode(":", $endTime);

            $startTime = $this->datetime->setTime($startHour, $startMinute);
            $endTime = $this->datetime->setTime($endHour, $endMinute);
            if($this->datetime < $startTime)
            {
                $dt = $this->datetime->setTime($startTime->format('H'), $startTime->format('i'));

                return new Date($dt);
            }

            if($this->datetime < $endTime)
            {
                $dt = $this->datetime->setTime($endTime->format('H'), $endTime->format('i'));

                return new Date($dt);
            }
        }

        $dt = $this->datetime->modify("tomorrow");
        $date = new Date($dt);

        return $date->getNextBoundary();
    }

    public function isAtWork()
    {
        foreach($this->getWorkHours() as $startTime => $endTime)
        {
            list($startHour,  $startMinute) = explode(":", $startTime);
            list($endHour,  $endMinute) = explode(":", $endTime);

            $startTime = $this->datetime->setTime($startHour, $startMinute);
            $endTime = $this->datetime->setTime($endHour, $endMinute);
            if(($startTime <= $this->datetime) && ($this->datetime < $endTime))
            {
                return true;
            }
        }

        return false;
    }

    private function getWorkHours()
    {
        $openingHours = [
            'Mon' => ['08:30' => '13:00', '14:00' => '17:30'],
            'Tue' => ['08:30' => '13:00', '14:00' => '17:30'],
            'Wed' => ['08:30' => '13:00', '14:00' => '17:30'],
            'Thu' => ['08:30' => '13:00', '14:00' => '17:30'],
            'Fri' => ['08:30' => '13:00', '14:00' => '16:30'],
        ];

        return isset($openingHours[$this->datetime->format('D')]) ? $openingHours[$this->datetime->format('D')] : [];
    }
}
