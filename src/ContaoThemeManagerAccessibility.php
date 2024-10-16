<?php

declare(strict_types=1);

namespace ContaoThemeManager\Accessibility;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ContaoThemeManagerAccessibility extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
