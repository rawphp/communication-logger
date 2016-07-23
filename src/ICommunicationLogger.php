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
    public function begin($request, $endpoint, $method, $reference);

    /**
     * Log the response.
     *
     * @param string $response
     *
     * @return IEvent
     */
    public function end($response);

    /**
     * Get the latest event.
     *
     * @return IEvent
     */
    public function getLastEvent();
}
