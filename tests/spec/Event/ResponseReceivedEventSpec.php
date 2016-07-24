<?php

namespace spec\RawPHP\CommunicationLogger\Event;

use Psr\Http\Message\ResponseInterface;
use RawPHP\CommunicationLogger\Event\ResponseReceivedEvent;
use PhpSpec\ObjectBehavior;
use RawPHP\CommunicationLogger\Model\IEvent;

class ResponseReceivedEventSpec extends ObjectBehavior
{
    function let(ResponseInterface $response, IEvent $event)
    {
        $this->beConstructedWith($response, $event);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ResponseReceivedEvent::class);
    }

    function it_returns_its_response(ResponseInterface $response)
    {
        $this->getResponse()->shouldReturn($response);
    }

    function it_returns_its_event(IEvent $event)
    {
        $this->getEvent()->shouldReturn($event);
    }
}
