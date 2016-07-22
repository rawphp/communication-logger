<?php

namespace spec\RawPHP\CommunicationLogger\Util;

use RawPHP\CommunicationLogger\Util\Reader;
use PhpSpec\ObjectBehavior;

class ReaderSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Reader::class);
    }

    function it_reads_directories()
    {
        $this->readDir(dirname(__DIR__) . '/../fixtures/communication-logger')->shouldHaveCount(3);
    }

    function it_reads_files()
    {
        $this->read(dirname(__DIR__) . '/../fixtures/communication-logger/example.com.876983e7-e64c-4757-ab8b-7aae4a0f6ae0.event')
             ->shouldBe(
                 'POST http://example.com
ref
request
0.56
response'
             );
    }
}
