<?php

namespace Scern\Lira\Application\Models;

use Scern\Lira\Model;

class Action extends Model
{
    protected string $table = 'access_actions';
    public function __construct(protected $database)
    {
    }

    public function getActionsByRoleId(int $roleId): array
    {
        return [];

    }
}