<?php

namespace RawPHP\CommunicationLogger\Event;

use Psr\Http\Message\ResponseInterface;

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

    /**
     * ResponseReceivedEvent constructor.
     *
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
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
}
