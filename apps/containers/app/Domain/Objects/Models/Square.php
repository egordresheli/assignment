<?php

declare(strict_types=1);

namespace App\Domain\Objects\Models;

use App\Domain\Base\Interfaces\ObjectsInterface;
use Database\Factories\SquareFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Square
 * @package App\Domain\Objects\Models
 *
 * @property integer $id
 * @property int $width
 * @property int $length
 */
class Square extends Model implements ObjectsInterface
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'width',
        'length',
    ];

    /**
     * @return SquareFactory
     */
    public static function factory(): SquareFactory
    {
        return SquareFactory::new();
    }

    /**
     * @return integer
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * @return integer
     */
    public function getWidth(): int
    {
        return $this->width;
    }
}
