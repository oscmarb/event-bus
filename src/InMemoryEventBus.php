<?php

declare(strict_types=1);

namespace Oscmarb\EventBus;

use Oscmarb\Ddd\Domain\DomainEvent\DomainEvent;
use Oscmarb\Ddd\Domain\DomainEvent\EventBus;

final class InMemoryEventBus implements EventBus
{
    /** @var EventDispatcher[] */
    private array $dispatchers;

    public function __construct(\Traversable $dispatchers)
    {
        $this->dispatchers = \iterator_to_array($dispatchers);
    }

    public function publish(DomainEvent ...$events): void
    {
        $orderedEvents = $this->orderEvents(...$events);

        foreach ($this->dispatchers as $dispatcher) {
            $dispatcher->dispatch(...$orderedEvents);
        }
    }

    private function orderEvents(DomainEvent ...$events): array
    {
        if (true === empty($events)) {
            return [];
        }

        $indexedEvents = [];

        foreach ($events as $event) {
            if (false === isset($indexedEvents[$event->priority()])) {
                $indexedEvents[$event->priority()] = [];
            }

            $indexedEvents[$event->priority()][] = $event;
        }

        \ksort($indexedEvents);

        $orderedEvents = [];

        foreach ($indexedEvents as $priorityEvents) {
            $orderedEvents = [...$priorityEvents, ...$orderedEvents];
        }

        return $orderedEvents;
    }
}