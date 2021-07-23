<?php

namespace Titeca\Sybase;

use Illuminate\Database\Connectors\Connector as IlluminateConnector;
use Illuminate\Database\Connectors\ConnectorInterface;
use PDO;

class Connector extends IlluminateConnector implements ConnectorInterface
{
	/**
     * The PDO connection options.
     *
     * @var array
     */
    protected $options = [
        PDO::ATTR_CASE => PDO::CASE_NATURAL,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_ORACLE_NULLS => PDO::NULL_NATURAL,
        PDO::ATTR_STRINGIFY_FETCHES => false,
        PDO::ATTR_AUTOCOMMIT => true,
        PDO::ATTR_PERSISTENT => false,
    ];

    /**
     * Establish a database connection.
     *
     * @param  array  $config
     * @return \PDO
     */
    public function connect(array $config)
    {
        return $this->createConnection($this->getDsn($config), $config, $this->getOptions($config));
    }

    /**
     * Create a DSN string from a configuration.
     *
     * @param  array  $config
     * @return string
     */
    protected function getDsn(array $config)
    {
        $arguments = [
            'CommLinks' => "tcpip(Host={$config['host']};port={$config['port']})",
            'Driver' => "{$config['driver']}",
            'Server' => $config['server'],
        ];

        if (isset($config['database'])) {
            $arguments['Database'] = $config['database'];
        }

        if (isset($config['charset'])) {
            $arguments['charset'] = "{$config['charset']}";
        }

        return $this->buildConnectString($arguments);
    }

    /**
     * Build a connection string from the given arguments.
     *
     * @param  array  $arguments
     * @return string
     */
    protected function buildConnectString(array $arguments)
    {
        return 'odbc:'.implode(';', array_map(function ($key) use ($arguments) {
            return sprintf('%s=%s', $key, $arguments[$key]);
        }, array_keys($arguments)));
    }
}