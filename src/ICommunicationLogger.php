<?php

namespace RawPHP\CommunicationLogger;

use RawPHP\CommunicationLogger\Model\IEvent;

/**
 * Class Logger
 *
 * @package RawPHP\CommunicationLogger
 */
interface ICommunicationLogger
{
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
    public function begin(string $request, string $endpoint, string $method, string $reference) : IEvent;

    /**
     * Log the response.
     *
     * @param string $response
     *
     * @return IEvent
     */
    public function end(string $response) : IEvent;

    /**
     * Get the latest event.
     *
     * @return IEvent
     */
    public function getLastEvent() : IEvent;
}
