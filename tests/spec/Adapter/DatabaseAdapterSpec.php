<?php

namespace spec\RawPHP\CommunicationLogger\Adapter;

use PDO;
use PDOStatement;
use RawPHP\CommunicationLogger\Adapter\DatabaseAdapter;
use PhpSpec\ObjectBehavior;
use RawPHP\CommunicationLogger\Model\IEvent;

class DatabaseAdapterSpec extends ObjectBehavior
{
    function let(PDO $connection)
    {
        $this->beConstructedWith($connection, 'table');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(DatabaseAdapter::class);
    }

    function it_saves_new_events(IEvent $event, PDO $connection, PDOStatement $statement)
    {
        $event->getId()->shouldBeCalled()->willReturn(null);
        $event->getEndpoint()->shouldBeCalled()->willReturn('http://example.com');
        $event->getMethod()->shouldBeCalled()->willReturn('POST');
        $event->getRequest()->shouldBeCalled()->willReturn('request');
        $event->getReference()->shouldBeCalled()->willReturn(null);

        $connection
            ->prepare('INSERT INTO table VALUES(:endpoint, :method, :reference, :request)')
            ->shouldBeCalled()->willReturn($statement);

        $statement->execute(
            [
                ':endpoint' => 'http://example.com',
                ':method' => 'POST',
                ':reference' => null,
                ':request' => 'request',
            ]
        )->shouldBeCalled();

        $connection->lastInsertId()->shouldBeCalled()->willReturn(12);

        $event->setId(12)->shouldBeCalled();

        $this->save($event);
    }

    function it_saves_updated_events(IEvent $event, PDO $connection, PDOStatement $statement)
    {
        $event->getId()->shouldBeCalled()->willReturn(12);
        $event->getResponse()->shouldBeCalled()->willReturn('response');
        $event->getLatency()->shouldBeCalled()->willReturn(0.12);

        $connection
            ->prepare('UPDATE table SET response = :response, SET latency = :latency WHERE id = :id')
            ->shouldBeCalled()->willReturn($statement);

        $statement->execute(
            [
                ':id' => 12,
                ':response' => 'response',
                ':latency' => 0.12,
            ]
        )->shouldBeCalled();

        $statement->columnCount()->shouldBeCalled()->willReturn(1);

        $this->save($event);
    }

    function it_returns_its_last_event(IEvent $event, PDO $connection, PDOStatement $statement)
    {
        $event->getId()->shouldBeCalled()->willReturn(null);
        $event->getEndpoint()->shouldBeCalled()->willReturn('http://example.com');
        $event->getMethod()->shouldBeCalled()->willReturn('POST');
        $event->getRequest()->shouldBeCalled()->willReturn('request');
        $event->getReference()->shouldBeCalled()->willReturn(null);

        $connection
            ->prepare('INSERT INTO table VALUES(:endpoint, :method, :reference, :request)')
            ->shouldBeCalled()->willReturn($statement);

        $statement->execute(
            [
                ':endpoint' => 'http://example.com',
                ':method' => 'POST',
                ':reference' => null,
                ':request' => 'request',
            ]
        )->shouldBeCalled();

        $connection->lastInsertId()->shouldBeCalled()->willReturn(12);

        $event->setId(12)->shouldBeCalled();

        $this->save($event);

        $this->getLastEvent()->shouldReturn($event);
    }

    function it_returns_its_events(PDO $connection, PDOStatement $statement)
    {
        $connection
            ->prepare('SELECT * FROM table')
            ->shouldBeCalled()->willReturn($statement);

        $statement->execute()->shouldBeCalled();

        $this->getEvents()->shouldBeArray();
    }
}
