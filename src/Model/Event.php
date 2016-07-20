<?php

namespace RawPHP\CommunicationLogger\Model;

/**
 * Class Event
 *
 * @package RawPHP\CommunicationLogger\Model
 */
class Event implements IEvent
{
    /** @var  mixed */
    protected $id;
    /** @var  string */
    protected $endpoint;
    /** @var  string */
    protected $method;
    /** @var  string */
    protected $reference;
    /** @var  string */
    protected $latency;
    /** @var  string */
    protected $request;
    /** @var  string */
    protected $response;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return Event
     */
    public function setId($id): Event
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * @param string $endpoint
     *
     * @return IEvent
     */
    public function setEndpoint(string $endpoint): IEvent
    {
        $this->endpoint = $endpoint;

        return $this;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param string $method
     *
     * @return IEvent
     */
    public function setMethod(string $method): IEvent
    {
        $this->method = $method;

        return $this;
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     *
     * @return IEvent
     */
    public function setReference(string $reference): IEvent
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * @return string
     */
    public function getLatency()
    {
        return $this->latency;
    }

    /**
     * @param float $latency
     *
     * @return IEvent
     */
    public function setLatency(float $latency): IEvent
    {
        $this->latency = $latency;

        return $this;
    }

    /**
     * @return string
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param string $request
     *
     * @return IEvent
     */
    public function setRequest(string $request): IEvent
    {
        $this->request = $request;

        return $this;
    }

    /**
     * @return string
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param string $response
     *
     * @return IEvent
     */
    public function setResponse(string $response): IEvent
    {
        $this->response = $response;

        return $this;
    }
}
