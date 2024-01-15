<?php

namespace Scern\Lira\Application\Models;

use Scern\Lira\Model;

class Group extends Model
{
    protected string $table = 'access_groups';
    public function __construct(protected $database)
    {
    }

    public function getGroupsByUserId(int $userId): array
    {
        return [];

    }
}