<?php

namespace spec\RawPHP\CommunicationLogger\Model;

use RawPHP\CommunicationLogger\Model\Event;
use PhpSpec\ObjectBehavior;
use RawPHP\CommunicationLogger\Model\IEvent;

class EventSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Event::class);
    }

    function it_implements_event_interface()
    {
        $this->shouldHaveType(IEvent::class);
    }

    function its_id_is_mutable()
    {
        $this->getId()->shouldReturn(null);
        $this->setId(11);
        $this->getId()->shouldReturn(11);
    }

    function its_endpoint_is_mutable()
    {
        $this->getEndpoint()->shouldReturn(null);
        $this->setEndpoint('http://example.com');
        $this->getEndpoint()->shouldReturn('http://example.com');
    }

    function its_method_is_mutable()
    {
        $this->getMethod()->shouldReturn(null);
        $this->setMethod('POST');
        $this->getMethod()->shouldReturn('POST');
    }

    function its_reference_is_mutable()
    {
        $this->getReference()->shouldReturn(null);
        $this->setReference('ref');
        $this->getReference()->shouldReturn('ref');
    }

    function its_latency_is_mutable()
    {
        $this->getLatency()->shouldReturn(null);
        $this->setLatency(0.56);
        $this->getLatency()->shouldReturn(0.56);
    }

    function its_request_is_mutable()
    {
        $this->getRequest()->shouldReturn(null);
        $this->setRequest('request');
        $this->getRequest()->shouldReturn('request');
    }

    function its_response_is_mutable()
    {
        $this->getResponse()->shouldReturn(null);
        $this->setResponse('response');
        $this->getResponse()->shouldReturn('response');
    }
}
