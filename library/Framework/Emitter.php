<?php

namespace Framework;

/**
 * `Emitter` represents an entity which can emit and consume events.
 */
abstract class Emitter
{
    private $listeners = [];

    /**
     * `on` subscribes `$listener` to `$event`, invoking it whenever `$event`
     * is emitted.
     * @param string $event The name of the event
     * @param callable $listener The callback to invoke
     * @return Emitter The emitter
     */
    public function on(string $event, callable $listener): Emitter
    {
        if (!isset($this->listeners[$event])) {
            $this->listeners[$event] = [];
        }

        $this->listeners[$event][] = $listener;

        return $this;
    }

    /**
     * `off` removes `$listener` from the list of callbacks subscribed to
     * `$event`.
     *
     * If `$listener` is unspecfied, all listeners subscribed to `$event` are
     * removed.
     * @param string $event The name of the event
     * @param callable|null $listener (Optional) The callback to invoke
     * @return Emitter The emitter
     */
    public function off(string $event, callable $listener = null): Emitter
    {
        if (!count($this->listeners) || !isset($this->listeners[$event])) {
            return $this;
        }

        // Remove all listeners if no particular listener is specified:
        if (!isset($listener)) {
            unset($this->listeners[$event]);

            return $this;
        }

        $listeners = &$this->listeners[$event];

        foreach ($listeners as $i => $l) {
            if ($l === $listener) {
                array_splice($listeners, $i, 1);
                break;
            }
        }

        return $this;
    }

    /**
     * `emit` invokes all listeners subscribed to `$event` with the provided
     * `$args`.
     * @param string $event The event to emit
     * @param mixed $args A variadic number of arguments to pass to each
     *                    invoked listener
     * @return Emitter The emitter
     */
    public function emit(string $event, ...$args): Emitter
    {
        if (!count($this->listeners) || !isset($this->listeners[$event])) {
            return $this;
        }

        $listeners = $this->listeners[$event];

        foreach ($listeners as $listener) {
            $listener($args);
        }

        return $this;
    }
}
