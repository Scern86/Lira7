<?php

namespace Scern\Lira\Component\Admin\Access;

use Scern\Lira\Database\Database;
use Scern\Lira\Model;

class Action extends Model
{
    protected string $table = 'access_actions';

    public function __construct(Database $database)
    {
        parent::__construct($database);
    }
}