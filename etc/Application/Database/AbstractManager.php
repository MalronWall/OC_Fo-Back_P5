<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace Core\Application\Database;

class AbstractManager
{
    protected $db;

    public function __construct()
    {
        $this->loadDatabase();
    }

    protected function loadDatabase()
    {
        $config = $this->loadDatabaseConfiguration();

        try {
            $options[\PDO::MYSQL_ATTR_INIT_COMMAND] = 'SET NAMES utf8';
            $dsn = "mysql:dbname=".$config['dbname']."; host=".$config['host'].':'.$config['port'];
            $this->db = new DatabaseConnector(
                $dsn,
                $config['user'],
                $config['password'],
                $options
            );
        } catch (\PDOException $e) {
            die("An error has occurred in AbstractManager.php->loadDatabase() : " . $e->getMessage());
        }
    }

    private function loadDatabaseConfiguration()
    {
        if (file_exists(__DIR__ . '/../../config/database/connection_loc.php')) {
            return require __DIR__ . '/../../config/database/connection_loc.php';
        } else {
            return require __DIR__ . '/../../config/database/connection.php';
        }
    }
}
