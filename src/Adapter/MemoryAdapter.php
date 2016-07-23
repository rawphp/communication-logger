<?php

namespace RawPHP\CommunicationLogger\Adapter;

use Ramsey\Uuid\Uuid;
use RawPHP\CommunicationLogger\Model\IEvent;

/**
 * Class MemoryAdapter
 *
 * @package RawPHP\CommunicationLogger\Adapter
 */
class MemoryAdapter implements IAdapter
{
    /** @var  IEvent[] */
    protected $events;

    /**
     * Save event.
     *
     * @param IEvent $event
     *
     * @return IEvent
     */
    public function save(IEvent $event)
    {
        if (null !== $event->getId()) {
            return $event;
        }

        $event->setId((string)Uuid::uuid4());

        $this->events[] = $event;

        return $event;
    }

    /**
     * Get last event.
     *
     * @return IEvent
     */
    public function getLastEvent()
    {
        return $this->events[count($this->events) - 1];
    }

    /**
     * Get logged events.
     *
     * @return IEvent[]
     */
    public function getEvents()
    {
        return $this->events;
    }
}
