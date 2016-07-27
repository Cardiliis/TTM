<?php

namespace TeamTimeManager\Domain;

class Period
{
    private
        $start,
        $end;

    public function __construct(Date $start, Date $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public function getHours()
    {
        $hours = 0;

        $current = $this->start;
        $state = $current->isAtWork();
        $next = $current->getNextBoundary();

        while($next->before($this->end))
        {
            if($state === true)
            {
                $hours += $current->getHoursToReach($next);
            }

            $current = $next;
            $next = $current->getNextBoundary();
            $state = $current->isAtWork();
        }

        if($state === true)
        {
            $hours += $current->getHoursToReach($this->end);
        }

        return $hours;
    }
}
