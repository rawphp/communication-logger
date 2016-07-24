<?php

namespace spec\RawPHP\CommunicationLogger\Event;

use Psr\Http\Message\RequestInterface;
use RawPHP\CommunicationLogger\Event\RequestSentEvent;
use PhpSpec\ObjectBehavior;
use RawPHP\CommunicationLogger\Model\IEvent;

class RequestSentEventSpec extends ObjectBehavior
{
    function let(RequestInterface $request)
    {
        $this->beConstructedWith($request);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(RequestSentEvent::class);
    }

    function it_returns_its_request(RequestInterface $request)
    {
        $this->getRequest()->shouldReturn($request);
    }

    function its_event_is_mutable(IEvent $event)
    {
        $this->getEvent()->shouldReturn(null);
        $this->setEvent($event);
        $this->getEvent()->shouldReturn($event);
    }
}
