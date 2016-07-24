<?php

namespace RawPHP\CommunicationLogger\Event;

use Psr\Http\Message\ResponseInterface;
use RawPHP\CommunicationLogger\Model\IEvent;

/**
 * Class ResponseReceivedEvent
 *
 * @package RawPHP\CommunicationLogger\Event
 */
class ResponseReceivedEvent
{
    const NAME = 'response.received';

    /** @var  ResponseInterface */
    protected $response;
    /** @var  IEvent */
    protected $event;

    /**
     * ResponseReceivedEvent constructor.
     *
     * @param ResponseInterface $response
     * @param IEvent $event
     */
    public function __construct(ResponseInterface $response, IEvent $event)
    {
        $this->response = $response;
        $this->event = $event;
    }

    /**
     * Get the request.
     *
     * @return ResponseInterface
     */
    public function getResponse()
    {
        return $this->response;
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
}
