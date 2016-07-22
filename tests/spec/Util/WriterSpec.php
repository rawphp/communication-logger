<?php

namespace spec\RawPHP\CommunicationLogger\Util;

use RawPHP\CommunicationLogger\Util\Writer;
use PhpSpec\ObjectBehavior;

class WriterSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Writer::class);
    }

    function it_opens_files_for_writing()
    {
        $this->open('file', 'w');

        $this->close();

        if (file_exists('file')) {
            unlink('file');
        }
    }
}
