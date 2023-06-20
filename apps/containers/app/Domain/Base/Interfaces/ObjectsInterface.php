<?php

declare(strict_types=1);

namespace App\Domain\Base\Interfaces;

interface ObjectsInterface
{
    /**
     * @return int
     */
    public function getWidth(): int;

    /**
     * @return int
     */
    public function getLength(): int;
}
