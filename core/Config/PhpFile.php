<?php

namespace Scern\Lira\Config;

class PhpFile extends Source
{
    public function __construct(protected string $config_file)
    {
        if(!file_exists($this->config_file)) throw new \Exception("File {$config_file} not exists!");
        try{
            $values = include $this->config_file;
        }catch (\Throwable $e){
            // Log
            $values = [];
        }
        parent::__construct($values);
    }
}