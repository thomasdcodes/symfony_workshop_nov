<?php

namespace App\Tests\UnitTest\Service;

use App\Service\WorkTimeCalculator;
use PHPUnit\Framework\TestCase;

class WorkTimeCalculatorTest extends TestCase
{
    public function testCanInitializeClass(): void
    {
        $workTimeCalculator = new WorkTimeCalculator();

        $this->assertTrue($workTimeCalculator instanceof WorkTimeCalculator);
    }

    public function testCanCalculateNormalWorkingTimes(): void
    {
        $workTimeCalculator = new WorkTimeCalculator();
        $startDateTime = new \DateTime('2022-12-01 09:01:35');
        $endDateTime = new \DateTime('2022-12-01 15:59:59');

        $timeDiff = $workTimeCalculator->calculateWorkingTime($startDateTime, $endDateTime);

        $this->assertEquals('6:58:24', $timeDiff);
    }

    public function testCanCalculateSecondNormalWorkingTimes(): void
    {
        $workTimeCalculator = new WorkTimeCalculator();
        $startDateTime = new \DateTime('2022-12-01 09:10:05');
        $endDateTime = new \DateTime('2022-12-01 16:10:05');

        $timeDiff = $workTimeCalculator->calculateWorkingTime($startDateTime, $endDateTime);

        $this->assertEquals('7:00:00', $timeDiff);
    }

    public function testCanCalculateThirdNormalWorkingTimes(): void
    {
        $workTimeCalculator = new WorkTimeCalculator();
        $startDateTime = new \DateTime('2022-12-01 09:00:05');
        $endDateTime = new \DateTime('2022-12-01 09:00:06');

        $timeDiff = $workTimeCalculator->calculateWorkingTime($startDateTime, $endDateTime);

        $this->assertEquals('0:00:01', $timeDiff);
    }
}
