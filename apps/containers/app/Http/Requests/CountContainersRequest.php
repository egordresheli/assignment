<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountContainersRequest extends FormRequest
{
    /**
     * @return \string[][]
     */
    public function rules(): array
    {
        return [
            'squares' => ['required', 'array'],
            'squares.*.id' => ['required', 'integer'],
            'circles' => ['required', 'array'],
            'circles.*.id' => ['required', 'integer'],
        ];
    }
}
