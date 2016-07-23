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
    public function setEndpoint($endpoint);

    /**
     * @return string
     */
    public function getMethod();

    /**
     * @param string $method
     *
     * @return IEvent
     */
    public function setMethod($method);

    /**
     * @return string
     */
    public function getReference();

    /**
     * @param string $reference
     *
     * @return IEvent
     */
    public function setReference($reference);

    /**
     * @return string
     */
    public function getLatency();

    /**
     * @param float $latency
     *
     * @return IEvent
     */
    public function setLatency($latency);

    /**
     * @return string
     */
    public function getRequest();

    /**
     * @param string $request
     *
     * @return IEvent
     */
    public function setRequest($request);

    /**
     * @return string
     */
    public function getResponse();

    /**
     * @param string $response
     *
     * @return IEvent
     */
    public function setResponse($response);
}
