<?php

namespace RawPHP\CommunicationLogger\Exception;

use Exception;
use RawPHP\CommunicationLogger\Model\IEvent;

/**
 * Class LogException
 *
 * @package RawPHP\CommunicationLogger\Exception
 */
class LogException extends Exception
{
    /** @var  IEvent */
    protected $event;

    /**
     * LogException constructor.
     *
     * @param string $message
     * @param IEvent $event
     */
    public function __construct($message, $event)
    {
        parent::__construct($message, 500, null);
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
