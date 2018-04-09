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

    public function loadDatabase()
    {
        $config = $this->loadDatabaseConfiguration();
        try {
            $dsn = "mysql:dbname=".$config['dbname']."; host=".$config['host'].":".$config['port']."";
            $this->db = new DatabaseConnector(
                $dsn,
                $config['database']['user'],
                $config['database']['password']
            );
        } catch (\PDOException $e) {
            die("An error has occurred : " . $e->getMessage());
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
