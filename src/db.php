<?php

use Doctrine\DBAL\DriverManager as DriverManager;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\MongoDB\Connection ;


class DB {
    private $qb;
    private $conn;
   private $dm;
    private $connectionParams;

    public function __construct(Config $config) {
        $this->connectionParams = $config->getDbConfig();

        $this->conn = DriverManager::getConnection($this->connectionParams);
        $this->qb = $this->conn->createQueryBuilder();

        

     //   $conn = new Connection($this->connectionParams['uri']);
     //   $this->dm = DocumentManager::create($conn, []);
    }

    public function getQueryBuilder() {
        return $this->qb; //qb for mysql dm for mango
    }
}