<?php

namespace Scern\Lira\Config;

class PhpFile implements Source
{
    public function __construct(protected string $config_file)
    {
        if(!file_exists($this->config_file)) throw new \Exception('File not exists!');
    }

    public function getArray(): array
    {
        $result = [];
        try{
            $result = include_once $this->config_file;
        }catch (\Throwable $e){
            // Log
        }
        return $result;
    }
}