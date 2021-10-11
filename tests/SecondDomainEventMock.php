<?php

declare(strict_types=1);

namespace Oscmarb\EventBus\Tests;

final class SecondDomainEventMock extends SharedDomainEvent
{
    public static function eventName(): string
    {
        return 'second';
    }

    public function priority(): int
    {
        return 2;
    }
}