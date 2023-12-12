<?php

namespace Scern\Lira\Extensions;

class LoggerManager
{
    private array $loggers = [];

    public function get(string $loggerName): ?\Monolog\Logger
    {
        return array_key_exists($loggerName, $this->loggers) ? $this->loggers[$loggerName] : null;
    }

    public function set(\Monolog\Logger $logger): void
    {
        $loggerName = $logger->getName();
        if (!array_key_exists($loggerName, $this->loggers)) {
            $this->loggers[$loggerName] = $logger;
        }
    }
}