<?php

namespace RawPHP\CommunicationLogger\Adapter;

use RawPHP\CommunicationLogger\Model\IEvent;

/**
 * Interface IAdapter
 *
 * @package RawPHP\CommunicationLogger\Adapter
 */
interface IAdapter
{
    /**
     * @param IEvent $event
     *
     * @return IEvent
     */
    public function save(IEvent $event);

    /**
     * Get last event.
     *
     * @return IEvent
     */
    public function getLastEvent();

    /**
     * Get logged events.
     *
     * @return IEvent[]
     */
    public function getEvents();
}
