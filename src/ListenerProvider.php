<?php

namespace Effectra\EventDispatcher;

use Psr\EventDispatcher\ListenerProviderInterface;

class ListenerProvider implements ListenerProviderInterface
{
    private $listeners = [];

    public function addListener(string $eventType, callable $listener): void
    {
        if (!isset($this->listeners[$eventType])) {
            $this->listeners[$eventType] = [];
        }
        $this->listeners[$eventType][] = $listener;
    }

    public function getListenersForEvent(object $event): iterable
    {
        $eventType = get_class($event);
        $listeners = $this->listeners[$eventType] ?? [];

        // Consider parent classes as well
        foreach (class_parents($eventType) as $parentClass) {
            if (isset($this->listeners[$parentClass])) {
                $listeners = array_merge($listeners, $this->listeners[$parentClass]);
            }
        }

        return $listeners;
    }
}
