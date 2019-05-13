<?php

error_reporting(-1);
ini_set('display_errors', 'On');

include('config.php');

final class DbConnect
{
    private static $instance = null;
    private $connection;

    private function __construct($OptionsMap)
    {

        $this->connection = new PDO("{$OptionsMap['driver']}:host={$OptionsMap['host']};dbname={$OptionsMap['dbName']}",
            $OptionsMap['user'], $OptionsMap['pass']);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


    }

    public static function getInstance($OptionsMap=null)
    {
        if (self::$instance === null) {
            self::$instance = new self ($OptionsMap);
        }

        return self::$instance;
    }


    public function getConnection()
    {

        return $this->connection;
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

}
