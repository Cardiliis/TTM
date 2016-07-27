<?php

namespace TeamTimeManager\Domain;

class PeriodTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerTestGetHours
     */
    public function testGetHours($startTime, $endTime, $expected)
    {
        $start = new Date(new \DateTimeImmutable($startTime));
        $end = new Date(new \DateTimeImmutable($endTime));

        $p = new Period($start, $end);
        $hours = $p->getHours();

        $this->assertEquals($expected, $hours, "Found $hours hours, expected $expected hours");
    }

    public function providerTestGetHours()
    {
        return [
            "après-midi" =>
                ['2016-05-02T14:00:00', '2016-05-02T18:00:00', 3.5],
            "fin d'aprem" =>
                ['2016-05-02T16:00:00', '2016-05-02T18:00:00', 1.5],
            "1 jour" =>
                ['2016-05-02T08:30:00', '2016-05-02T17:30:00', 8],
            "parti en avance et revenu en retard le lendemain" =>
                ['2016-05-02T16:30:00', '2016-05-03T9:30:00', 2],
            "2 jours" =>
                ['2016-05-02T08:30:00', '2016-05-03T17:30:00', 16],
            "vendredi + lundi" =>
                ['2016-05-06T08:30:00', '2016-05-09T17:30:00', 15],
        ];
    }
}
