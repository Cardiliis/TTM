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
        $day = (int) $this->datetime->format('N');
        $hour = (int) $this->datetime->format('H');
        $minute = (int) $this->datetime->format('i');

        if($day >= 6 || ($day === 5 && ($hour > 16 || ($hour === 16 && $minute >= 30) ) ) )
        {
            $nbDays = 8 - $day;
            $interval = sprintf("P%dD", $nbDays);

            $dt = $this->datetime->add(new \DateInterval($interval));
            $dt = $dt->setTime(8, 30);

            return new Date($dt);
        }

        if($hour < 8 || ($hour === 8 && $minute < 30) )
        {
            $dt = $this->datetime->setTime(8, 30);

            return new Date($dt);
        }

        if($hour < 13)
        {
            $dt = $this->datetime->setTime(13, 0);

            return new Date($dt);
        }

        if($hour < 14)
        {
            $dt = $this->datetime->setTime(14, 0);

            return new Date($dt);
        }

        if($hour < 17)
        {
            $nextHour = $day === 5 ? 16: 17;
            $dt = $this->datetime->setTime($nextHour, 30);

            return new Date($dt);
        }

        $dt = $this->datetime->add(new \DateInterval('P1D'));
        $dt = $dt->setTime(8, 30);

        return new Date($dt);

    }

    public function isAtWork()
    {
        $day = (int) $this->datetime->format('N');
        $hour = (int) $this->datetime->format('H');
        $minute = (int) $this->datetime->format('i');

        if($day >= 6)
        {
            return false;
        }

        if($hour < 8 || $hour > 17)
        {
            return false;
        }

        if($hour === 8)
        {
            return ($minute >= 30);
        }

        if($day === 5)
        {
            if($hour === 16)
            {
                return ($minute < 30);
            }
            if($hour > 16)
            {
                return false;
            }
        }

        if($hour === 17)
        {
            return ($minute < 30);
        }

        if($hour === 13)
        {
            return false;
        }

        return true;
    }
}