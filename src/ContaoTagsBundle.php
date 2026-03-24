<?php

declare(strict_types=1);

namespace VHUG\ContaoTags;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ContaoTagsBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
