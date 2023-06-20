<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\Containers\Actions\CountContainersAction;
use App\Http\Requests\CountContainersRequest;
use Illuminate\Http\JsonResponse;

class ShipmentsController extends Controller
{
    /**
     * @param CountContainersRequest $request
     * @param CountContainersAction $action
     * @return JsonResponse
     */
    public function countContainers(CountContainersRequest $request, CountContainersAction $action): JsonResponse
    {
        return response()->json($action->execute($request->validated()));
    }
}
