<?php

namespace RawPHP\CommunicationLogger\Factory;

use RawPHP\CommunicationLogger\Model\IEvent;

/**
 * Class EventFactory
 *
 * @package RawPHP\CommunicationLogger\Factory
 */
interface IEventFactory
{
    /**
     * @param string $request
     * @param string $endpoint
     * @param string $method
     * @param string $reference
     *
     * @return IEvent
     */
    public function create($request, $endpoint, $method, $reference = '');
}
