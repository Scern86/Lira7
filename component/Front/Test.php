<?php

namespace Scern\Lira\Component\Front;

use Scern\Lira\Application\Controller;
use Scern\Lira\Application\Result\{InternalRedirect, Result};

class Test extends Controller
{
    public function execute(string $url): Result
    {
        return new InternalRedirect($this->view->makeLink('/catalog'));
    }
}