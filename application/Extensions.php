<?php

namespace Scern\Lira\Application;

use Scern\Lira\Extensions\{CacheManager, Database\DatabaseManager, LoggerManager};

class Extensions
{
    private ?CacheManager $cacheManager = null;
    private ?DatabaseManager $databaseManager = null;
    private ?LoggerManager $loggerManager = null;

    public function __construct()
    {
    }

    public function getCacheManager(): ?CacheManager
    {
        return $this->cacheManager;
    }

    public function setCacheManager(?CacheManager $cacheManager): void
    {
        if(is_null($this->cacheManager)) $this->cacheManager = $cacheManager;
    }

    public function getDatabaseManager(): ?DatabaseManager
    {
        return $this->databaseManager;
    }

    public function setDatabaseManager(?DatabaseManager $databaseManager): void
    {
        if(is_null($this->databaseManager)) $this->databaseManager = $databaseManager;
    }

    public function getLoggerManager(): ?LoggerManager
    {
        return $this->loggerManager;
    }

    public function setLoggerManager(?LoggerManager $loggerManager): void
    {
        if(is_null($this->loggerManager)) $this->loggerManager = $loggerManager;
    }
}