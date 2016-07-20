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
class Logger
{
    /** @var  float */
    protected $startTimestamp;
    /** @var  IAdapter */
    protected $adapter;
    /** @var  IEventFactory */
    protected $eventFactory;

    /**
     * Logger constructor.
     *
     * @param IAdapter $adapter
     * @param IEventFactory $eventFactory
     */
    public function __construct(IAdapter $adapter, IEventFactory $eventFactory)
    {
        $this->adapter      = $adapter;
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
    public function begin(string $request, string $endpoint, string $method, string $reference): IEvent
    {
        $this->startTimestamp = microtime(true);

        $event = $this->eventFactory->create($request, $endpoint, $method, $reference);

        return $this->adapter->save($event);
    }

    /**
     * Log the response.
     *
     * @param string $response
     *
     * @return IEvent
     */
    public function end(string $response): IEvent
    {
        $endTimestamp = microtime(true);

        $event = $this->adapter->getLastEvent();

        $event->setResponse($response);
        $event->setLatency($endTimestamp - $this->startTimestamp);

        return $this->adapter->save($event);
    }

    /**
     * Get the latest event.
     *
     * @return IEvent
     */
    public function getLastEvent(): IEvent
    {
        return $this->event;
    }
}
