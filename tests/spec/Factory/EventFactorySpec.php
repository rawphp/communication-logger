<?php

namespace spec\RawPHP\CommunicationLogger\Factory;

use RawPHP\CommunicationLogger\Factory\EventFactory;
use PhpSpec\ObjectBehavior;
use RawPHP\CommunicationLogger\Model\Event;

class EventFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(EventFactory::class);
    }

    function it_creates_a_new_event()
    {
        $this->create(
            'request',
            'http://example.com',
            'POST',
            'ref'
        )->shouldReturnAnInstanceOf(Event::class);
    }
}
