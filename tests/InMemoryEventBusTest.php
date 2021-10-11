<?php

declare(strict_types=1);

namespace Oscmarb\EventBus\Tests;

use Oscmarb\EventBus\InMemoryEventBus;
use Oscmarb\EventBus\EventDispatcher;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class InMemoryEventBusTest extends TestCase
{
    public function test_event_bus(): void
    {
        $firstEvent = new FirstDomainEventMock();
        $secondEvent = new SecondDomainEventMock();

        $expectedDispatchEventsOrder = [$secondEvent, $firstEvent];

        /** @var EventDispatcher|MockObject $dispatcher */
        $dispatcher = $this->getMockBuilder(EventDispatcher::class)->disableOriginalConstructor()->getMock();
        $eventBus = new InMemoryEventBus(new \ArrayObject([$dispatcher]));

        $dispatcher->expects(self::once())->method('dispatch')->with(...$expectedDispatchEventsOrder);

        $eventBus->publish(...\array_reverse($expectedDispatchEventsOrder));
    }
}