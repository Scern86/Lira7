<?php

namespace Scern\Lira;

readonly class Router
{
    public function __construct(public string $defaultControllerClass, protected array $routes)
    {
    }

    public function execute(string $url): string
    {
        if (!empty($this->routes)) foreach ($this->routes as $regex => $controllerClass) {
            if (preg_match($regex, $url)) {
                return $controllerClass;
            }
        }
        return $this->defaultControllerClass;
    }
}