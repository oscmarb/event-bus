<?php

declare(strict_types=1);

namespace Oscmarb\EventBus\Tests;

final class FirstDomainEventMock extends SharedDomainEvent
{
    public static function eventName(): string
    {
        return 'first';
    }

    public function priority(): int
    {
        return 1;
    }
}