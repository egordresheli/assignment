<?php

declare(strict_types=1);

namespace App\Domain\Objects\Models;

use App\Domain\Base\Interfaces\ObjectsInterface;
use Database\Factories\CircleFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Square
 * @package App\Domain\Objects\Models
 *
 * @property integer $id
 * @property integer $radius
 */
class Circle extends Model implements ObjectsInterface
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'radius',
    ];

    /**
     * @return CircleFactory
     */
    public static function factory(): CircleFactory
    {
        return CircleFactory::new();
    }


    /**
     * @return int
     */
    public function getLength(): int
    {
        return $this->radius * 2;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->radius * 2;
    }
}
