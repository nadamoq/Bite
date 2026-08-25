<?php

namespace App\Http\Controllers\Front;

use App\Actions\Addon\GetAddonsAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class AddonController extends Controller
{
    /**
     * Fetch all active add-ons grouped/formatted for frontend.
     */
    public function index(GetAddonsAction $addonsAction): JsonResponse
    {
        $result = $addonsAction->execute();

        return response()->json($result);
    }
}
