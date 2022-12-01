<?php

declare(strict_types=1);

namespace App\EventListener\Entity;

use App\Entity\TimeEntry;
use App\Service\WorkTimeCalculator;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class TimeEntryChangeListener
{
    public function __construct(protected WorkTimeCalculator $workTimeCalculator)
    {
    }

    public function prePersist(TimeEntry $timeEntry, LifecycleEventArgs $event): void
    {
        $this->saveWorkingTime($timeEntry);
    }

    public function preUpdate(TimeEntry $timeEntry, LifecycleEventArgs $event): void
    {
        $this->saveWorkingTime($timeEntry);
    }

    /**
     * @param TimeEntry $timeEntry
     * @return void
     */
    private function saveWorkingTime(TimeEntry $timeEntry): void
    {
        if ($timeEntry->getStartDateTime() instanceof \DateTime && $timeEntry->getEndDateTime() instanceof \DateTime) {
            $timeEntry->setWorkingTime($this->workTimeCalculator->calculateWorkingTime(
                $timeEntry->getStartDateTime(),
                $timeEntry->getEndDateTime()
            ));
        }
    }
}
