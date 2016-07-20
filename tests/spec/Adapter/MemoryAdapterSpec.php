<?php

namespace spec\RawPHP\CommunicationLogger\Adapter;

use Prophecy\Argument;
use RawPHP\CommunicationLogger\Adapter\MemoryAdapter;
use PhpSpec\ObjectBehavior;
use RawPHP\CommunicationLogger\Model\IEvent;

class MemoryAdapterSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(MemoryAdapter::class);
    }

    function it_saves_events(IEvent $event)
    {
        $event->getId()->shouldBeCalled()->willReturn(null);
        $event->setId(Argument::type('string'))->shouldBeCalled();

        $this->save($event);
    }

    function it_returns_last_event(IEvent $event)
    {
        $this->save($event);

        $this->getLastEvent()->shouldReturn($event);
    }

    function it_returns_all_of_its_events(IEvent $event)
    {
        $this->save($event);

        $this->getEvents()->shouldReturn([$event]);
    }
}
