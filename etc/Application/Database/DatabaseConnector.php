<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace Core\Application\Database;

class DatabaseConnector extends \PDO
{
    const TYPE_FIELD = [
        'integer' => parent::PARAM_INT,
        'boolean' => parent::PARAM_BOOL,
    ];

    public function __construct($dsn, $username = '', $passwd = '', $options = [])
    {
        parent::__construct($dsn, $username, $passwd, $options);
        parent::setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        parent::setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        parent::setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
    }

    public function requestDb($statement, array $params = [])
    {
        if (is_string($statement)) {
            $statement = $this->prepare($statement);
        }
        foreach ($params as $name => $param) {
            $paramType = gettype($param);
            $bindType = parent::PARAM_STR;
            if ($param instanceof \DateTime) {
                $param = $param->format('Y-m-d H:i:s');
            } elseif (array_key_exists($paramType, self::TYPE_FIELD)) {
                $bindType = self::TYPE_FIELD[$paramType];
            } elseif (null === $params) {
                $bindType = parent::PARAM_NULL;
            }
            $statement->bindValue($name, $param, $bindType);
        }
        $statement->execute();

        return $statement;
    }
}
