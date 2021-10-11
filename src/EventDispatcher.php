<?php

declare(strict_types=1);

namespace Oscmarb\EventBus;

use Oscmarb\Ddd\Domain\DomainEvent\DomainEvent;

interface EventDispatcher
{
    public function dispatch(DomainEvent ...$events): void;
}