<?php

namespace Scern\Lira\Application\Seo;

class Robots
{
    public RobotsIndex $index = RobotsIndex::noindex;

    public RobotsFollow $follow = RobotsFollow::nofollow;

    public function render(): string
    {
        return "<meta name=\"robots\" content=\"{$this->index->name},{$this->follow->name}\">";
    }
}