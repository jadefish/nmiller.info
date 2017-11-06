<?php

namespace Framework;

abstract class Emitter
{
    private $listeners = [];

    public function on(string $event, callable $listener)
    {
        if (!isset($this->listeners[$event])) {
            $this->listeners[$event] = [];
        }

        $this->listeners[$event][] = $listener;
    }

    public function off(string $event, callable $listener = null)
    {
        if (!in_array($event, $this->listeners)) {
            return false;
        }

        if (!isset($listener)) {
            unset($this->listeners[$event]);

            return true;
        }

        $listeners = &$this->listeners[$event];

        foreach ($listeners as $i => $l) {
            if ($l === $listener) {
                return (bool)array_splice($listeners, $i, 1);
            }
        }

        return false;
    }

    public function emit(string $event, ...$args)
    {
        if (!in_array($event, $this->listeners)) {
            return false;
        }

        $listeners = $this->listeners[$event];

        foreach ($listeners as $listener) {
            $listener($args);
        }
    }
}
