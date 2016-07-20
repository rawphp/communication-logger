<?php

namespace spec\RawPHP\CommunicationLogger\Adapter\Factory;

use PDOException;
use RawPHP\CommunicationLogger\Adapter\Factory\ConnectionFactory;
use PhpSpec\ObjectBehavior;

class ConnectionFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ConnectionFactory::class);
    }

    function it_creates_a_new_pdo_connection()
    {
        $this->shouldThrow(PDOException::class)
             ->during('create', [
                 'mysql',
                 'localhost',
                 '3500',
                 'database',
                 'user',
                 'password',
             ]);
    }
}
