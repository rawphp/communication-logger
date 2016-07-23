<?php

namespace RawPHP\CommunicationLogger\Adapter;

use PDO;
use PDOException;
use RawPHP\CommunicationLogger\Exception\LogException;
use RawPHP\CommunicationLogger\Model\Event;
use RawPHP\CommunicationLogger\Model\IEvent;

/**
 * Class DatabaseAdapter
 *
 * @package RawPHP\CommunicationLogger\Adapter
 */
class DatabaseAdapter implements IAdapter
{
    /** @var  PDO */
    protected $connection;
    /** @var  string */
    protected $table;
    /** @var  IEvent */
    protected $lastEvent;

    /**
     * DatabaseAdapter constructor.
     *
     * @param PDO $connection
     * @param string $table
     */
    public function __construct(PDO $connection, $table)
    {
        $this->connection = $connection;
        $this->table = $table;
    }

    /**
     * @param IEvent $event
     *
     * @return IEvent
     * @throws LogException
     */
    public function save(IEvent $event)
    {
        $this->lastEvent = $event;

        try {
            if (null === $event->getId()) {
                // insert a new event
                $this->insert($event);
            } else {
                // Update existing event
                $this->update($event);
            }
        } catch (PDOException $e) {
            throw new LogException($e->getMessage(), $event);
        }

        return $event;
    }

    /**
     * Get last event.
     *
     * @return IEvent
     */
    public function getLastEvent()
    {
        return $this->lastEvent;
    }

    /**
     * Get logged events.
     *
     * @return IEvent[]
     */
    public function getEvents()
    {
        $events = [];

        $statement = $this->connection->prepare('SELECT * FROM ' . $this->table);

        $result = $statement->execute();

        if (0 < count($result)) {
            foreach ($result as $row) {
                var_dump($row);
                $events[] = (new Event())
                    ->setId($row['id']);
            }
        }

        return $events;
    }

    /**
     * Insert new event.
     *
     * @param IEvent $event
     *
     * @return int
     */
    protected function insert(IEvent $event)
    {
        $statement = $this->connection->prepare(
            'INSERT INTO ' . $this->table . ' VALUES(:endpoint, :method, :reference, :request)'
        );

        $statement->execute(
            [
                ':endpoint' => $event->getEndpoint(),
                ':method' => $event->getMethod(),
                ':reference' => $event->getReference(),
                ':request' => $event->getRequest(),
            ]
        );

        $id = $this->connection->lastInsertId();

        $event->setId($id);

        return $id;
    }

    /**
     * Update event.
     *
     * @param IEvent $event
     *
     * @return bool
     */
    protected function update(IEvent $event)
    {
        $statement = $this->connection->prepare(
            'UPDATE ' . $this->table . ' SET response = :response, SET latency = :latency WHERE id = :id'
        );

        $statement->execute(
            [
                ':id' => $event->getId(),
                ':response' => $event->getResponse(),
                ':latency' => $event->getLatency(),
            ]
        );

        return $statement->columnCount() === 1;
    }
}
