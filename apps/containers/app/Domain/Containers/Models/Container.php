<?php

declare(strict_types=1);

namespace App\Domain\Containers\Models;

use App\Domain\Base\Interfaces\ObjectsInterface;
use Database\Factories\ContainerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Container
 * @package App\Domain\Containers\Models
 *
 * @property integer $id
 * @property integer $width
 * @property integer $length
 */
class Container extends Model implements ObjectsInterface
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'width',
        'length',
    ];

    /**
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @return ContainerFactory
     */
    public static function factory(): ContainerFactory
    {
        return ContainerFactory::new();
    }
}
