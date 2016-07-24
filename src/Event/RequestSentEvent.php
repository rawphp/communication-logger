<?php

namespace RawPHP\CommunicationLogger\Event;

use Psr\Http\Message\RequestInterface;
use RawPHP\CommunicationLogger\Model\IEvent;

/**
 * Class RequestSentEvent
 *
 * @package RawPHP\CommunicationLogger\Event
 */
class RequestSentEvent
{
    const NAME = 'request.sent';

    /** @var  RequestInterface */
    protected $request;
    /** @var  IEvent */
    protected $event;

    /**
     * RequestSentEvent constructor.
     *
     * @param RequestInterface $request
     */
    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    /**
     * Get the request.
     *
     * @return RequestInterface
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Get event.
     *
     * @return IEvent
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set event.
     *
     * @param IEvent $event
     *
     * @return RequestSentEvent
     */
    public function setEvent(IEvent $event)
    {
        $this->event = $event;

        return $this;
    }
}
