<?php

declare(strict_types=1);

namespace App\Domain\Containers\Actions;

use App\Domain\Base\Dtos\ContainerDto;
use App\Domain\Base\Dtos\ObjectDto;
use App\Domain\Containers\Helpers\CalculationHelper;
use Illuminate\Support\Collection;

class CountContainersAction
{
    /** @var array $availableContainers */
    private array $availableContainers;

    /** @var array $neededContainers */
    private array $neededContainers;

    public function __construct()
    {
        $this->availableContainers = CalculationHelper::getAvailableContainers();
        $this->neededContainers = [];
    }

    /**
     * @param array $data
     * @return string
     */
    public function execute(array $data): string
    {
        $objects = CalculationHelper::getObjects($data)->getItems();

        $oversizeObjects = $this->getOversizeObjects($objects);


        foreach ($objects as $object) {
            foreach ($this->neededContainers as $index => $neededContainer) {
                if ($neededContainer->canBeFilled($object)) {
                    $neededContainer->fillWithObject($object);
                    continue 2;
                }

                if ($biggerContainer = $this->pickBiggerContainer($neededContainer, $object)) {
                    $this->fillBiggerContainer($biggerContainer, $neededContainer, $index, $object);
                    continue 2;
                }
            }

            $this->fillNewContainer($object);
        }

        return CalculationHelper::returnBeautifulAnswer($objects->toArray(), $this->neededContainers, $oversizeObjects);
    }

    /**
     * @param ObjectDto $object
     * @return void
     */
    private function fillNewContainer(ObjectDto $object): void
    {
        $newContainer = $this->getSuitableContainer($object->getWidth(), $object->getLength());

        if ($newContainer) {
            $newContainer = new ContainerDto($newContainer['name'], $newContainer['length'], $newContainer['width']);
            $newContainer->fillWithObject($object);
            $this->neededContainers[] = $newContainer;
        }
    }

    /**
     * @param array $biggerContainer
     * @param ContainerDto $uselessContainer
     * @param int $uselessContainerIndex
     * @param ObjectDto $object
     * @return void
     */
    private function fillBiggerContainer(
        array        $biggerContainer,
        ContainerDto $uselessContainer,
        int          $uselessContainerIndex,
        ObjectDto    $object
    ): void
    {
        $container = new ContainerDto(
            $biggerContainer['name'],
            $biggerContainer['width'],
            $biggerContainer['length'],
            $uselessContainer->getItems(),
        );
        $this->neededContainers[$uselessContainerIndex] = $container->fillWithObject($object);
    }

    /**
     * @param ContainerDto $filledContainer
     * @param ObjectDto $object
     * @return array|null
     */
    private function pickBiggerContainer(ContainerDto $filledContainer, ObjectDto $object): ?array
    {
        return $this->getSuitableContainer(
            $filledContainer->getWidth() + $object->getWidth(),
            $filledContainer->getLength() + $object->getLength()
        );
    }

    /**
     * @param int $width
     * @param int $length
     * @return array|null
     */
    private function getSuitableContainer(int $width, int $length): ?array
    {
        foreach ($this->availableContainers as $container) {
            if ($container['width'] >= $width && $container['length'] >= $length) {
                return $container;
            }
        }

        return null;
    }

    /**
     * @param Collection $objects
     * @return array
     */
    private function getOversizeObjects(Collection $objects): array
    {
        $oversizeObjects = [];

        foreach ($objects as $object) {
            if ($this->getSuitableContainer($object->getWidth(), $object->getLength()) === null) {
                $oversizeObjects[] = $object;
            }
        }

        return $oversizeObjects;
    }
}
