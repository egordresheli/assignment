<?php

declare(strict_types=1);

namespace App\Domain\Base\Dtos;

/**
 * Class ContainerDto
 * @package App\Domain\Base\Dtos
 *
 * @property string $name
 * @property array|ObjectDto[] $items
 * @property integer $width
 * @property integer $length
 * @property integer $freeWidth
 * @property integer $freeLength
 * @property integer $usedWidth
 * @property integer $usedLength
 */
class ContainerDto
{
    /** @var int $freeWidth */
    private int $freeWidth;

    /** @var int $usedWidth */
    private int $usedWidth;

    /** @var int $freeLength */
    private int $freeLength;

    /** @var int $usedLength */
    private int $usedLength;

    /**
     * @param string $name
     * @param int $width
     * @param int $length
     * @param array $items
     */
    public function __construct(
        private readonly string $name,
        private int             $width,
        private int             $length,
        private array           $items = [],
    )
    {
        $this->width = $this->freeWidth = $width;
        $this->length = $this->freeLength = $length;
        $this->usedLength = $this->usedWidth = 0;

        if (!empty($this->items)) {
            $this->recalcSpace();
        }

    }

    /**
     * @param ObjectDto $objectDto
     * @return bool
     */
    public function canBeFilled(ObjectDto $objectDto): bool
    {
        if ($objectDto->getLength() <= $this->freeLength && $objectDto->getWidth() <= $this->freeWidth) {
            return true;
        }

        return false;
    }

    /**
     * @param ObjectDto $objectDto
     * @return ContainerDto
     */
    public function fillWithObject(ObjectDto $objectDto): static
    {
        $this->items[] = $objectDto;
        $this->calculation($objectDto);

        return $this;
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
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

    /**
     * @return void
     */
    private function recalcSpace(): void
    {
        foreach ($this->items as $item) {
            $this->calculation($item);
        }
    }

    private function calculation(ObjectDto $item): void
    {
        $this->freeLength -= $item->getLength();
        $this->usedLength += $item->getLength();
        $this->freeWidth -= $item->getWidth();
        $this->usedWidth += $item->getWidth();
    }
}
