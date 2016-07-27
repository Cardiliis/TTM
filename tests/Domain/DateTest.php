<?php

namespace TeamTimeManager\Domain;

class DateTest extends \PHPUnit_Framework_TestCase
{
    public function testEquals()
    {
        $d1 = new Date(new \DateTimeImmutable('1982-09-01T10:42:00'));
        $d2 = new Date(new \DateTimeImmutable('1982-09-01T10:42:00'));
        $d3 = new Date(new \DateTimeImmutable('2016-09-01T10:42:00'));

        $this->assertTrue($d1->equals($d2), 'd1 === d2');
        $this->assertTrue($d2->equals($d1), 'd2 === d1');

        $this->assertFalse($d1->equals($d3), 'd1 =/= d3');
        $this->assertFalse($d2->equals($d3), 'd2 =/= d3');
    }

    public function testGetHoursToReach()
    {
        $d1 = new Date(new \DateTimeImmutable('2016-09-01T10:12:00'));
        $d2 = new Date(new \DateTimeImmutable('2016-09-01T12:42:00'));
        $d3 = new Date(new \DateTimeImmutable('2016-09-02T8:42:00'));

        $this->assertSame(2.5, $d1->getHoursToReach($d2));
        $this->assertSame(20.0, $d2->getHoursToReach($d3));
        $this->assertSame(22.5, $d1->getHoursToReach($d3));
    }

    public function testBefore()
    {
        $d1 = new Date(new \DateTimeImmutable('1982-09-01T10:42:00'));
        $d2 = new Date(new \DateTimeImmutable('2000-09-01T10:42:00'));
        $d3 = new Date(new \DateTimeImmutable('2016-09-01T10:42:00'));

        $this->assertTrue($d2->before($d3), 'd2 < d3');
        $this->assertFalse($d2->before($d1), 'd2 > d1');
    }

    /**
     * @dataProvider providerTestGetNextBoundary
     */
    public function testGetNextBoundary($dt, $expectedDt)
    {
        $date = new Date(new \DateTimeImmutable($dt));
        $expected = new Date(new \DateTimeImmutable($expectedDt));

        $nextBoundary = $date->getNextBoundary();

        $this->assertTrue($nextBoundary instanceof Date, 'Must return a date');
        $this->assertTrue(
            $expected->equals($nextBoundary),
            sprintf(
                "Dates differentes : %s (expected %s)",
                $nextBoundary->format('Y-m-d H:i:s'),
                $expected->format('Y-m-d H:i:s')
            )
        );
    }

    public function providerTestGetNextBoundary()
    {
        // from Monday 2016-05-02
        // to Sunday 2016-05-08

        return [
            "matin en semaine, avant embauche" =>
                ['2016-05-02T07:00:00', '2016-05-02T08:30:00'],
            "matin en semaine" =>
                ['2016-05-02T09:00:00', '2016-05-02T13:00:00'],
            "matin en semaine, avant pause midi" =>
                ['2016-05-02T12:30:00', '2016-05-02T13:00:00'],
            "matin en semaine, pause midi" =>
                ['2016-05-02T13:30:00', '2016-05-02T14:00:00'],
            "aprem en semaine" =>
                ['2016-05-02T15:00:00', '2016-05-02T17:30:00'],
            "aprem en semaine, après débauche" =>
                ['2016-05-02T18:00:00', '2016-05-03T08:30:00'],
            "vendredi, aprem" =>
                ['2016-05-06T15:00:00', '2016-05-06T16:30:00'],
            "vendredi, après débauche" =>
                ['2016-05-06T17:00:00', '2016-05-09T08:30:00'],
            "samedi matin" =>
                ['2016-05-07T11:00:00', '2016-05-09T08:30:00'],
            "dimanche aprem" =>
                ['2016-05-08T15:00:00', '2016-05-09T08:30:00'],
        ];
    }

    /**
     * @dataProvider providerTestIsAtWork
     */
    public function testIsAtWork($dt, $expected)
    {
        $date = new Date(new \DateTimeImmutable($dt));

        $this->assertSame($expected, $date->isAtWork());
    }

    public function providerTestIsAtWork()
    {
        // from Monday 2016-05-02
        // to Sunday 2016-05-08

        return [
            "matin en semaine, avant embauche" =>
                ['2016-05-02T07:00:00', false],
            "matin en semaine" =>
                ['2016-05-02T09:00:00', true],
            "matin en semaine, avant pause midi" =>
                ['2016-05-02T12:30:00', true],
            "matin en semaine, pause midi" =>
                ['2016-05-02T13:30:00', false],
            "aprem en semaine" =>
                ['2016-05-02T15:00:00', true],
            "aprem en semaine, après débauche" =>
                ['2016-05-02T18:00:00', false],
            "vendredi, après débauche" =>
                ['2016-05-06T17:00:00', false],
            "samedi matin" =>
                ['2016-05-07T11:00:00', false],
            "dimanche aprem" =>
                ['2016-05-08T15:00:00', false],

            "embauche matin" =>
                ['2016-05-02T08:30:00', true],
            "debauche matin" =>
                ['2016-05-02T13:00:00', false],
            "embauche aprem" =>
                ['2016-05-02T14:00:00', true],
            "debauche aprem" =>
                ['2016-05-02T17:30:00', false],
            "debauche aprem vendredi" =>
                ['2016-05-06T16:30:00', false],
        ];
    }
}
