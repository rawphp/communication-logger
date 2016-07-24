<?php

namespace spec\RawPHP\CommunicationLogger\Event;

use Psr\Http\Message\RequestInterface;
use RawPHP\CommunicationLogger\Event\RequestSentEvent;
use PhpSpec\ObjectBehavior;

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
}
