<?php

namespace Scern\Lira;

use Scern\Lira\Config\Source;

readonly class Router
{
    public function __construct(public string $defaultControllerClass, protected Source $routes)
    {
    }

    public function execute(string $url): string
    {
        if (!empty($this->routes->values)) foreach ($this->routes->values as $regex => $controllerClass) {
            if (preg_match($regex, $url)) {
                if(is_subclass_of($controllerClass,Controller::class)) return $controllerClass;
            }
        }
        if(!class_exists($this->defaultControllerClass)) throw new \Exception('Controller not found');
        if(!is_subclass_of($this->defaultControllerClass,Controller::class)) throw new \Exception('Invalid Controller class');
        return $this->defaultControllerClass;
    }
}