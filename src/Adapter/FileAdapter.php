<?php

namespace RawPHP\CommunicationLogger\Adapter;

use Exception;
use Monolog\Logger;
use Ramsey\Uuid\Uuid;
use RawPHP\CommunicationLogger\Factory\IEventFactory;
use RawPHP\CommunicationLogger\Model\IEvent;
use RawPHP\CommunicationLogger\Util\IReader;
use RawPHP\CommunicationLogger\Util\IWriter;

/**
 * Class FileAdapter
 *
 * @package RawPHP\CommunicationLogger\Adapter
 */
class FileAdapter implements IAdapter
{
    /** @var  string */
    protected $directory;
    /** @var  IEvent */
    protected $latestEvent;
    /** @var  IEventFactory */
    protected $eventFactory;
    /** @var  IWriter */
    protected $writer;
    /** @var  IReader */
    protected $reader;
    /** @var */
    protected $logger;

    /**
     * FileAdapter constructor.
     *
     * @param IWriter $writer
     * @param IReader $reader
     * @param IEventFactory $eventFactory
     * @param string $dir
     * @param Logger $log
     */
    public function __construct(
        IWriter $writer,
        IReader $reader,
        IEventFactory $eventFactory,
        $dir,
        Logger $log = null
    ) {
        $this->writer = $writer;
        $this->reader = $reader;
        $this->eventFactory = $eventFactory;
        $this->directory = $dir;
        $this->logger = $log;
    }

    /**
     * @param IEvent $event
     *
     * @return IEvent
     */
    public function save(IEvent $event)
    {
        $this->latestEvent = $event;

        if (null === $event->getId()) {
            $event->setId((string)Uuid::uuid4());
        }

        $filename = sprintf('%s.%s.event', $this->prepareFilename($event->getEndpoint()), $event->getId());

        $file = null;

        try {
            $filePath = $this->directory . '/' . $filename;

            if (!file_exists($filePath)) {
                $this->writer->open($filePath, 'w+');
                $this->writer->write($event->getMethod() . ' ' . $event->getEndpoint() . PHP_EOL);
                $this->writer->write($event->getReference() . PHP_EOL);
                $this->writer->write($event->getRequest() . PHP_EOL);
            } else {
                $this->writer->open($filePath, 'a');
                $this->writer->write($event->getLatency() . PHP_EOL);
                $this->writer->write($event->getResponse() . PHP_EOL);
            }
        } catch (Exception $e) {
            if (null !== $this->logger) {
                $this->logger->error($e);
            }
        } finally {
            if ($this->writer->isOpen()) {
                $this->writer->close();
            }
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
        return $this->latestEvent;
    }

    /**
     * Get logged events.
     *
     * @return IEvent[]
     */
    public function getEvents()
    {
        $events = [];

        try {
            $files = $this->reader->readDir($this->directory);

            foreach ($files as $file) {
                $filePath = $this->directory . '/' . $file;

                $contents = $this->reader->read($filePath);

                $parts = explode(PHP_EOL, $contents);
                $line1 = explode(' ', $parts[0]);

                $method = $line1[0];
                $endpoint = $line1[1];
                $reference = $parts[1];
                $request = $parts[2];

                $event = $this->eventFactory->create($request, $endpoint, $method, $reference);

                if (5 === count($parts)) {
                    $event->setLatency((float)$parts[3]);
                    $event->setResponse($parts[4]);
                }

                $events[] = $event;
            }
        } catch (Exception $e) {
            if (null !== $this->logger) {
                $this->logger->error($e);
            }
        }

        return $events;
    }

    /**
     * Prepare filename.
     *
     * @param string $endpoint
     *
     * @return string
     */
    protected function prepareFilename($endpoint)
    {
        return str_replace(['//', '/'], '-', $endpoint);
    }
}
