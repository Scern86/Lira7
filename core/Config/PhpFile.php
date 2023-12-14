<?php

namespace Scern\Lira\Config;

class PhpFile implements Source
{
    protected array $array = [];
    public function __construct(protected string $config_file)
    {
        if(!file_exists($this->config_file)) throw new \Exception('File not exists!');
        try{
            $this->array = include_once $this->config_file;
        }catch (\Throwable $e){
            // Log
        }
    }

    public function getArray(): array
    {
        return $this->array;
    }
}