<?php

namespace RawPHP\CommunicationLogger\Event;

use Psr\Http\Message\RequestInterface;

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
}
