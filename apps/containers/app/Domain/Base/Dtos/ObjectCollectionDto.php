<?php

declare(strict_types=1);

namespace App\Domain\Base\Dtos;

use Illuminate\Support\Collection;

/**
 * Class ObjectCollectionDto
 * @package App\Domain\Base\Dtos
 *
 * @property array|ObjectDto[] $items
 */
class ObjectCollectionDto
{
    /** @var Collection $items */
    private Collection $items;

    public function __construct(Collection $items = null)
    {
        $this->items = $items !== null ? $items : collect();
    }

    /**
     * @param ObjectDto $objectDto
     * @return $this
     */
    public function pushItem(ObjectDto $objectDto): static
    {
        $this->items = $this->items->push($objectDto);

        return $this;
    }

    /**
     * @return Collection
     */
    public function getItems(): Collection
    {
        return $this->items;
    }
}
