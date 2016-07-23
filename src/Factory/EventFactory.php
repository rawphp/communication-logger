<?php

namespace RawPHP\CommunicationLogger\Factory;

use RawPHP\CommunicationLogger\Model\Event;
use RawPHP\CommunicationLogger\Model\IEvent;

/**
 * Class EventFactory
 *
 * @package RawPHP\CommunicationLogger\Factory
 */
class EventFactory implements IEventFactory
{
    /**
     * @param string $request
     * @param string $endpoint
     * @param string $method
     * @param string $reference
     *
     * @return IEvent
     */
    public function create($request, $endpoint, $method, $reference = '')
    {
        $event = new Event();

        $event->setEndpoint($endpoint);
        $event->setMethod($method);
        $event->setReference($reference);
        $event->setRequest($request);

        return $event;
    }
}
