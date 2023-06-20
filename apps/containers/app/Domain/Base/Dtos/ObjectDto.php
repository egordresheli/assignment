<?php

declare(strict_types=1);

namespace App\Domain\Base\Dtos;


/**
 * Class ObjectDto
 * @package App\Domain\Base\Dtos
 *
 * @property string $name
 * @property integer $width
 * @property integer $length
 */
class ObjectDto
{
    public function __construct(
        private readonly string $name,
        private readonly int    $width,
        private readonly int    $length
    )
    {
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
