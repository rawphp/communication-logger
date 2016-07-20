<?php

namespace RawPHP\CommunicationLogger\Model;

/**
 * Interface IEvent
 *
 * @package RawPHP\CommunicationLogger\Model
 */
interface IEvent
{
    /**
     * @return mixed
     */
    public function getId();

    /**
     * @param mixed $id
     *
     * @return IEvent
     */
    public function setId($id);

    /**
     * @return string
     */
    public function getEndpoint();

    /**
     * @param string $endpoint
     *
     * @return IEvent
     */
    public function setEndpoint(string $endpoint): IEvent;

    /**
     * @return string
     */
    public function getMethod();

    /**
     * @param string $method
     *
     * @return IEvent
     */
    public function setMethod(string $method): IEvent;

    /**
     * @return string
     */
    public function getReference();

    /**
     * @param string $reference
     *
     * @return IEvent
     */
    public function setReference(string $reference): IEvent;

    /**
     * @return string
     */
    public function getLatency();

    /**
     * @param float $latency
     *
     * @return IEvent
     */
    public function setLatency(float $latency): IEvent;

    /**
     * @return string
     */
    public function getRequest();

    /**
     * @param string $request
     *
     * @return IEvent
     */
    public function setRequest(string $request): IEvent;

    /**
     * @return string
     */
    public function getResponse();

    /**
     * @param string $response
     *
     * @return IEvent
     */
    public function setResponse(string $response): IEvent;
}
