<?php

declare(strict_types=1);

namespace Oscmarb\EventBus\Tests;

use Oscmarb\Ddd\Domain\DomainEvent\DomainEvent;

abstract class SharedDomainEvent extends DomainEvent
{
    public static function fromPrimitives(mixed $body, string $messageId, string $messageOccurredOn): static
    {
        return new static($messageId, $messageOccurredOn);
    }

    public function toPrimitives(): array
    {
        return [];
    }
}