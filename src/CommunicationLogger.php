<?php

namespace RawPHP\CommunicationLogger;

use RawPHP\CommunicationLogger\Adapter\IAdapter;
use RawPHP\CommunicationLogger\Factory\IEventFactory;
use RawPHP\CommunicationLogger\Model\IEvent;

/**
 * Class Logger
 *
 * @package RawPHP\CommunicationLogger
 */
class CommunicationLogger implements ICommunicationLogger
{
    /** @var  float */
    protected $startTimestamp;
    /** @var  IAdapter */
    protected $adapter;
    /** @var  IEventFactory */
    protected $eventFactory;
    /** @var  IEvent */
    protected $lastEvent;

    /**
     * Logger constructor.
     *
     * @param IAdapter $adapter
     * @param IEventFactory $eventFactory
     */
    public function __construct(IAdapter $adapter, IEventFactory $eventFactory)
    {
        $this->adapter = $adapter;
        $this->eventFactory = $eventFactory;
    }

    /**
     * Log the beginning of a request.
     *
     * @param string $request
     * @param string $endpoint
     * @param string $method
     * @param string $reference
     *
     * @return IEvent
     */
    public function begin($request, $endpoint, $method, $reference)
    {
        $this->startTimestamp = microtime(true);

        $this->lastEvent = $this->eventFactory->create($request, $endpoint, $method, $reference);

        return $this->adapter->save($this->lastEvent);
    }

    /**
     * Log the response.
     *
     * @param IEvent $event
     * @param string $response
     *
     * @return IEvent
     */
    public function end(IEvent $event, $response)
    {
        $endTimestamp = microtime(true);

        $event->setResponse($response);
        $event->setLatency($endTimestamp - $this->startTimestamp);

        return $this->adapter->save($event);
    }

    /**
     * Get the latest event.
     *
     * @return IEvent
     */
    public function getLastEvent()
    {
        return $this->lastEvent;
    }
}
