<?php

namespace Scern\Lira\AccessControl;

class AccessManager
{

    public function __construct(protected array $rules=[])
    {
    }

    public function isAllowed(string $method): bool
    {
        if(!empty($this->rules)){
            foreach ($this->rules as $action=>$permission){
                if($method==$action && $permission) return true;
            }
            return false;
        }
        return true;
    }
}