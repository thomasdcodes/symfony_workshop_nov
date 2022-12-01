<?php

declare(strict_types=1);

namespace App\Service;

class WorkTimeCalculator
{
    public const TIME_FORMAT = '%h:%I:%S';

    public function calculateWorkingTime(\DateTimeInterface $startDateTime, \DateTimeInterface $endDateTime): string
    {
        return $endDateTime->diff($startDateTime)->format(self::TIME_FORMAT);
    }
}
