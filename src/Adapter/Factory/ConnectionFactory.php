<?php

namespace RawPHP\CommunicationLogger\Adapter\Factory;

use PDO;

/**
 * Class ConnectionFactory
 *
 * @package RawPHP\CommunicationLogger\Adapter\Factory
 */
class ConnectionFactory
{
    /**
     * Create PDO connection.
     *
     * @param string $type
     * @param string $host
     * @param string $port
     * @param string $database
     * @param string $user
     * @param string $password
     *
     * @return PDO
     */
    public function create(
        string $type,
        string $host,
        string $port,
        string $database,
        string $user,
        string $password
    ): PDO {
        return new PDO(
            sprintf(
                '%s:host=%s;port=%s;dbname=%s',
                $type,
                $host,
                $port,
                $database
            ),
            $user,
            $password
        );
    }
}
