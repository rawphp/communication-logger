<?php

namespace spec\RawPHP\CommunicationLogger\Adapter;

use Prophecy\Argument;
use RawPHP\CommunicationLogger\Adapter\FileAdapter;
use PhpSpec\ObjectBehavior;
use RawPHP\CommunicationLogger\Factory\IEventFactory;
use RawPHP\CommunicationLogger\Model\IEvent;
use RawPHP\CommunicationLogger\Util\IReader;
use RawPHP\CommunicationLogger\Util\IWriter;

class FileAdapterSpec extends ObjectBehavior
{
    function let(IWriter $writer, IReader $reader, IEventFactory $eventFactory)
    {
        $this->beConstructedWith(
            $writer,
            $reader,
            $eventFactory,
            '../../../tests/fixtures/communication-logger'
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(FileAdapter::class);
    }

    function it_saves_new_events_to_files(IWriter $writer, IEvent $event)
    {
        $writer->open(Argument::type('string'), 'w+')->shouldBeCalled()->willReturn($writer);

        $event->getId()->shouldBeCalled()->willReturn(null);
        $event->setId(Argument::type('string'))->shouldBeCalled();
        $event->getEndpoint()->shouldBeCalled()->willReturn('file');
        $event->getMethod()->shouldBeCalled()->willReturn('POST');
        $event->getReference()->shouldBeCalled()->willReturn('ref');
        $event->getRequest()->shouldBeCalled()->willReturn('request');

        $writer->write('POST file' . PHP_EOL)->shouldBeCalled();
        $writer->write('ref' . PHP_EOL)->shouldBeCalled();
        $writer->write('request' . PHP_EOL)->shouldBeCalled();

        $writer->isOpen()->shouldBeCalled()->willReturn(true);
        $writer->close()->shouldBeCalled();

        //if (file_exists($filePath)) {
        //    unlink($filePath);
        //}

        $this->save($event);
    }

    function it_returns_last_event(IWriter $writer, IEvent $event)
    {
        $writer->open(Argument::type('string'), 'w+')->shouldBeCalled()->willReturn($writer);

        $event->getId()->shouldBeCalled()->willReturn(null);
        $event->setId(Argument::type('string'))->shouldBeCalled();
        $event->getEndpoint()->shouldBeCalled()->willReturn('file');
        $event->getMethod()->shouldBeCalled()->willReturn('POST');
        $event->getReference()->shouldBeCalled()->willReturn('ref');
        $event->getRequest()->shouldBeCalled()->willReturn('request');

        $writer->write('POST file' . PHP_EOL)->shouldBeCalled();
        $writer->write('ref' . PHP_EOL)->shouldBeCalled();
        $writer->write('request' . PHP_EOL)->shouldBeCalled();

        $writer->isOpen()->shouldBeCalled()->willReturn(true);
        $writer->close()->shouldBeCalled();

        $this->save($event);

        $this->getLastEvent()->shouldreturn($event);
    }

    function it_returns_all_of_its_events(IReader $reader, IEventFactory $eventFactory, IEvent $event)
    {
        $reader->readDir('../../../tests/fixtures/communication-logger')->shouldBeCalled()->willReturn(
            ['example.com.876983e7-e64c-4757-ab8b-7aae4a0f6ae0.event']
        );

        $reader->read('../../../tests/fixtures/communication-logger/example.com.876983e7-e64c-4757-ab8b-7aae4a0f6ae0.event')
               ->shouldBeCalled()->willreturn(
                'POST http://example.com
ref
request
0.56
response'
            );

        $eventFactory->create(
            'request',
            'http://example.com',
            'POST',
            'ref'
        )->shouldBeCalled()->willReturn($event);

        $event->setLatency(0.56)->shouldBeCalled();
        $event->setResponse('response')->shouldBeCalled();

        $this->getEvents()->shouldBeArray();
    }
}
