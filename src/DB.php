<?php

namespace Amaur\PhpPdoSingleton;

use PDO;
use PDOException;

class DB {
    static ?PDO $dbInstance = null;
    private DatabaseConfigInterface $config;

    /**
     * Construct PDO instance
     */
    public function __construct(DatabaseConfigInterface $config) {
        $this->config = $config;
        [$host, $dbName, $user, $password] = $this->config->getConfig();

        try {
            self::$dbInstance = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8;", $user, $password);
            self::$dbInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$dbInstance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Return instance
     * @return PDO
     */
    public static function getInstance():PDO {
        if(is_null(self::$dbInstance)) {
            new self();
        }
        return self::$dbInstance;
    }

    /**
     * For no clone
     */
    public function __clone() {}
}