<?php

class Config {

    private $dbSettings;
    private $errorSettings;

    public function __construct() {

        $this->dbSettings = [
           // 'uri' => 'mongodb://localhost:27017',
               'dbname' => "data",
                'user' => "rock",
                'password' => "123",
               'host' =>  "localhost",
                'driver' =>  "mysqli"
        ];

        $this->errorSettings = [
                'displayErrorDetails' => true,
                'logErrors' => true,
                'logErrorDetails' => true
        ];

    }


    public function getDbConfig() {
        return $this->dbSettings;
    }

    public function getErrorSettings() {
        return $this->errorSettings;
    }
}