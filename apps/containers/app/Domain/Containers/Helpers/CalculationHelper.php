<?php

namespace App\Domain\Containers\Helpers;

use App\Domain\Base\Dtos\ObjectCollectionDto;
use App\Domain\Base\Dtos\ObjectDto;
use App\Domain\Containers\Models\Container;
use App\Domain\Objects\Models\Circle;
use App\Domain\Objects\Models\Square;

class CalculationHelper
{
    /**
     * @return array
     */
    public static function getAvailableContainers(): array
    {
        $containers = Container::all()->toArray();
        usort($containers, static fn(array $first, array $second) => $first['width'] * $first['length'] - $second['width'] * $second['length']);

        return $containers;
    }

    /**
     * @param array $data
     * @return ObjectCollectionDto
     */
    public static function getObjects(array $data): ObjectCollectionDto
    {
        $objectCollections = new ObjectCollectionDto();

        $circles = Circle::query()->whereIn('id', array_column($data['circles'], 'id'))->get();
        $squares = Square::query()->whereIn('id', array_column($data['squares'], 'id'))->get();

        foreach ($circles as $circle) {
            $objectCollections->pushItem((new ObjectDto(
                'circle',
                $circle->getWidth(),
                $circle->getLength()
            )));
        }

        foreach ($squares as $square) {
            $objectCollections->pushItem((new ObjectDto(
                'square',
                $square->getWidth(),
                $square->getLength()
            )));
        }

        return $objectCollections;
    }

    /**
     * @param array $objects
     * @param array $containers
     * @param array $oversizedObjects
     * @return string
     */
    public static function returnBeautifulAnswer(array $objects, array $containers, array $oversizedObjects = []): string
    {
        $objectsName = self::getNameFieldFromArray($objects);
        $containerNames = self::getNameFieldFromArray($containers);
        $result = 'For sending ' . self::countElementsByName($objectsName) . ', you will need ' .
            self::countElementsByName($containerNames) . ' container(s).';
        foreach ($containers as $index => $container) {
            $result .= 'The ' . $index + 1 . ' container will contain the following objects: ' . self::countElementsByName(self::getNameFieldFromArray($container->getItems())) . ". ";
        }

        if (!empty($oversizedObjects)) {
            $result .= 'Oversize objects: ';
            foreach ($oversizedObjects as $object) {
                $result .= $object->getName() . ' with parametres: width-' . $object->getWidth() . ' and length-' . $object->getLength() . '. ';
            }
        }

        return $result;
    }

    /**
     * @param array $elements
     * @return array|string
     */
    public static function countElementsByName(array $elements): array|string
    {
        return str_replace('=', ': ', http_build_query(array_count_values($elements), null, ','));
    }

    /**
     * @param array $array
     * @return array
     */
    public static function getNameFieldFromArray(array $array): array
    {
        return array_map(fn($element) => $element->getname(), $array);
    }
}
