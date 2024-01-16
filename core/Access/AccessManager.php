<?php

namespace Scern\Lira\Access;

class AccessManager
{
    /**
     * @param array $rules
     * @param bool $open, return this if empty rules
     */
    public function __construct(protected array $rules=[], protected bool $open=false)
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
        return $this->open;
    }

    public function addRules(array $rules): void
    {
        $this->rules += $rules;
    }
}